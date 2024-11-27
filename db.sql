create database pizzaria;

use pizzaria;

create table clientes(
    id INT (11) NOT NULL,
    nome_cliente VARCHAR(100) NOT NULL,
    telefone_cliente VARCHAR (20) NOT NULL,
    endereco_cliente TEXT NOT NULL
);

create table pedidos(
    id int(11) NOT NULL,
    cliente_id int(11) not NULL,
    sabor_pizza VARCHAR(100) not null,
    quantidade_pizza INT(11) not null,
    observacao text DEFAULT NULL,
    status varchar(20) DEFAULT 'A fazer'
)


create table pizzas (
    id int(11) NOT NULL,
    sabor_pizza VARCHAR(255) NOT NULL,
)

ALTER TABLE clientes 
add primary key(id);

ALTER TABLE pedidos
add primary key(id),
add key cliente_id(cliente_id),

alter table pizzas
add primary key (id),

alter table clientes
modify id int(11) not null AUTO_INCREMENT,

alter table pedidos
modify id int(11) not null AUTO_INCREMENT,

alter table pizzas
modify id int(11) not null AUTO_INCREMENT,

alter table pedidos
add constraint pedidos_ibfk_1 FOREIGN KEY (cliente_id) REFERENCES clientes (id),
