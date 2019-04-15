SELECT * 
FROM Cliente;

SELECT * 	
FROM Empleado;


use BD_Tienda;

drop database bd_tienda;

/*INSERTS CLIENTES*/

delete from Cliente
where 1=1;
show variables;
set sql_safe_updates = 0;


/*Hacer inserts de clientes desde el sign up*/

INSERT INTO Empleado (id, username, passwd, nombre, apellidos, email, photopath, cargo, isAdministrador) 
VALUES ('EMP:000000005022630e0000000012d81fbf', 'burns', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Señor', 'Señor Burns', 'holahola@gmail.com', './/img/externos/1.jpg', 'ventas', '1');



/*INSERTS EMPLEADOS*/



