CREATE DATABASE exercice_3;
USE exercice_3;

CREATE TABLE movies (
id integer unsigned auto_increment primary key,
title VARCHAR(255) NOT NULL,
actors VARCHAR(255),
director VARCHAR(255),
producer VARCHAR(255),
year_of_prod YEAR,
`language` VARCHAR(40),
category ENUM ('Comedy', 'Drama'),
storyline TEXT,
video VARCHAR(255)

) ENGINE = INNODB CHARACTER SET UTF8 COLLATE UTF8_BIN;