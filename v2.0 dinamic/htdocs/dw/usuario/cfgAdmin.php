<div id="dashboard">
    <nav id="topSect">
        <div id="optsCfg">
            <div class="optCfg"><a style="display: inline-block;" id="optAddEMP" class="adminOpt">Registrar Empleado</a></div>
            <div class="optCfg"><a style="display: inline-block;" class="adminOpt">Añadir Tienda</a></div>

        </div>
    </nav>
    <div id="botSect">
        <div id="registrarEmpleadoForm" class="cfgForm" style="display: block;">
            <h3 style="margin: 0px 0 2vh 0;">Registrar Empleado</h3>
            <form method="post" id="rEMP">

                <label>Nombre de usuario</label>
                <input type="text" name="Username">
                <label>Contraseña</label>
                <input type="text" name="Passwd">
                <label>Nombre</label>
                <input type="text" name="Nombre">
                <label>Apellidos</label>
                <input type="text" name="Apellidos">
                <label>Email</label>
                <input type="text" name="Email">
                <label>Ruta de foto de perfil</label>
                <input type="text" name="PhotoPath">
                <label>Cargo</label>
                <input type="text" name="Cargo">
                <label>Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton"
                    value="Añadir Empleado">
                <input class="submitCDF" id="cancelButtonREMP" type="button" value="Cancelar">
            </form>
        </div> 

    </div>

</div>