<?php

// Configura a página de caracteres do PHP para UTF-8
// DEVE ser a primeira linha de código do site.
header("Content-type: text/html; charset=utf-8");

/**
 * Variáveis do tema
 */

// Nome do aplicativo
$site_name = "Decodificando";

// Slogan do site
$site_slogan = "Just Code it.";

// Logotipo do site
$site_logo = "/img/logo_decodificando.jpg";

// Proprietário do aplicativo (mensagem de copyright)
$site_owner = "Turma 2021.1";

// Define o título <title>...</title> de cada página
$page_title = "";

// Define o link ativo no menu principal
$page_menu = "";

// Define o fuso horário (opcional).
date_default_timezone_set('America/Sao_Paulo');