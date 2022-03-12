<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variáveis desta página
$name = $email = $subject = $message = $feedback = '';

// Variável que exibe/oculta formulário.
$show_form = true;

// Detecta se o formulário foi enviado...
if (isset($_POST['send'])) :

    // Se foi enviado, processa o formulário...

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    // Atenção! A função "sanitize()" está em "/_config.php".
    $name = sanitize('name', 'string');
    $email = sanitize('email', 'email');
    $subject = sanitize('subject', 'string');
    $message = sanitize('message', 'string');

    // Verifica se todos os campos form preenchidos
    if ($name === '' or $email === '' or $subject === '' or $message === '') :
        $feedback = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';
    else :

        /*
    // Isso é somente para testes. Remova depois dos testes.
    echo '<pre>';
    print_r($_POST);
    echo '</pre><hr><hr>';
    */

        // Cria a query para slvar no banco de dados.
        $sql = <<<SQL

INSERT INTO contacts (
    contact_name, 
    contact_email, 
    contact_subject, 
    contact_message
) VALUES (
    '{$name}', 
    '{$email}',
    '{$subject}',
    '{$message}'
);

SQL;

        // Salva contato no banco de dados.
        $conn->query($sql);

        // Obtém somente primeiro nome do rementente.
        $first_name = explode(" ", $name)[0];

        // Cria mensagem de confirmação.
        $feedback = <<<OUT
        
<h3>Olá {$first_name}!</h3>
<p>Seu contato foi enviado com sucesso.</p>
<p><em>Obrigado...</em></p>

OUT;

        // Oculto o formulário.
        $show_form = false;

        // Data de envio.
        $now = date('d/m/Y \à\s H:i');

        // Enviar e-mail para o administrador.

        $to = 'adm@ptp_db_01.com';
        $sj = 'Alguém entrou em contato';
        $msg = <<<MSG

Contato enviado pelo formulário do site:

    Data: {$now}
    Remetente: {$name}
    E-mail: {$email}
    Assunto: {$subject}
    -----------------------------
    {$message}
            
MSG;

        @mail($to, $sj, $msg);

    endif;
endif; // if (isset($_POST['send'])) 

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
    <p>Preencha todos os campos do formulário abaixo para entrar em contato com a equipe do <strong><?php echo $site['name'] ?></strong>.</p>

    <?php echo $feedback; ?>

    <?php if ($show_form) : ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <input type="hidden" name="send" value="true">

            <p>
                <label for="name">Seu nome:</label>
                <input type="text" name="name" id="name" placeholder="Preencha seu nome completo." value="<?php echo $name ?>" autofocus>
            </p>

            <p>
                <label for="email">Seu e-mail:</label>
                <input type="email" name="email" id="email" placeholder="Seu e-mail principal." value="<?php echo $email ?>">
            </p>

            <p>
                <label for="subject">Assunto:</label>
                <input type="text" name="subject" id="subject" placeholder="Um resumo do seu contato." value="<?php echo $subject ?>">
            </p>

            <p>
                <label for="message">Mensagem:</label>
                <textarea name="message" id="message" placeholder="Escreva o quanto precisar."><?php echo $message ?></textarea>
            </p>

            <p>
                <label></label>
                <button type="submit">Enviar</button>
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