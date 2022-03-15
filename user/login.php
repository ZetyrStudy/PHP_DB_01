<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Se usuário já está logado, redireciona para a index.php
if (isset($_COOKIE['user'])) header('Location: /');

// Variáveis desta página
$form = [
    'email' => '',
    'password' => '',
    'keep' => '',
    'feedback' => ''
];

// Variável que exibe/oculta formulário.
$show_form = true;

// Detecta se o formulário foi enviado...
if (isset($_POST['send'])) :

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    // Atenção! A função "sanitize()" está em "/_config.php".
    $form['email'] = sanitize('email', 'email');
    $form['password'] = sanitize('password', 'string');

    // Tratamento de 'keep'.
    if (isset($_POST['keep'])) $form['keep'] = true;
    else $form['keep'] = false;

    // Verifica se todos os campos form preenchidos
    if ($form['email'] === '' or $form['password'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';

    else :

        // Cria a query para verificar usuário e senha no bnco de dados.
        $sql = <<<SQL

SELECT user_id, user_date, user_name, user_email, user_birth 
FROM `users`
WHERE user_email = '{$form['email']}' 
AND user_password = SHA2('{$form['password']}', 512)
AND user_status = 'on';

SQL;

        // Executa a consulta.
        $res = $conn->query($sql);

        // Se não retornou apenas um registro
        if ($res->num_rows !== 1) :

            // Gera mensagem de erro
            $form['feedback'] = '<h3 style="color:red">Erro: credenciais não encontradas!</h3>';

            // Limpa campos do formulário
            $form['email'] = $form['password'] = '';

        else :

            // Obtém valor do cookie do banco de dados
            $user = $res->fetch_assoc();

            // Tempo de vida do cookie
            if ($form['keep']) $cookie_live = time() + 86400 * 365;
            else $cookie_live = 0;

            // Cria cookie
            setcookie('user', json_encode($user), $cookie_live, '/');

            // Tudo certo? Carregue a página de feedback.
            header ('Location: /user/logged.php');

        endif;

    endif;

endif; // if (isset($_POST['send']))

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

// Define o título DESTA página.
$page_title = "";

// Opção ativa no menu
$page_menu = "login";

// Inclui o cabeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_header.php";

?>

<?php // Conteúdo 
?>
<article>

    <h2>Logue-se</h2>

    <?php echo $form['feedback']; ?>

    <?php if ($show_form) : ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

            <input type="hidden" name="send" value="true">

            <p>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Seu e-mail principal." value="<?php echo $form['email'] ?>" autofocus>
            </p>

            <p>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" placeholder="Sua senha." value="">
            </p>

            <p>
                <label><input type="checkbox" name="keep" value="keep"> Mantenha-me logado.</label>
            </p>

            <p>
                <label></label>
                <button type="submit">Entrar</button>
            </p>

        </form>

    <?php endif; ?>

</article>

<?php // Barra lateral 
?>
<aside>

    <h3>Seções:</h3>

    <ul>
        <li><a href="/sections/front.php">Front-end</a></li>
        <li><a href="/sections/back.php">Back-end</a></li>
        <li><a href="/sections/full.php">Full-stack</a></li>
    </ul>

</aside>

<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_footer.php";

?>