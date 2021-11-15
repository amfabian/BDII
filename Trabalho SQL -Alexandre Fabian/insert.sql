insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Alexandre', 'xandy.fabian@gmail.com', '9999-1111');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Vinicius', 'vinicius@gmail.com', '9999-2222');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Marcelo', 'marcelo@gmail.com', '9999-3333');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Maite', 'maite@gmail.com', '9999-4444');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Marlon', 'marlon@gmail.com', '9999-5555');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Julia', 'julia@gmail.com', '9999-7777');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Daniela', 'daniela@gmail.com', '9999-8888');
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, 'Arthur', 'arthur@gmail.com', '9999-9999');






insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Boku no Hero', 1,  0, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Boku no Hero', 2,  0, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Boku no Hero', 3,  0, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Kimetsu no Yaiba', 1,  10, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Kimetsu no Yaibao', 2,  10,  10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Kimetsu no Yaiba', 3,  10, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Kimetsu no Yaiba', 4,  10, 10);

insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shoujo', 'Ao Haru Ride', 1,  0, 5);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Ao Haru Ride', 2,  5, 5);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Sakura Card Captor', 1,  10, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Sakura Card Captor', 2,  10, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Shonen', 'Sakura Card Captor', 3,  10, 10);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Seinen', 'Battle Angel Alita', 1,  3, 3);
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(s_produto.nextval, 'Seinen', 'Battle Angel Alita', 2,  3, 3);









insert into emprestimo(id_emprestimo, id_cliente, id_produto, data_emprestimo, data_entrega) 
values(s_emprestimo.nextval, 100, 1000, to_date('01/06/2018 11:00','dd/mm/yyyy hh24:mi'), to_date('04/06/2018 16:00','dd/mm/yyyy hh24:mi'));

insert into emprestimo(id_emprestimo, id_cliente, id_produto, data_emprestimo, data_entrega) 
values(s_emprestimo.nextval, 101, 1003, to_date('01/07/2018 11:00','dd/mm/yyyy hh24:mi'), to_date('04/07/2018 16:00','dd/mm/yyyy hh24:mi'));

insert into emprestimo(id_emprestimo, id_cliente, id_produto, data_emprestimo, data_entrega) 
values(s_emprestimo.nextval, 102, 1007, to_date('01/08/2018 11:00','dd/mm/yyyy hh24:mi'), to_date('04/08/2018 16:00','dd/mm/yyyy hh24:mi'));

insert into emprestimo(id_emprestimo, id_cliente, id_produto, data_emprestimo, data_entrega) 
values(s_emprestimo.nextval, 105, 1009, to_date('01/08/2018 11:00','dd/mm/yyyy hh24:mi'), NULL);


