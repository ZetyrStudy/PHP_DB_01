<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variáveis do script
$form['feedback'] = '';
$show_form = true;

//debug($_POST);
//debug($sql);
//debug($form);

// Se não estiver logado, vai para a 'index'.
if (!isset($_COOKIE['user'])) header('Location: /');

if (isset($_POST['send-password'])) :

    // Obtém os valores dos campos, sanitiza e armazena nas variáveis.
    $form['password'] = sanitize('password', 'string');
    $form['new-password'] = sanitize('new-password', 'string');
    $form['verify-password'] = sanitize('verify-password', 'string');

    // Verifica se todos os campos form preenchidos
    if ($form['password'] === '' or $form['new-password'] === '' or $form['verify-password'] === '') :
        $form['feedback'] = '<h3 style="color:red">Erro: por favor, preencha todos os campos!</h3>';
        $form['password'] = $form['new-password'] = $form['verify-password'] = '';

    // Verifica se a data é válida
    elseif ($form['new-password'] !== $form['verify-password']) :
        $form['feedback'] = '<h3 style="color:red">Erro: a nova senha não foi repetida corretamente!</h3>';
        $form['password'] = $form['new-password'] = $form['verify-password'] = '';

    else :

        // String de atualização
        $sql = <<<SQL

UPDATE users 
SET 
user_password = SHA2('{$form['new-password']}', 512)
WHERE user_id = '{$user['user_id']}' 
AND user_password = SHA2('{$form['password']}', 512);

SQL;

               // Executa a query
        $res = $conn->query($sql);

        // Testa o resultado da atualização
        $result = $conn->affected_rows;

        // Se não atualizou...
        if ($result == 0) :
            $form['feedback'] = '<h3 style="color:red">Erro: a senha antiga está incorreta ou ela é igual a anterior!</h3>';

        // Se deu erro no SQL...
        elseif ($result == -1) :
            $form['feedback'] = '<h3 style="color:red">Erro: falha no acesso ao banco de dados!</h3>';

        // Se deu tudo certo...
        else :

            // Cria mensagem de confirmação.
            $form['feedback'] = <<<OUT
                    
                
                <p>Sua senha foi atualizada com sucesso.</p>
                <p><em>Obrigado...</em></p>

                
OUT;

            // Oculto o formulário.
            $show_form = false;

        endif;

    endif;

else :

    // Obtendo dados do usuário direto do banco de dados.
    $sql = <<<SQL

SELECT * FROM `users`
WHERE user_id = '{$user['user_id']}'
AND user_status = 'on';

SQL;

    // Executa a consulta
    $res = $conn->query($sql);

    // Se não retornar nada, volta para profile.
    if ($res->num_rows !== 1) header('Location: /user/profile.php');

    // Associa os dados ao formulário
    $form = $res->fetch_assoc();

    // Variáveis do script
    $form['feedback'] = '';

endif;

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

// Define o título DESTA página.
$page_title = "";

// Opção ativa no menu
$page_menu = "edit";

// Inclui o cabeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_header.php";

?>

<?php // Conteúdo 
?>
<article>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <h2>Editar senha</h2>

    <?php echo $form['feedback']; ?>

    <?php if ($show_form) : ?>

        <p>Altere os dados no formulário abaixo:</p>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="edit-password">

            <input type="hidden" name="send-password" value="true">

            <p>
                <label for="password">Senha atual:</label>
                <input type="password" name="password" id="password" placeholder="Sua senha." value="">
            </p>

            <p>
                <label for="new-password">Nova senha:</label>
                <input type="password" name="new-password" id="new-password" placeholder="Nova senha." value="">
            </p>

            <p>
                <label for="verify-password">Repita nova senha:</label>
                <input type="password" name="verify-password" id="verify-password" placeholder="Repita nova senha." value="">
            </p>

            <p>
                <label></label>
                <button type="submit">Salvar</button>
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