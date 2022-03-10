<?php

// Inclui arquivo de configuração
require_once $_SERVER['DOCUMENT_ROOT'] . "/_config.php";

/*******************************************
 * Seu código PHP desta página entra aqui! *
 *******************************************/

// Variável com a lista de artigos mais recentes.
$featured_arts = $rnd_art = '';

// Obtém os 3 artigos mais recentes
$sql = <<<SQL

SELECT article_id, article_title, article_image, article_intro
FROM articles
WHERE article_status = 'on'
AND article_date <= NOW()
ORDER BY article_date DESC
LIMIT 3;

SQL;

$res = $conn->query($sql);

while ($art = $res->fetch_assoc()):

    $featured_arts .= <<<HTML

<div class="art-box">
    
    <div class="art-box-img">
        <a href="/page/view.php?id={$art['article_id']}" title="Clique para ver o artigo completo."><img src="{$art['article_image']}" alt="{$art['article_title']}"></a>
    </div>
    <div class="art-box-intro">
        <h3><a href="/page/view.php?id={$art['article_id']}" title="Clique para ver o artigo completo.">{$art['article_title']}</a></h3>
        {$art['article_intro']}
    </div>

</div>

HTML;

endwhile;

// Obtém um artigo aleatório
$sql = <<<SQL

SELECT article_id, article_image, article_title, article_intro FROM `articles`
WHERE article_status = 'on'
AND article_date <= NOW()
ORDER BY RAND()
LIMIT 1;

SQL;

$res = $conn->query($sql);

$artrnd = $res->fetch_assoc();

$rnd_art = <<<HTML

<div class="rndart-box">
    
    <div class="rndart-box-img">
        <a href="/page/view.php?id={$artrnd['article_id']}" title="Clique para ver o artigo completo."><img src="{$artrnd['article_image']}" alt="{$artrnd['article_title']}"></a>
    </div>
    <div class="rndart-box-intro">
        <h3><a href="/page/view.php?id={$artrnd['article_id']}" title="Clique para ver o artigo completo.">{$artrnd['article_title']}</a></h3>
        {$artrnd['article_intro']}
    </div>

</div>

HTML;

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

    <div class="featured">
        <?php echo $featured_arts ?>
    </div>

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

    <h3>Leia também</h3>

    <?php echo $rnd_art ?>

</aside>

<?php

// Inclui o rodapé da página
require_once $_SERVER['DOCUMENT_ROOT'] . "/_footer.php";

?>