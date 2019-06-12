SELECT * FROM Usuario;
SELECT * FROM Cliente;
SELECT * FROM Empleado;
SELECT * FROM Ubicacion;
select * from tienda;
select * from cesta;
select * from pedido;
select * from categoria;
select * from producto;
select * from unidad;

use BD_Tienda;

drop database bd_tienda;

/*INSERTS CLIENTES*/

delete from Usuario
where idUsuario=2;
show variables;
set sql_safe_updates = 0;


/*Almacen central*/

INSERT INTO Tienda (nombre, direccion, email, Ubicacion_idUbicacion) VALUES ('Almacén Central', 'Avenida del Almacén Central 1', 'almcentral@empresa.com', 32836); /*Está en Madrid el almacén central*/

/*Usuarios*/
insert into Usuario (username, passwd, nombre, apellidos, email, tipo) values
	('admin', 	'7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Juan Carlos', 	'Perez Monsetti', 	'JCPM@gmail.com', 'empleado'),
    ('cli1', 	'7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Cliente', 		'Numero Uno', 		'cli1@gmail.com', 'cliente'	);

/*Usuario Administrador*/
INSERT INTO Empleado (id, photopath, cargo, isAdministrador, Tienda_id, Usuario_idUsuario) 
VALUES ('EMP:000000005022630e0000000012d81fbf', './/img/externos/1.jpg', 'encargado', 1, 1, 1);

/*Hacer inserts de clientes desde el sign up*/

/*Pruebas histoprial de pedidos etc...*/
/*Insertamos aquí un cliente con cestas y, por lo tanto, pedidos asociados que, al no haber lógica de productos todavía, son solo de prueba*/

insert into cliente (id, domicilio, Ubicacion_idUbicacion, Usuario_idUsuario) 
values ('CLI:000000004029530e0000000014d11trs', 'Calle Mayor 15', 16238, 2); #cli1 es de Cuéllar
insert into cesta (costeTotal, Cliente_id) values (25, 'CLI:000000004029530e0000000014d11trs'), (12, 'CLI:000000004029530e0000000014d11trs');
insert into pedido (estado, Cesta_id) values ('procesando', 1), ('completado', 2);

insert into categoria(nombre) values("CPU");


insert into categoria(nombre) values("RAM");

insert into categoria(nombre) values("GPU");

insert into categoria(nombre) values("DiscosDuros");

insert into Producto(nombre, marca, modelo, precio, categoria_id) values
	("Sandy Bridge", 	"Intel", 	"i7-2600k-2.9GHz", 		123.99, 1),
	("Kaby Lake", 		"Intel", 	"i7-7700-3.3GHz", 		348.99, 1),
	("Haswell", 		"Intel", 	"i5-4250H-2.3GHz", 		191.99, 1),
	("Vengance", 		"Corsair", 	"16GB-2400-CL14", 		223.99, 2),
	("FastSlim", 		"Kingston", "SODIMM-8GB-1600-CL15", 114.99, 2),
	("WR", 				"Corsair", 	"4GB-3200-CL16", 		162.99, 2);