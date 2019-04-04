<?php
require_once("/xampp/appdata/model/ClientePDO.php");


$usuarios = clientes_get_all();
?>

<html>
<head>
    
</head>
<body>
<table>
        <thead>
            <th>ID</th> 
            <th>USERNAME</th>
            <th>PASSWORD</th>            
            <th>NOMBRE</th> 
            <th>APELLIDOS</th>
            <th>EMAIL</th>
            <th>DOMICILIO</th>
            <th>MONEDERO</th>
            <th>FECHA CREACION</th>
            <th>FECHA MODIFICACION</th>
            <th>CESTA ID</th>
        </thead>
        <tbody>
            <?php foreach($usuarios as $u) : ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo $u['username']; ?></td>
                    <td><?php echo $u['passwd']; ?></td>
                    <td><?php echo $u['nombre']; ?></td>
                    <td><?php echo $u['apellidos']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                    <td><?php echo $u['domicilio']; ?></td>
                    <td><?php echo $u['monedero']; ?></td>
                    <td><?php echo $u['fechaCreacion']; ?></td>
                    <td><?php echo $u['fechaModificacion']; ?></td>
                    <td><?php echo $u['Cesta_id']; ?></td>
                    <!-- <td>
                        <a href="edit_client.php?id=<?php echo $u['id']?>">Editar</a>
                        <a href="delete_client.php?id=<?php echo $u['id']?>">Borrar</a>
                    </td> -->
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>
</html>