DROP DATABASE IF EXISTS `post_for`;

CREATE DATABASE `post_for`
CHARACTER SET UTF8 COLLATE utf8_general_ci;

/* POUZIVATEL, OPRAVNENIA + PREPOJENIA*/
CREATE TABLE `roles`(
    `id` INT AUTO_INCREMENT NOT NULL,
    `role` varchar(30) NOT NULL,
    
    PRIMARY KEY (`id`)
    ) ENGINE = INNODB DEFAULT CHARSET=utf8;
    
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `name` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(50) NOT NULL,
    `img` varchar(100) DEFAULT NULL,
    `bio` TEXT DEFAULT NULL,
    `registration_date` DATE,
    PRIMARY KEY (`id`),
    UNIQUE (`email`)
    ) ENGINE =INNODB DEFAULT CHARSET= utf8;

CREATE TABLE `user_role` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `id_user` INT NOT NULL,
    `id_role` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`),
    FOREIGN KEY (`id_role`) REFERENCES `roles`(`id`)
) ENGINE= INNODB DEFAULT CHARSET= utf8;

/*CLANKY, KATEGORIE
    -KATEGORIE SU ZJEDNODUSENE, NA SPRESNENIE
     VYHLADAVANIA BUDU SLUZIT TAGY
 */
CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(50),
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `articles` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `id_user` INT NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `img` VARCHAR(100) DEFAULT NULL,
    `article` TEXT NOT NULL,
    `date` DATE,
    
    `abstract` TEXT NOT NULL,
    `category` INT NOT NULL,
    `checked` BOOLEAN,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`),
    FOREIGN KEY (`category`) REFERENCES `categories`(`id`)
    ) ENGINE= INNODB DEFAULT CHARSET= utf8;

/* TAGY */
CREATE TABLE `tag` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(50),
    PRIMARY KEY (`id`)
) ENGINE = INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `article_tag` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `id_article` INT NOT NULL,
    `id_tag` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_article`) REFERENCES `articles`(`id`),
    FOREIGN KEY (`id_tag`) REFERENCES `tag`(`id`)
) ENGINE = INNODB DEFAULT CHARSET=utf8;


/*KOMENTARE-SUBKOMENTARE + PREPOJENIE */
CREATE TABLE `comments` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `id_user` INT NOT NULL,
    `comment` text NOT NULL,
    `date` DATE,
    `id_article` INT NOT NULL,
    `parent` INT DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`),
    FOREIGN KEY (`id_article`) REFERENCES `articles`(`id`),
    FOREIGN KEY (`parent`) REFERENCES `comments`(`id`)
)  ENGINE=INNODB DEFAULT CHARSET = utf8;

INSERT INTO articles (`id_user`, `title`, `article`, `date`, `abstract`, `category`)
VALUES ((select id from users where name='Alenvei'), 'PHP', ' <p>You’re not imagining things: Some JavaScript web apps are quite slow, owing to egregiously high startup, parsing, and data transfer overhead. According to HTTPArchive, which periodically crawls popular websites and records information about fetched resources, the average page requires 350KB of JavaScript (10% of pages exceed 1MB). And once these pages are transferred, JavaScript engines must check for syntax errors and compile them (assuming they aren’t cached). That takes around 100 milliseconds for a 1MB file on a high-end mobile device, or over a second on an average phone.A solution potentially lies in BinaryAST, a new “over-the-wire” JavaScript format proposed by Mozilla (with support from Facebook, Bloomberg, and others) that aims to speed up parsing while retaining JavaScript’s original semantics. How? By using an efficient binary representation for code and data structures and by storing and providing guiding information to the parser ahead of time. While the format remains somewhat in flux, the first version of the client was released under a flag in Firefox Nightly several months ago, and content delivery service Cloudflare recently became one of the first to provide the necessary cloud-hosted JavaScript engine in its Cloudflare Workers execution environment.</p> ',
 '13.6.2019', 'blblbl', (select id from categories where name='PHP'));

 INSERT INTO categories (`name`)
 VALUES ('PHP');