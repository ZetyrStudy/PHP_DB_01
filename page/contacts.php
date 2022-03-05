<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Detecta se o formulário foi enviado...
if (isset($_POST['send'])) {

    // Se foi enviado, processa o formulário...

    // Isso é somente para testes. Remova depois dos testes.
    echo '<pre>';
    print_r($_POST);
    echo '</pre><hr><hr>';

    // Insere contato no banco de dados
    $sql = <<<SQL

INSERT INTO contacts (
    contact_name, 
    contact_email, 
    contact_subject, 
    contact_message
) VALUES (
    '{$_POST["name"]}', 
    '{$_POST["email"]}',
    '{$_POST["subject"]}',
    '{$_POST["message"]}'
);

SQL;

    // exit($sql); --> Debug

    $conn->query($sql);
}

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

// Define o título DESTA página.
$page_title = "Faça contato";

// Opção ativa no menu
$page_menu = "contacts";

// Inclui o cbeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_header.php";

?>

<?php // Conteúdo 
?>
<article>

    <h2>Faça contato</h2>
    <p>Preencha todos os campos do formulário abaixo para entrar em contato com a equipe do <strong><?php echo $site_name ?></strong>.</p>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="send" value="true">

        <p>
            <label for="name">Seu nome:</label>
            <input type="text" name="name" id="name" placeholder="Preencha seu nome completo." autofocus>
        </p>

        <p>
            <label for="email">Seu e-mail:</label>
            <input type="email" name="email" id="email" placeholder="Seu e-mail principal.">
        </p>

        <p>
            <label for="subject">Assunto:</label>
            <input type="text" name="subject" id="subject" placeholder="Um resumo do seu contato.">
        </p>

        <p>
            <label for="message">Mensagem:</label>
            <textarea name="message" id="message" placeholder="Escreva o quanto precisar."></textarea>
        </p>

        <p>
            <label></label>
            <button type="submit">Enviar</button>
        </p>

    </form>

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