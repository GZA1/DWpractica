SELECT * 
FROM Cliente;


use BD_Tienda;

drop database BD_Tienda;

/*INSERTS CLIENTES*/

INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, monedero, fechaCreacion, fechaModificacion, Cesta_id) 
VALUES(343434, 'papu', '123412341234123', 'Pepe', 'Hernandez Machado', 'papu@hotmail.com', 'Calle falsa 123', '240', '2018/07/07', '2018/09/09', NULL);


INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, monedero, fechaCreacion, fechaModificacion, Cesta_id) 
VALUES(894589, 'Vito', 'adsasfsasfasfdf', 'Migue', 'Vito itoV', 'itoV@hotmail.com', 'Calle falsa 321', '666', '2015/07/07', '2018/10/09', NULL);

INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, monedero, fechaCreacion, fechaModificacion, Cesta_id) 
VALUES(997778, 'Jaime', 'ubvue7764n', 'Pepe', 'Hernandez Machado', 'Jaime@hotmail.com', 'Calle falsa 13', '240', '2016/07/15', '2018/09/25', NULL);




/*INSERTS EMPLEADOS*/



