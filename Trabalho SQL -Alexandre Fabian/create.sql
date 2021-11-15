create table cliente
(id_cliente number constraint pk_cliente primary key, 
nome varchar2(25),
email varchar2(25), 
telefone varchar2(10)
);

create table produto
(id_produto number constraint pk_produto primary key, 
 genero varchar2(25),
 nome varchar2(25),
 volume number,
 quantidade_disponivel number,
 quantidade_estoque number
);

create table emprestimo
(id_emprestimo number constraint pk_pedido primary key,
 id_cliente number,
 id_produto number,
 data_emprestimo date, 
 data_entrega date
);


create sequence s_cliente start with 100 nocache;

create sequence s_produto start with 1000 nocache;

create sequence s_emprestimo start with 10000 nocache;
