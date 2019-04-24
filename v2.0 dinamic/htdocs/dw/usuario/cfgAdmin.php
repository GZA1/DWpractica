<div id="dashboard">
    <nav id="topSect">
        <div id="optsCfg">
            <div class="optCfg"><a style="display: inline-block;" id="optAddEMP" class="adminOpt">Registrar Empleado</a></div>
            <div class="optCfg"><a style="display: inline-block;" id="optAddSHOP" class="adminOpt">Añadir Tienda</a></div>
            <div class="optCfg"><a style="display: inline-block;" id="optBajaEMP" class="adminOpt">Baja Empleado</a></div>

        </div>
    </nav>
    
    <div id="botSect">

        <!-- 1er Formulario-->
        <div id="registrarEmpleadoForm" class="configForm">
            
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
                <input type="text" placeholder="Opcional" name="PhotoPath">
                <label>Cargo</label>
                <input type="text" name="Cargo">
                <label>ID de la tienda a la que pertenece</label>
                <select name="tienda_id" form="rEMP">
                    <?php
                    $tiendas = $u->getAllTiendasID();                    
                    foreach($tiendas as $a){
                        echo "<option value=".$a['id'].">".$a['id']."</option>";
                    }
                    ?>        
                </select>                    
                <label>Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton"
                value="Añadir Empleado">
                <input class="submitCDF cancel" id="cancelButtonREMP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 2do Formulario-->
        <div id="añadirTiendaForm" class="configForm not-active">
    
            <form method="post" id="aSHOP">
                
                <label>Nombre tienda</label>
                <input type="text" name="NombreTienda">
                <label>Direccion</label>
                <input type="text" name="Direccion">
                <label>Email</label>
                <input type="text" name="Email">
                <label>Código Postal</label>
                <input type="text" name="CodigoPostal">
                <label>Latitud</label>
                <input type="text" placeholder="Opcional" name="Latitud">
                <label>Longitud</label>
                <input type="text" placeholder="Opcional" name="Longitud">
                <label>Provincia</label>
                <input type="text" name="Provincia">
                <label>Municipio</label>
                <input type="text" name="Municipio">
                <label>Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="addButtonaSHOP"
                value="Añadir Tienda">
                <input class="submitCDF cancel" id="cancelButtonaSHOP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 3er Formulario -->
        <div id="bajaEMPForm" class="configForm not-active">
        
            <form method="post" id="bajaEMP">
                
                <label>Introduce el ID del emnpleado a dar de baja</label>
                <input type="text" name="IDbajaEmpleado">
                <!-- <label>Direccion</label>
                <input type="text" name="Direccion">
                <label>Email</label>
                <input type="text" name="Email">
                <label>Código Postal</label>
                <input type="text" name="CodigoPostal">
                <label>Latitud</label>
                <input type="text" placeholder="Opcional" name="Latitud">
                <label>Longitud</label>
                <input type="text" placeholder="Opcional" name="Longitud">
                <label>Provincia</label>
                <input type="text" name="Provincia">
                <label>Municipio</label>
                <input type="text" name="Municipio"> -->
                <label>Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="bajaButtonEMP"
                value="Baja Empleado">
                <input class="submitCDF cancel" id="cancelButtonbajaEMP" type="button" value="Cancelar">
            </form>

        </div>
    </div>

</div>