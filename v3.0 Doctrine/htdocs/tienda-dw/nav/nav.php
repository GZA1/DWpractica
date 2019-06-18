<nav id="mainNav">
    <img id="logo" src="../img/logo.png" width="60">
    <ul id="lista_nav">
        <li class="cont_enlace_interno">
            <a href="../main/index.php">Inicio</a>
        </li>
        <li class="cont_enlace_interno">
            <a href="../catalogo/index.php">Catálogo</a>
        </li>
        <li class="cont_enlace_interno">
            <a href="../servicios/index.php">Servicios</a>
        </li>
        <li class="cont_enlace_interno">
            <a href="../encuentranos/index.php">Encuéntranos</a>
        </li>
        <li>
            <form>
                <input type="search" placeholder="Search">
            </form>
        </li>
        <li class="dropdown-container">
            <div class="dropdown">
                <div class="dropdown-actuador flex_rows">
                    <div>
                        <img href="../usuario/sign-in.php" src="../img/user-icon.png" height="20px">
                    </div>
                    <div class="flex_cols">
                        <div style="height: 7px; visibility: hidden"></div>
                        <div class="down-arrow"></div>
                    </div>
                </div>
                <div class="dropdown-contenido">
                    <?php
                        if( !isset($u) ){
                    ?>
                    <a class="verde" href="../usuario/sign-in.php">Iniciar Sesión</a>
                    <a class="azul" href="../usuario/sign-up.php">Registrarse</a>
                    <?php
                        }else{
                    ?>
                    <div>
                        <?php
                            $tipoLogueado = $tipo;
                            if($tipo=="empleado"){
                                $empRep = $em->getRepository("Entity\\Empleado");
                                $e = $empRep->findByUser($_SESSION['user']);
                                if( $e->getIsAdministrador() ){
                                    $tipoLogueado = "admin";
                                }
                            }
                            echo("Logueado como " . $tipoLogueado . ": <b>" . $username . "</b>");
                        ?>
                    </div>
                    <a href="../usuario/perfil.php">Perfil de
                        <?php
                            $tipoPerfil = $tipoLogueado;
                            echo(" " . $tipoPerfil);
                        ?>
                    </a>
                    <?php
                        if( $tipoLogueado=="cliente" ){
                    ?>
                    <a href="../usuario/historial_pedidos.php">Historial de Pedidos</a>
                    <?php
                        }else if( $tipoLogueado=="admin" ){
                    ?>
                    <a href="">Gestión de Catálogo</a>
                    <?php
                        }
                    ?>
                    <a class="rojo" href="../usuario/logout.php">Cerrar Sesión</a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </li>
        <?php
            if( isset($u) && $tipo == 'cliente' ){
                $clienteRep = $em->getRepository("Entity\\Cliente");
                console_log((array)$_SESSION['user']);
                $c = $clienteRep->findByUser($_SESSION['user']);
                console_log((array)$c);
        ?>
        <li class="dropdown-container">
            <div class="dropdown">
                <div class="dropdown-actuador flex_rows">
                    <div>
                        <img src="../img/shopping-trolley.png" height="20px">
                    </div>
                    <div class="flex_cols">
                        <div style="height: 7px; visibility: hidden"></div>
                        <div class="down-arrow"></div>
                    </div>
                </div>
                <div class="dropdown-contenido">
                    <a href="../cesta_compra/xxxx-cesta.php">Cesta</a>
                </div>
            </div>
        </li>
        <li class="dropdown-container">
            <div class="dropdown">
                <div class="dropdown-actuador flex_rows">
                    <div>
                    <img src="../img/monedero-icon.png" height="20px">
                    </div>
                    <div class="flex_cols">
                        <div style="height: 7px; visibility: hidden"></div>
                        <div class="down-arrow"></div>
                    </div>
                </div>
                <div class="dropdown-contenido">
                    <div>
                        <?php
                            echo("Saldo disponible: " . $c->getSaldo() . "€");
                        ?>
                    </div>
                    <div class="verde">
                        <form method="post">
                            <label>Ingresar Saldo</label>
                            <input style="width: 80%;" name="saldo-add" type="text">
                            <label>IBAN (el que sea)</label>
                            <input style="width: 80%;" name="iban" type="text">
                            <input style="width: 80%;" class="naranja" type="submit" value="Ingresar">
                        </form>
                    </div>
                </div>
            </div>
        </li>
        <?php
            }else if(isset($u) && $tipo == "empleado" ){
                $empRep = $em->getRepository("Entity\\Empleado");
                $e = $empRep->findByUser($_SESSION['user']);
        ?>
            
            <li class="dropdown-container">
                <div class="dropdown">
                    <div class="dropdown-actuador flex_rows">
                        <div>
                        <!-- Introducir el enlace Admin-->
                            <img src="../img/gear.png" height="20px">
                        </div>
                        <div class="flex_cols">
                            <div style="height: 7px; visibility: hidden"></div> 
                            <div class="down-arrow"></div>                           
                        </div>                         
                    </div>
                    <div class="dropdown-contenido">
                        <a href="../usuario/cfg.php">Configuración Usuarios</a>
                        <a href="../catalogo/cfgCatalogo.php">Configuración Catálogo</a>
                    </div>                   
                </div>
            </li>
        <?php
            }
        ?>
    </ul>
</nav>