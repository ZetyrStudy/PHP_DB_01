<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variável que contém a lista de artigos (string).
$art_view = $aut_view = '';

// Obtém o Id do artigo a ser exibido.
if (isset($_GET['id']))
    $art_id = intval($_GET['id']);
else
    $art_id = 0;

// Armadilha 1: caso usuário tente acessar a página sem um id ou com uma string.
if ($art_id === 0) header('Location: \page\articles.php');

// Consulta o artigo pelo ID
$sql = <<<SQL

SELECT *, DATE_FORMAT(article_date, '%d/%m/%Y às %H:%i') AS article_brdate
FROM articles 
INNER JOIN authors ON article_author = author_id
WHERE article_id = '{$art_id}'
AND article_status = 'on'
AND article_date <= NOW();

SQL;

$res = $conn->query($sql);

// Verifica se retornou um artigo
if ($res->num_rows != 1) header('Location: \page\articles.php');

$art = $res->fetch_assoc();

$art_view = <<<HTML

<h2>{$art['article_title']}</h2>
<small>Por {$art['author_name']} em {$art['article_brdate']}.</small>
<div>{$art['article_body']}</div>
<p><a href="/page/articles.php">Todos os artigos</a></p>

HTML;

$aut_view = <<<HTML

<div class="aside-author">

    <div class="aside-author-img">
        <img src="{$art['author_photo']}" alt="{$art['author_name']}">
    </div>
    <div class="aside-author-data">
        <h4>{$art['author_name']}</h4>
        {$art['author_profile']}
    </div>

</div>

HTML;

/*********************************************
 * Seu código PHP desta página termina aqui! *
 *********************************************/

// Define o título DESTA página.
$page_title = $art['article_title'];

// Opção ativa no menu
$page_menu = "articles";

// Inclui o cabeçalho da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_header.php";

?>

<?php // Conteúdo 
?>
<article>

    <?php echo $art_view ?>

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

    <h3>Autor</h3>

    <?php echo $aut_view ?>

</aside>

<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_footer.php";

?>