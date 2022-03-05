<?php

// Formata o título da página
if ($page_title == "") {

    // Se não definiu um title, usa o formato abaixo:
    $page_title = $site_name . ' ~ ' . $site_slogan;
} else {

    // Se definiu um title, usa o formato abaixo:
    $page_title = $site_name . " ~ " . $page_title;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.png">
    <title><?php echo $page_title; ?></title>
</head>

<body>

    <?php // Cabeçalho 
    ?>
    <header>

        <a href="/"><img src="<?php echo $site_logo ?>" alt="Logotipo de <?php echo $site_name; ?>"></a>
        <h1><?php echo $site_name; ?><small><?php echo $site_slogan ?></small></h1>

    </header>

    <?php // Menu principal 
    ?>
    <nav>

        <a href="/"><?php if ($page_menu == 'index') echo "<strong>INÍCIO</strong>"; else echo "Início"; ?></a>
        &bull;
        <a href="/page/articles.php"><?php if($page_menu == 'articles') echo "<strong>ARTIGOS</strong>"; else echo "Artigos"; ?></a>
        &bull;
        <a href="/page/contacts.php"><?php if($page_menu == 'contacts') echo "<strong>FAÇA CONTATO</strong>"; else echo "Faça Contato"; ?></a>
        &bull;
        <a href="/page/about.php"><?php if($page_menu == 'about') echo "<strong>SOBRE</strong>"; else echo "Sobre"; ?></a>

    </nav>

    <?php // Conteúdo principal 
    ?>
    <main>

        <?php // ################# Quebra do template ################# 
        ?>