SELECT * 
FROM Cliente;


use BD_Tienda;

drop database bd_tienda;

/*INSERTS CLIENTES*/

delete from Cliente
where 1=1;
show variables;
set sql_safe_updates = 0;


INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, saldo, Cesta_id) 
VALUES('CLI:estoesunuuid', 'papu', '123412341234123', 'Pepe', 'Hernandez Machado', 'papu@hotmail.com', 'Calle falsa 123', '240', NULL);


INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, saldo, Cesta_id) 
VALUES('CLI:estoesunuuid2', 'Vito', 'adsasfsasfasfdf', 'Migue', 'Vito itoV', 'itoV@hotmail.com', 'Calle falsa 321', '666', NULL);

INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, saldo, Cesta_id) 
VALUES('CLI:estoesunuuid3', 'Jaime', 'ubvue7764n', 'Pepe', 'Hernandez Machado', 'Jaime@hotmail.com', 'Calle falsa 13', '240', NULL);




/*INSERTS EMPLEADOS*/



