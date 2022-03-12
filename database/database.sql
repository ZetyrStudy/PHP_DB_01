-- *******************************************
-- Cria/descreve banco de dados do aplicativo.
-- *******************************************

-- *******************************  ATENÇÃO! *************************************
-- Este arquivo deve ser APAGADO quando aplicativo for para o nível de "produção".
-- *******************************************************************************

-- Apaga o banco de dados caso ele exista.
DROP DATABASE IF EXISTS php_app;

-- Cria banco de dados usando a tabela de caracters UTF-8 e buscas case-insensitive.
CREATE DATABASE php_app CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Selecionar o banco de dados criado.
USE php_app;

-- Cria tabela para armazenar os contatos.
CREATE TABLE contacts (
    contact_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    contact_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    contact_name VARCHAR(255) NOT NULL,
    contact_email VARCHAR(255) NOT NULL,
    contact_subject VARCHAR(255) NOT NULL,
    contact_message TEXT NOT NULL,
    contact_status ENUM('unread', 'read', 'replied', 'deleted') NOT NULL DEFAULT 'unread'
);

-- Cria tabela com aautores dos artigos.
CREATE TABLE authors (
    author_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    author_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    author_name VARCHAR(255) NOT NULL,
    author_email VARCHAR(255) NOT NULL,
    author_photo VARCHAR(255) NOT NULL,
    author_birth DATE NOT NULL,
    author_profile TEXT NOT NULL,
    author_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);

-- Cria tabela para armazenar os artigos do aplicativo.
CREATE TABLE articles (
    article_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    article_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    article_title VARCHAR(127) NOT NULL,
    article_image VARCHAR(255) NOT NULL COMMENT 'Caminho absoluto da imagem.',
    article_intro VARCHAR(255) NOT NULL,
    article_body LONGTEXT NOT NULL,
    article_author INT NOT NULL,
    article_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on',
    FOREIGN KEY (article_author) REFERENCES authors (author_id)
);

-- Cria tabela para armazenar as confgurações do aplicativo.
CREATE TABLE config (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    var VARCHAR(127) NOT NULL,
    val TEXT NOT NULL,
    descrition VARCHAR(255) COMMENT 'Descrição da variável'
);

-- Cria tabela de cadastro de usuários.
CREATE TABLE users (
    user_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_name VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_birth DATE NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);

-- Teste de inserção na tabela 'contacts'.
INSERT INTO `contacts` (
    `contact_name`,
    `contact_email`,
    `contact_subject`,
    `contact_message`
) VALUES (
    'Joca da Silva',
    'joca@silva.com',
    'Teste de contato do Joca.',
    'Mensagem de contato do Joca.'
);

-- Insere alguns autores para testes
INSERT INTO `authors` (
    `author_name`,
    `author_email`, 
    `author_photo`, 
    `author_birth`, 
    `author_profile`
) VALUES (
    'Joca da Silva',
    'joca@silva.com', 
    'https://randomuser.me/api/portraits/lego/5.jpg', 
    '2012-03-08', 
    'Programador, consertador, agricultor, pescador e experimentador de coisas inúteis.'
), (
    'Setembrino Trocatapas',
    'set@brino.com', 
    'https://randomuser.me/api/portraits/lego/6.jpg', 
    '2009-11-18', 
    'Consertdor, escrev erdor e arrumador de confusão.'
), (
    'Marineuza Siriliano',
    'mari@siri.com', 
    'https://randomuser.me/api/portraits/lego/3.jpg', 
    '2010-01-25', 
    'Doutora, consertadora de pessoas quebradas.'
), (
    'Emengarda Sirigarda',
    'emenda@siri.com', 
    'https://randomuser.me/api/portraits/lego/2.jpg', 
    '1098-06-14', 
    'Controladora de tráfego de ratos nas vias de esgoto.'
);

-- Insere alguns artigos para testes.
INSERT INTO `articles` (
    `article_date`,
    `article_title`, 
    `article_image`, 
    `article_intro`, 
    `article_body`, 
    `article_author`
) VALUES (
    '2022-03-01 10:44:00',
    'Primeiro artigo do site',
    'https://picsum.photos/200', 
    'Este é o primeiro artigo que escrevemos para este site sem sentido.', 
    '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil obcaecati id recusandae minus porro laudantium rem. Similique repellendus incidunt ad labore unde voluptates, recusandae at, expedita magnam iure facere quia?</p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum aperiam laboriosam enim harum accusantium quae mollitia repellendus illum, consequuntur impedit possimus, hic quas reiciendis odit! Incidunt harum blanditiis ullam sunt!</p><h3>Links:</h3><ul> <li><a href="http://catabits.com.br" target="_blank">Site do Fessô</a></li> <li><a href="https://americanas.com" target="_blank">Site Hackeado</a></li> <li><a href="https://www.rj.senac.br" target="_blank">Senac RJ</a></li></ul><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque quod suscipit ratione commodi, corrupti tempore mollitia accusantium in eligendi dolores dicta dolore, accusamus tenetur omnis, dolor ducimus! Iure, ad ea!</p><div> <img src="https://picsum.photos/400/200" alt="Imagem aleatória"></div><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam maxime a saepe voluptatum laborum magnam, temporibus blanditiis aspernatur, nihil vero consequuntur quidem perferendis aliquam. Rem voluptatibus consequuntur neque ex explicabo!</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores amet fugiat possimus quae voluptates animi placeat. Veniam aut corporis cumque explicabo perspiciatis voluptatem, molestiae eveniet beatae eligendi ipsam. Harum, facilis?</p>', 
    '1'
);

INSERT INTO `articles` (
    `article_date`,
    `article_title`, 
    `article_image`, 
    `article_intro`, 
    `article_body`, 
    `article_author`
) VALUES (
    '2022-03-02 10:44:00',
    'Mais um artigo para o site',
    'https://picsum.photos/201', 
    'Mais um artigo legal e inútil para nosso novo site.', 
    '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil obcaecati id recusandae minus porro laudantium rem. Similique repellendus incidunt ad labore unde voluptates, recusandae at, expedita magnam iure facere quia?</p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum aperiam laboriosam enim harum accusantium quae mollitia repellendus illum, consequuntur impedit possimus, hic quas reiciendis odit! Incidunt harum blanditiis ullam sunt!</p><h3>Links:</h3><ul> <li><a href="http://catabits.com.br" target="_blank">Site do Fessô</a></li> <li><a href="https://americanas.com" target="_blank">Site Hackeado</a></li> <li><a href="https://www.rj.senac.br" target="_blank">Senac RJ</a></li></ul><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque quod suscipit ratione commodi, corrupti tempore mollitia accusantium in eligendi dolores dicta dolore, accusamus tenetur omnis, dolor ducimus! Iure, ad ea!</p><div> <img src="https://picsum.photos/400/200" alt="Imagem aleatória"></div><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam maxime a saepe voluptatum laborum magnam, temporibus blanditiis aspernatur, nihil vero consequuntur quidem perferendis aliquam. Rem voluptatibus consequuntur neque ex explicabo!</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores amet fugiat possimus quae voluptates animi placeat. Veniam aut corporis cumque explicabo perspiciatis voluptatem, molestiae eveniet beatae eligendi ipsam. Harum, facilis?</p>', 
    '2'
);

INSERT INTO `articles` (
    `article_date`,
    `article_title`, 
    `article_image`, 
    `article_intro`, 
    `article_body`, 
    `article_author`
) VALUES (
    '2022-03-03 10:44:00',
    'Descubra algo sobre alguma coisa',
    'https://picsum.photos/202', 
    'Neste artigo sobre alguma coisa, aprenderemos algo mais sobre essa coisa.', 
    '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil obcaecati id recusandae minus porro laudantium rem. Similique repellendus incidunt ad labore unde voluptates, recusandae at, expedita magnam iure facere quia?</p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum aperiam laboriosam enim harum accusantium quae mollitia repellendus illum, consequuntur impedit possimus, hic quas reiciendis odit! Incidunt harum blanditiis ullam sunt!</p><h3>Links:</h3><ul> <li><a href="http://catabits.com.br" target="_blank">Site do Fessô</a></li> <li><a href="https://americanas.com" target="_blank">Site Hackeado</a></li> <li><a href="https://www.rj.senac.br" target="_blank">Senac RJ</a></li></ul><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque quod suscipit ratione commodi, corrupti tempore mollitia accusantium in eligendi dolores dicta dolore, accusamus tenetur omnis, dolor ducimus! Iure, ad ea!</p><div> <img src="https://picsum.photos/400/200" alt="Imagem aleatória"></div><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam maxime a saepe voluptatum laborum magnam, temporibus blanditiis aspernatur, nihil vero consequuntur quidem perferendis aliquam. Rem voluptatibus consequuntur neque ex explicabo!</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores amet fugiat possimus quae voluptates animi placeat. Veniam aut corporis cumque explicabo perspiciatis voluptatem, molestiae eveniet beatae eligendi ipsam. Harum, facilis?</p>', 
    '1'
);

INSERT INTO `articles` (
    `article_date`,
    `article_title`, 
    `article_image`, 
    `article_intro`, 
    `article_body`, 
    `article_author`
) VALUES (
    '2022-03-04 10:44:00',
    'Como fazer alguma coisa',
    'https://picsum.photos/199', 
    'Ainda sobre alguma coisa, aprenda a fazer essa alguma coisa.', 
    '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil obcaecati id recusandae minus porro laudantium rem. Similique repellendus incidunt ad labore unde voluptates, recusandae at, expedita magnam iure facere quia?</p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum aperiam laboriosam enim harum accusantium quae mollitia repellendus illum, consequuntur impedit possimus, hic quas reiciendis odit! Incidunt harum blanditiis ullam sunt!</p><h3>Links:</h3><ul> <li><a href="http://catabits.com.br" target="_blank">Site do Fessô</a></li> <li><a href="https://americanas.com" target="_blank">Site Hackeado</a></li> <li><a href="https://www.rj.senac.br" target="_blank">Senac RJ</a></li></ul><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque quod suscipit ratione commodi, corrupti tempore mollitia accusantium in eligendi dolores dicta dolore, accusamus tenetur omnis, dolor ducimus! Iure, ad ea!</p><div> <img src="https://picsum.photos/400/200" alt="Imagem aleatória"></div><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam maxime a saepe voluptatum laborum magnam, temporibus blanditiis aspernatur, nihil vero consequuntur quidem perferendis aliquam. Rem voluptatibus consequuntur neque ex explicabo!</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores amet fugiat possimus quae voluptates animi placeat. Veniam aut corporis cumque explicabo perspiciatis voluptatem, molestiae eveniet beatae eligendi ipsam. Harum, facilis?</p>', 
    '1'
);

-- Insere registros na tabela config
INSERT INTO config ( var, val, descrition ) VALUES
('site_name', 'Decodificando', 'Nome do aplicativo'),
('site_slogan', 'Just Code it.', 'Slogan do aplicativo'),
('site_logo', '/img/logo_decodificando.png', 'Logotipo do aplicativo'),
('site_owner', 'Turma 2021.1', 'Proprietário do aplicativo'),
('social_facebook', 'https://facebook.com/Decodificando', 'Rede social'),
('social_github', 'https://github.com/Decodificando', 'Rede social'),
('social_whatsapp', 'https://wa.me/5521987654321', 'Rede social'),
('social_youtube', 'https://youtube.com/Decodificando', 'Rede social'); 

-- Insere registros na tabela 'users'
INSERT INTO users (
    user_name,
    user_email,
    user_birth,
    user_password
) VALUES 
(
    'Joca da Silva',
    'joca@silva.com',
    '2001-10-12',
    SHA2('1234567890', 512)
),
(
    'Setembrino Trocatapas',
    'set@brino.com',
    '1998-02-18',
    SHA2('1234567890', 512)
),
(
    'Edicleuza Sirineuza',
    'edi@siri.com',
    '2010-09-25',
    SHA2('1234567890', 512)
)