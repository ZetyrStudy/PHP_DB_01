<?php
/*
 * Configura a página de caracteres do PHP para UTF-8
 * DEVE ser a primeira linha de código do site.
 */
header("Content-type: text/html; charset=utf-8");

/*
 * Faz conexão com MySQL/MariaDB.
 * Os dados da conexão estão em "/_config.ini".
 */

// Armazena o arquivo "/_config.ini" em um array "$i"...
$i = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/_config.ini', true);

// Itera cada chve do array...
foreach ($i as $key => $value) :

    // Se a chave tem o mesmo nome do servidor...
    if ($_SERVER['SERVER_NAME'] === $key) :

        // Conexão com MySQL/MariaDB usando "mysqli" (orientada a objetos)
        @$conn = new mysqli($value['server'], $value['user'], $value['password'], $value['database']);

        // Trata possíveis exceções
        if ($conn->connect_error) die("Falha de conexão com o banco e dados: " . $conn->connect_error);
    endif;
endforeach;

// Seta transações com MySQL/MariaDB para UTF-8.
$conn->query("SET NAMES 'utf8'");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');

// Seta dias da semana e meses do MySQL/MariaDB para "português do Brasil".
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

// Define o fuso horário (opcional).
date_default_timezone_set('America/Sao_Paulo');

/******************************************************
 * Gera variáveis do tema à partir do banco de dados. *
 ******************************************************/

// Obtém variáveis e seus valores do banco de dados
$sql = "SELECT * FROM config;";
$res = $conn->query($sql);

// Gera arrays com as configurações
while ($x = $res->fetch_assoc()) :

    /*
     * Quebra o nome da variável, obtida do DB. Ex.:
     *   site_name ==> $var => 'site' e $key => 'name'
     *   site_logo ==> $var => 'site' e $key => 'logo'
     */
    $p = explode('_', $x['var']);
    $var = $p[0];
    $key = $p[1];

    /*
     * Cria variáveis (arrays) de configuração. Ex.:
     *   site_name ==> $var => 'site' e $key => 'name' então, $site['name'] => $x[val] 
     *   site_logo ==> $var => 'site' e $key => 'logo' então, $site['logo'] => $x[val] 
     */
    $$var[$key] = $x['val'];

endwhile;

/*
 * Aqui, teremos os arrais de configuração, obtidas à partir da tabela 'config':
 *     $site[]   --> Contém as configurações do aplicativo
 *     $social[] --> Contém a lista e redes sociais
 * 
 * Podemos ainda criar outras arrays, adicionando novos valores em 'config'.
 * Por exemplo, para adicionar um array '$teste[]', criamos, por exemplo, as entradas:
 * 
 *    Campo 'var'      │ Campo 'val'
 *   ──────────────────┼─────────────
 *    teste_chave1     │ Teste 1
 *    teste_chave2     │ Outro teste
 *    teste_outrachave │ Mais um teste
 *      │  │    │
 *      │  │    └──> chave do array
 *      │  └───────> separador
 *      └──────────> nome do array
 * 
 * Temos como resultado um novo array no ambiente:
 * 
 *    Array / chave        │ Valor
 *   ──────────────────────┼─────────────
 *    $teste['chave1']     │ 'Teste 1'
 *    $teste['chave2']     │ 'Outro teste'
 *    $teste['outrachave'] │ 'Mais um teste'
 */

// Define o título <title>...</title> de cada página
$page_title = "";

// Define o link ativo no menu principal
$page_menu = "";

/********************
 * Funções globais. *
 ********************/

// Função que sanitiza campos de formulário.
function sanitize($field_name, $field_type)
{

    // Variável com valor do campo filtrado.
    $field_value = '';

    // Aplica o filtro adequado, de acordo com o tipo de campo.
    switch ($field_type):

            // Se é um campo 'string', remove caracteres perigosos.
        case 'string':
            $field_value = htmlspecialchars($_POST[$field_name]);
            break;

            // Se é um campo 'email', remove caracteres inválidos.
        case 'email':
            $field_value = filter_input(INPUT_POST, $field_name, FILTER_SANITIZE_EMAIL);
            break;

    endswitch;

    // Remove espaços duplicados no meio da string.
    $field_value = preg_replace('/\\s\\s+/', ' ', $field_value);

    // Remove espaços antes e depois da string.
    $field_value = trim($field_value);

    // Retorna o valor do campo já sanitizado.
    return $field_value;
}

// Valida datas
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}