INSERT into Cliente(id, username, passwd, nombre, apellidos, email, domicilio, monedero, fechaCreacion, fechaModificacion, Cesta_id) 
VALUES(343434, 'papu', '123412341234123', 'Pepe', 'Hernandez Machado', 'papu@hotmail.com', 'Calle falsa 123', '240', '2018/07/07', '2018/09/09', NULL);

SELECT * 
FROM Cliente;


use BD_Tienda;

drop database BD_Tienda;