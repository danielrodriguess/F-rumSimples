create database testephp;

use testephp

create table usuario(nome varchar(65) not null, email varchar(100) primary key not null,senha varchar(16) not null,pergunta varchar(160) not null,resposta varchar(55) not null, tipo varchar(20) not null, datadenascimento varchar(11));

create table moderador(id int primary key auto_increment,email varchar(100),titulo varchar(255),post varchar(255),status varchar(20),dataa varchar(11));

create table comentario (idcom int primary key auto_increment,id int not null,nome varchar(100),email varchar(100),post varchar(255),status varchar(20));

create table sugestoes(id int primary key auto_increment,email varchar(100),sugestao varchar(255),status varchar(20));

ALTER DATABASE testephp CHARSET = UTF8 COLLATE = utf8_general_ci;

ALTER DATABASE `testephp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;