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

    <div style="height: 10vh; width: 100%"></div>
    <form method="POST"  style="display: block">

        <label>Username</label>
        <input type="text" name="username">
        <label>Passwd</label>
        <input type="text" name="passwd">
        <label>Nombre</label>
        <input type="text" name="nombre">
        <label>Apellidos</label>
        <input type="text" name="apellidos">
        <label>Email</label>
        <input type="text" name="email">
        <label>Domicilio</label>
        <input type="text" name="domicilio">
        <label>Monedero</label>
        <input type="text" name="monedero">
        
        <input type="submit" value="NuevoUser">
    </form>
    
    <?php
        if( $_SERVER['REQUEST_METHOD']=='POST') {
            addCliente($_POST['username'], $_POST['passwd'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'],
            $_POST['domicilio'], $_POST['monedero']);
        }
    ?>
</body>
</html>