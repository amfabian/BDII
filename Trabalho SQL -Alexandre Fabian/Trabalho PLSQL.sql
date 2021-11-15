

/*Aluno Alexandre de Mesquita Fabian. 

Aluguel de Mangás (HQs)

*/

--------------------------------

--PACKAGE

--Function para emprestar manga.
--Recebe o id do cliente, recebe o id do produto, recebe a data atual.
--Verifica se o cliente não possui nemhum outro manga emprestado, -- NAO IMPLEMENTADO
--Verifica se o manga escolhido tem unidade disponivel --NAO IMPLEMENTADO
--Empresta.
create or replace package pkg_func is

FUNCTION EMPRESTA_MANGA RETURN VARCHAR2;
FUNCTION RETORNA_MANGA RETURN VARCHAR2;
FUNCTION VERIFICA_MANGA RETURN VARCHAR2;
FUNCTION VERIFICA_VOLUMES RETURN VARCHAR2;
END;
/

create or replace package body pkg_func as



--Function para emprestar manga.
--Recebe o id do cliente, recebe o id do produto, recebe a data atual.
--Empresta.

CREATE OR REPLACE FUNCTION EMPRESTA_MANGA (p_id_cliente IN NUMBER, p_id_produto IN NUMBER, p_data IN VARCHAR2) RETURN VARCHAR2
IS
v_manga NUMBER (10) := 0;
BEGIN


insert into emprestimo(id_emprestimo, id_cliente, id_produto, data_emprestimo, data_entrega) 
values(s_emprestimo.nextval, p_id_cliente, p_id_produto, p_data, NULL);

RETURN 'MANGA EMPRESTADO'
END;



variable v_c VARCHAR2;

EXEC :v_c := EMPRESTA_MANGA(106, 1012, '01/01/2020');
Print v_c;



--Function para retorno de emprestimo
--Recebe o id do emprestimo.
--Add data de entrega e devolve unidade na quantidade_disponivel da tabela produto.

CREATE OR REPLACE FUNCTION RETORNO_MANGA (p_id_emprestimo IN NUMBER, p_data IN VARCHAR2) RETURN VARCHAR2
IS

BEGIN

UPDATE emprestimo
SET data_entrega = p_data
WHERE id_emprestimo = p_id_emprestimo;

RETURN 'MANGA ENTREGUE';
END;


variable v_b VARCHAR2;

EXEC :v_b := RETORNO_MANGA(10000, '31/12/2020');
Print v_b;



--Funciton para verificacao de disponibilidade
--recebe o id do produto (manga)
--Verifica se existe disponibildade e retorna resultado.

CREATE OR REPLACE FUNCTION VERIFICA_MANGA (p_id_produto IN NUMBER) RETURN VARCHAR2
IS
v_manga NUMBER (10) := 0;

BEGIN

SELECT quantidade_disponivel
INTO v_manga
FROM produto
WHERE id_produto = p_id_produto;

IF v_manga = 0 THEN
DBMS_OUTPUT.PUT_LINE('Em falta');
ELSE
DBMS_OUTPUT.PUT_LINE('Temos disponibilidade');

END IF;

RETURN v_manga;
END;


variable v_d NUMBER;

EXEC :v_d := VERIFICA_MANGA(1003);
Print v_d;




--Funcioton para verificacao de volumes
--Recebe o nome do manga
--Imprime os volumes e suas disponibilidades


CREATE OR REPLACE FUNCTION VERIFICA_VOLUMES (p_nome IN VARCHAR2) RETURN VARCHAR2
IS


CURSOR c_volumes IS 
SELECT nome, volume, quantidade_disponivel
FROM produto;

v_nome produto.nome%TYPE;
v_volume produto.volume%TYPE;
v_quantidade_disponivel produto.quantidade_disponivel%TYPE;

BEGIN
OPEN c_volumes;

LOOP
FETCH c_volumes INTO v_nome, v_volume,v_quantidade_disponivel;
IF c_volumes%NOTFOUND
THEN
EXIT;
END IF;
IF v_nome = p_nome THEN
DBMS_OUTPUT.PUT_LINE('Nome: ' ||v_nome ||' Volume: ' || v_volume ||' Quantidade: ' || v_quantidade_disponivel );
--DBMS_OUTPUT.PUT_LINE(v_volume);
--DBMS_OUTPUT.PUT_LINE(v_quantidade_disponivel);

END IF;

END LOOP;
CLOSE c_volumes;


RETURN p_nome;
END;

end pkg_func;
/

variable v_a VARCHAR2;

EXEC :v_a := VERIFICA_VOLUMES('Boku no Hero');
Print v_a;



------------------------------------

--Procedures


--Procedure para verificar quantos mangas estao indisponiveis
--Apresenta a quantidade de mangas indisponiveis



CREATE OR REPLACE PROCEDURE manga_indisponivel 
IS 
v_count NUMBER (10) := 0;
--PARA OBTER A QUANTIDADE DE MANGAS COM 0 EM quantidade_disponivel
BEGIN
SELECT count (id_produto)
INTO v_count
FROM produto
WHERE quantidade_disponivel = 0;

DBMS_OUTPUT.PUT_LINE(' QUANTIDADE DE MANGAS INDISPONIVEIS: '||v_count);

END;


--Procedure para verificar os clientes com mangas
--Recebe a tabela emprestimos (DESNCESSARIO????)
--Verifica quais estao sem data de entrega
--Apresenta o id dos clientes que estao com mangas
CREATE OR REPLACE PROCEDURE clientes_com_emprestimos
IS 
CURSOR c_clientes IS 
SELECT id_cliente, data_entrega 
FROM emprestimo;

v_id_cliente emprestimo.id_cliente%TYPE;
v_data_entrega emprestimo.data_entrega%TYPE;

BEGIN
OPEN c_clientes;

LOOP
FETCH c_clientes INTO v_id_cliente,v_data_entrega;
IF c_clientes%NOTFOUND
THEN
EXIT;
END IF;
IF v_data_entrega IS NULL THEN
DBMS_OUTPUT.PUT_LINE('Cliente com Manga ID '||v_id_cliente);

END IF;

END LOOP;
CLOSE c_clientes;


END;
--Procedure para acrescentar novo manga
--Recebe o genero, nome, volume, quantidade
--Adiciona na tabela produto e retorna o id do novo manga.

CREATE OR REPLACE PROCEDURE novo_manga (p_genero IN VARCHAR, p_nome IN VARCHAR, p_volume IN NUMBER, p_quantidade IN NUMBER, p_id OUT NUMBER) 
IS 

BEGIN
p_id := s_produto.nextval; --guarda o valor para saida
insert into produto(id_produto, genero, nome, volume, quantidade_disponivel, quantidade_estoque) values(p_id, p_genero, p_nome, p_volume,  p_quantidade, p_quantidade);
END;

variable v1 NUMBER;
EXEC novo_manga('Shoujo', 'Orange', 1, 5, :v1);
print v1;

--Procedure para acrescentar novo cliente
--Recebe o nome, email e telefone
--Adiciona na tabela cliente e retorna o id do novo cliente

CREATE OR REPLACE PROCEDURE novo_cliente (p_nome IN VARCHAR, p_email IN VARCHAR, p_telefone IN VARCHAR2, p_id OUT NUMBER) 
IS 

BEGIN
--INSERT
insert into cliente(id_cliente, nome, email, telefone) values(s_cliente.nextval, p_nome, p_email, p_telefone);

----guarda o valor para saida de outra maneira.
SELECT id_cliente
INTO p_id
FROM cliente
WHERE nome = p_nome;

END;

variable v2 NUMBER;
EXEC novo_cliente('Thales', 'thales@gmail.com', '9999-1234', :v2);
print v2;
