SELECT * FROM Cliente;
SELECT * FROM Empleado;
SELECT * FROM Ubicacion;
select * from tienda;
select * from cesta;
select * from pedido;

use BD_Tienda;

drop database bd_tienda;

/*INSERTS CLIENTES*/

delete from Cliente
where 1=1;
show variables;
set sql_safe_updates = 0;


/*Almacen central*/

INSERT INTO Tienda (nombre, direccion, email, Ubicacion_idUbicacion) VALUES ('Almacén Central', 'Avenida del Almacén Central 1', 'almcentral@empresa.com', 32836); /*Está en Madrid el almacén central*/

/*Usuario Administrador*/


INSERT INTO Empleado (id, username, passwd, nombre, apellidos, email, photopath, cargo, isAdministrador, Tienda_id) 
VALUES ('EMP:000000005022630e0000000012d81fbf', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Juan Carlos', 'Perez Monsetti', 'JCPM@gmail.com', './/img/externos/1.jpg', 'encargado', 1, 1);

/*Hacer inserts de clientes desde el sign up*/

/*Pruebas histoprial de pedidos etc...*/
/*Insertamos aquí un cliente con cestas y, por lo tanto, pedidos asociados que, al no haber lógica de productos todavía, son solo de prueba*/

insert into cliente (id, username, passwd, nombre, apellidos, email, domicilio, Ubicacion_idUbicacion) 
values ('CLI:000000004029530e0000000014d11trs', 'cli1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Cliente', 'Numero Uno', 'cli1@gmail.com', 'Calle Mayor 15', 16238);#cli1 es de Cuéllar
insert into cesta (costeTotal, Cliente_id) values (25, 'CLI:000000004029530e0000000014d11trs'), (12, 'CLI:000000004029530e0000000014d11trs');
insert into pedido (estado, Cesta_id) values ('procesando', 1), ('completado', 2);
