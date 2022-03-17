<?php

// Formata o título da página
if ($page_title == "") :

    // Se não definiu um title, usa o formato abaixo:
    $page_title = $site['name'] . ' ~ ' . $site['slogan'];
else :

    // Se definiu um title, usa o formato abaixo:
    $page_title = $site['name'] . " ~ " . $page_title;
endif;

// Formata a lista de redes sociais do footer
$social_list = '<ul>';

// Itera cada rede social
foreach ($social as $key => $value) :

    // Converte o nome da rede social com primeira letra maiúscula
    $key = ucfirst($key);

    // Adiciona a rede social à lista
    $social_list .= <<<HTML
    <li><a href="{$value}" target="_blank" title="Siga-nos no {$key}.">{$key}</a></li>\n
HTML;

endforeach;

// Fecha a lista de redes sociais
$social_list .= '</ul>';

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/favicon.png">
    <title><?php echo $page_title; ?></title>
    <style>
        <?php echo $site['css'] ?>
    </style>
    <link rel="stylesheet" href="/style.css">
</head>

<body>

    <a id="top"></a>

    <div class="wrap">

    <?php // Cabeçalho 
    ?>
    <header>

        <a href="/"><img src="<?php echo $site['logo'] ?>" alt="Logotipo de <?php echo $site['name']; ?>"></a>
        <h1><?php echo $site['name']; ?><small><?php echo $site['slogan'] ?></small></h1>

    </header>

    <?php // Menu principal 
    ?>
    <nav>

        <a href="/"><?php if ($page_menu == 'index') echo "<strong>INÍCIO</strong>";
                    else echo "Início"; ?></a>
        &bull;
        <a href="/page/articles.php"><?php if ($page_menu == 'articles') echo "<strong>ARTIGOS</strong>";
                                        else echo "Artigos"; ?></a>
        &bull;
        <a href="/page/contacts.php"><?php if ($page_menu == 'contacts') echo "<strong>FAÇA CONTATO</strong>";
                                        else echo "Faça Contato"; ?></a>
        &bull;
        <a href="/page/about.php"><?php if ($page_menu == 'about') echo "<strong>SOBRE</strong>";
                                    else echo "Sobre"; ?></a>

        <?php if (!isset($_COOKIE['user'])) : ?>
            &bull;
            <a href="/user/new.php"><?php if ($page_menu == 'new') echo "<strong>CADASTRE-SE</strong>";
                                    else echo "Cadastre-se"; ?></a>

            &bull;
            <a href="/user/login.php"><?php if ($page_menu == 'login') echo "<strong>LOGUE-SE</strong>";
                                        else echo "Logue-se"; ?></a>
        <?php else : ?>

            &bull;
            <a href="/user/profile.php"><?php if ($page_menu == 'profile') echo "<strong>OLÁ {$user['first_name']}!</strong>";
                                        else echo "Olá {$user['first_name']}!"; ?></a>

        <?php endif; ?>
    </nav>

    <?php // Conteúdo principal 
    ?>
    <main>

        <?php // ################# Quebra do template ################# 
        ?>