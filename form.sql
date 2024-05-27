create database form;
use form;
create table queja(
idqueja int auto_increment primary key,
nombre varchar(50)  not null,
correE varchar(25) not null,
mensaje varchar(200) not null
);
create table sugerencia(
idsug int auto_increment primary key,
nombre varchar(50)  not null,
correE varchar(25) not null,
mensaje varchar(200) not null
);
create table duda(
idduda int auto_increment primary key,
nombre varchar(50)  not null,
correE varchar(25) not null,
mensaje varchar(200) not null
);
select * from queja;
select * from duda;
select * from sugerencia;