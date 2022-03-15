<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Se não estiver logado, vai para a 'index'.
if (!isset($_COOKIE['user'])) header('Location: /');

// Obtém dados do usuário pelo cookie
$user = json_decode($_COOKIE['user'], true);

// Converte datas para pt-BR
$user['birth_br'] = date_to_br($user['user_birth']);
$user['date_br'] = date_to_br($user['user_date']);

// Somente primeiro nome
$user['first_name'] = explode(' ', $user['user_name'])[0];

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

// Define o título DESTA página.
$page_title = "";

// Opção ativa no menu
$page_menu = "index";

// Inclui o cabeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_header.php";

?>

<?php // Conteúdo 
?>
<article>

    <h2>Perfil de <?php echo $user['first_name'] ?></h2>

    <table>

        <tr>
            <td>Nome:</td>
            <td><?php echo $user['user_name'] ?></td>
        </tr>

        <tr>
            <td>E-mail:</td>
            <td><?php echo $user['user_email'] ?></td>
        </tr>

        <tr>
            <td>Nascimento:</td>
            <td><?php echo $user['birth_br'] ?></td>
        </tr>

        <tr>
            <td>Cadastrou-se em:</td>
            <td><?php echo $user['date_br'] ?></td>
        </tr>

        <tr>
            <td colspan="2">
                <a href="/user/edit.php">Editar perfil</a>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <a href="/user/logout.php">Sair / Logout</a>
            </td>
        </tr>

    </table>


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