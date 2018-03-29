#Database eshop creation

CREATE DATABASE IF NOT EXISTS eshop DEFAULT CHARACTER SET utf8 COLLATE = utf8_bin;

#Table creation

CREATE TABLE IF NOT EXISTS `eshop` . `users` (
	id int unsigned auto_increment primary key,
	username VARCHAR(255) ,
    `name` VARCHAR(255) ,
    `password` VARCHAR(255)
) engine = InnoDB default character set  = utf8 collate = utf8_bin;

CREATE TABLE IF NOT EXISTS `eshop` . `articles` (
	id int unsigned auto_increment primary key,
	`name` VARCHAR(255) ,
    description VARCHAR(255) ,
    image VARCHAR(255)
) engine = InnoDB default character set  = utf8 collate = utf8_bin;

CREATE TABLE IF NOT EXISTS `eshop` . `cart` (
	id int unsigned auto_increment primary key,
    article_id int unsigned,
    description VARCHAR(255),
	foreign key (article_id) references eshop.articles(id)
) engine = InnoDB default character set  = utf8 collate = utf8_bin;

