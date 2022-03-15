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

// Realmente quer sair
if (isset($_GET['logout'])) :

    // Destroi o cookie
    setcookie('user', NULL, time() - 3600, '/');

    // Redireciona para a 'index'
    header('Location: /');

endif;

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

// Define o título DESTA página.
$page_title = "";

// Opção ativa no menu
$page_menu = "logout";

// Inclui o cabeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_header.php";

?>

<?php // Conteúdo 
?>
<article>

    <h2>Sair / Logout</h2>
    <p>Tem certeza que deseja sair do site?</p>
    <p><em>Se sair não terá acesso aos recursos exclusivos até que se logue novamente...</em></p>

    <p><a href="/">Não sair agora</a></p>

    <p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?logout=confirm">Sim, sair</a></p>

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