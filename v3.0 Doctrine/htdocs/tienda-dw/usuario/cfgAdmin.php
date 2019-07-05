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
                
                <label id="lUsername">Nombre de usuario</label>
                <input type="text" id="username" name="Username">
                <label id="lPasswd">Contraseña</label>
                <input type="password" id="passwd" name="Passwd">
                <label id="lNombre">Nombre</label>
                <input type="text" id="nombre" name="Nombre">
                <label id="lApell">Apellidos</label>
                <input type="text" id="apell" name="Apellidos">
                <label id="lEmail">Email</label>
                <input type="text" id="email" name="Email">
<<<<<<< HEAD
                <label id="lPhoto">Foto de perfil (opcional)</label>
                <input type="file" accept="image/*" alt="Opcional" id="photo" name="Photo">
                <label id="lCargo">Cargo</label>
                <input type="text" id="cargo" name="Cargo">
                <label id="lTiendaId">ID de la tienda a la que pertenece</label>
                <select id="tiendaId" name="tienda_id" form="rEMP">
                    <?php
                    $tiendas = $em->getRepository("Entity\\Tienda")->findAll();                    
                    foreach($tiendas as $a){ ?>
                        <option value="<?php echo $a->getId() ?>">ID <?php echo($a->getId().' - '.$a->getNombre()) ?></option>";
                    <?php 
                    }
                    ?>        
                </select>
                <label id="lPasswdConfirm">Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="passwdConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton" value="Añadir Empleado">
                <input class="submitCDF cancel" id="cancelButtonREMP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 2do Formulario-->
        <div id="añadirTiendaForm" class="configForm not-active">
    
            <form method="post" id="aSHOP">
                
                <label id="lNombreTienda">Nombre tienda</label>
                <input type="text" id="nombreTienda" name="NombreTienda">
                <label id="lDireccion">Direccion</label>
                <input type="text" id="direccion" name="Direccion">
                <label id="lCp">Código Postal</label>
                <input type="text" id="cp" name="CodigoPostal">
                <label id="lEmailTienda">Email</label>
                <input type="text" id="emailTienda" name="EmailTienda">
                <label id="lPasswdConfTienda">Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" id="passwdConfTienda" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="addButtonaSHOP" value="Añadir Tienda">
                <input class="submitCDF cancel" id="cancelButtonaSHOP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 3er Formulario -->
        <div id="bajaEMPForm" class="configForm not-active">
            <form method="post" id="bajaEMP">
                <label id="lIdBajaEmpleado">Seleccione el empleado a dar de baja</label>
                <select id="idBajaEmpleado" name="idBajaEmpleado" form="bajaEMP">
                    <?php
                    $usuariosRep = $em->getRepository("Entity\\Usuario");
                    $usEmpleados = $usuariosRep->findEmpleados();
                    foreach($usEmpleados as $usEmp){ console_log((array)$usEmp); console_log($usEmp->getIdUsuario());?>
                        <option value='<?php echo $usEmp->getIdUsuario()?>'><?php echo($usEmp->getUsername())?></option>
                    <?php
=======
                <label id="lPhotopath">Ruta de foto de perfil</label>
                <input type="file" accept="image/*" placeholder="Opcional" id="photopath" name="PhotoPath">
                <label id="lCargo">Cargo</label>
                <input type="text" id="cargo" name="Cargo">
                <label id="lTiendaId">Tienda a la que pertenece</label>
                <select id="tiendaId" name="tienda_id" form="rEMP">
                    <?php
                    $tiendaRep = $em->getRepository("Entity\\Tienda");
                    $tiendas = $tiendaRep->findAll();
                    foreach($tiendas as $a){ ?>
                        <option value="<?php echo $a->getId() ?>">ID <?php echo($a->getId().' - '.$a->getNombre()) ?></option>";
                    <?php 
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch
                    }
                ?>        
                </select>
<<<<<<< HEAD
                <label id="lPasswdConfBaja">Introduzca su contraseña para confirmar</label>
                <input id="passwdConfBaja" type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="bajaButtonEMP" value="Baja Empleado">
                <input class="submitCDF cancel" id="cancelButtonbajaEMP" type="button" value="Cancelar">
=======
                <label id="lPasswdConfirm">Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="passwdConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton" value="Añadir Empleado">
                <input class="submitCDF cancel" id="cancelButtonREMP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 2do Formulario-->
        <div id="añadirTiendaForm" class="configForm not-active">
    
            <form method="post" id="aSHOP">
                
                <label id="lNombreTienda">Nombre tienda</label>
                <input type="text" id="nombreTienda" name="NombreTienda">
                <label id="lDireccion">Direccion</label>
                <input type="text" id="direccion" name="Direccion">
                <label id="lCp">Código Postal</label>
                <input type="text" id="cp" name="CodigoPostal">
                <label id="lEmailTienda">Email</label>
                <input type="text" id="emailTienda" name="EmailTienda">
                <label id="lPasswdConfTienda">Introduzca su contraseña para confirmar</label>
                <input type="password" placeholder="Contraseña" id="passwdConfTienda" name="ContraseñaConfirm">
                <input class="submitCDF" type="submit" name="optsSubmit" id="addButtonaSHOP" value="Añadir Tienda">
                <input class="submitCDF cancel" id="cancelButtonaSHOP" type="button" value="Cancelar">
            </form>
        </div>

        <!-- 3er Formulario -->
        <div id="bajaEMPForm" class="configForm not-active">
        
            <form method="post" id="bajaEMP">
                
            <label id="lIdBajaEmpleado">Seleccione el empleado a dar de baja</label>
            <select id="idBajaEmpleado" name="idBajaEmpleado" form="bajaEMP">
                <?php
                $usuariosRep = $em->getRepository("Entity\\Usuario");
                $usEmpleados = $usuariosRep->findEmpleados();
                foreach($usEmpleados as $usEmp){ console_log((array)$usEmp); console_log($usEmp->getIdUsuario());?>
                    <option value='<?php echo $usEmp->getIdUsuario()?>'><?php echo($usEmp->getUsername())?></option>
                <?php
                }
            ?>        
            </select>
            <label id="lPasswdConfBaja">Introduzca su contraseña para confirmar</label>
            <input id="passwdConfBaja" type="password" placeholder="Contraseña" name="ContraseñaConfirm">
            <input class="submitCDF" type="submit" name="optsSubmit" id="bajaButtonEMP" value="Baja Empleado">
            <input class="submitCDF cancel" id="cancelButtonbajaEMP" type="button" value="Cancelar">
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch
            </form>

        </div>
    </div>
</div>
<script src="./checkcfgAdmin.js"></script>