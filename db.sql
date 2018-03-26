#Database eshop creation

CREATE DATABASE IF NOT EXISTS eshop DEFAULT CHARACTER SET utf8 COLLATE = utf8_bin;

#Table creation

CREATE TABLE `eshop` . `users` (
	id int unsigned auto_increment primary key,
	username VARCHAR(255) ,
    `name` VARCHAR(255) ,
    `password` VARCHAR(255)
) engine = InnoDB default character set  = utf8 collate = utf8_bin;