<div id="dashboard">
    <nav id="topSect">
        <div id="optsCfg">
            <div class="optCfg"><a style="display: inline-block;" id="optAddEMP" class="adminOpt">Registrar Empleado</a></div>
            <div class="optCfg"><a style="display: inline-block;" id="optAddSHOP" class="adminOpt">Añadir Tienda</a></div>

        </div>
    </nav>
    
    <div id="botSect">

        <!-- 1er Formulario-->
        <div id="registrarEmpleadoForm" class="configForm">
            <h3 style="margin: 0px 0 2vh 0;">Registrar Empleado</h3>
            <form method="post" id="rEMP">
                
                <label id="lUsername">Nombre de usuario</label>
                <input type="text" id="username" name="Username">
                <label id="lPasswd">Contraseña</label>
                <input type="text" id="passwd" name="Passwd">
                <label id="lNombre">Nombre</label>
                <input type="text" id="nombre" name="Nombre">
                <label id="lApell">Apellidos</label>
                <input type="text" id="apell" name="Apellidos">
                <label id="lEmail">Email</label>
                <input type="text" id="email" name="Email">
                <label id="lPhotoPath">Ruta de foto de perfil</label>
                <input type="text" id="photopath" placeholder="Opcional" name="PhotoPath">
                <label id="lCargo">Cargo</label>
                <input type="text" id="cargo" name="Cargo">
                <label id="lPasswdConfirm">Introduzca su contraseña para confirmar</label>
                <input type="password" id="passwdConfirm" placeholder="Contraseña" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton"
                value="Añadir Empleado">
                <input class="submitCDF cancel" id="cancelButtonREMP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 2do Formulario-->
        <div id="añadirTiendaForm" class="configForm not-active">
        <h3 style="margin: 0px 0 2vh 0;">Añadir tienda</h3>
            <form method="post" id="aSHOP">
                
                <label id="lNombreTienda">Nombre tienda</label>
                <input type="text" id="nombreTienda" name="NombreTienda">
                <label id="lDireccion">Direccion</label>
                <input type="text" id="direccion" name="Direccion">
                <label id="lEmailTienda">Email</label>
                <input type="text" id="emailTienda" name="EmailTienda">
                <label id="lCp">Código Postal</label>
                <input type="text" id="cp" name="CodigoPostal">
                <label id="lPasswdConfTienda">Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" id="passwdConfTienda" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="addButtonaSHOP"
                value="Añadir Tienda">
                <input class="submitCDF cancel" id="cancelButtonaSHOP" type="button" value="Cancelar">
            </form>
        </div>
    </div>
</div>
<script src="./checkcfgAdmin.js"></script>