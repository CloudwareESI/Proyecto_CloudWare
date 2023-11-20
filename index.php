<?php
session_start();
include "db/funciones_utiles.php";

if (isset($_GET["color"])) {
    switch ($_GET["color"]) {
        case 'blanco':
            $_SESSION['color'] = "blanco";
            break;
        case 'negro':
            $_SESSION['color'] = "negro";
            break;
    }
} elseif (!isset($_SESSION['color'])) {
    $_SESSION['color'] = "negro";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry-sin-fondo.png">
    <?php switch ($_SESSION["color"]) {
        case 'negro':
            echo     '<link rel="stylesheet" href="estilos/estiloDef.css">';
            break;
        case 'blanco':
            echo     '<link rel="stylesheet" href="estilos/estiloColor.css">';
            break;
    }
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>QuickCarry</title>
</head>

<?php

if (isset($_GET['Bienvenido'])) {
?>

    <script>
        var nombre = "<?php echo  $_SESSION['nombre'];  ?>";
        if (nombre !== "") {
            alert("Bienvenido " + nombre + "!");
        }
    </script>
<?php
}
?>



<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="?Inicio">
                        <p>inicio</p>
                    </a>
                </li>
                <li>
                    <a href="index.php#paquete">
                        <p>Mi Paquete</p>
                    </a>
                </li>

                <?php
                if (isset($_SESSION['cargo'])) {
                    if ($_SESSION['cargo'] == "1" or $_SESSION['cargo'] == "0") {
                        echo "
                            <li>
                            <a href='?Almacenes'>
                            <p>Almacén</p> 
                            </a>
                            </li>";
                    } else {
                    }
                } else {
                }
                if (isset($_SESSION['cargo'])) {
                    if ($_SESSION['cargo'] == "1" or $_SESSION['cargo'] == "4" or $_SESSION['cargo'] == "0") {
                        echo "
                            <li>
                            <a href='?Entrada'>
                            <p>Entrada de Paquetes</p> 
                            </a>
                            </li>";
                    } else {
                    }
                } else {
                }
                if (isset($_SESSION['cargo'])) {
                    if ($_SESSION['cargo'] == "2" or $_SESSION['cargo'] == "0") {
                        echo "
                            <li>
                            <a href='?Camiones'>
                            <p>Camiones</p> 
                            </a>
                            </li>";
                    } else {
                    }
                } else {
                }

                if (isset($_SESSION['cargo'])) {
                    if ($_SESSION['cargo'] == "0") {
                        echo "
                            <li>
                            <a href='?Usuarios'>
                            <p>Usuarios</p> 
                            </a>
                            </li>";
                    } else {
                    }
                } else {
                }

                if (isset($_SESSION['cargo'])) {
                    if ($_SESSION['cargo'] == "0") {
                        echo "
                            <li>
                            <a href='?Rutas'>
                            <p>Rutas</p> 
                            </a>
                            </li>";
                    } else {
                    }
                } else {
                }
                ?>

                </div>
        </nav>
    </header>


    <?php
    if (
        isset($_GET['Inicio'])
        or
        isset($_GET['Bienvenido'])
        or
        (isset($_GET['Seguimiento']))
        or
        (isset($_GET['color']))
        or
        empty($_GET)
    ) {
    ?>
        <!-- Slider -->
        <div class="slider">
            <div class="sliderContainer">

                <!-- BUTTONS (input/labels) -->
                <input type="radio" name="slider" id="slide-1-trigger" class="trigger" checked>
                <label class="btnSlider" for="slide-1-trigger"></label>
                <input type="radio" name="slider" id="slide-2-trigger" class="trigger">
                <label class="btnSlider" for="slide-2-trigger"></label>
                <input type="radio" name="slider" id="slide-3-trigger" class="trigger">
                <label class="btnSlider" for="slide-3-trigger"></label>
                <input type="radio" name="slider" id="slide-4-trigger" class="trigger">
                <label class="btnSlider" for="slide-4-trigger"></label>

                <!-- SLIDES -->
                <div class="slide-wrapper">
                    <div id="slide-role">
                        <div class="slide slide-1"></div>
                        <div class="slide slide-2"></div>
                        <div class="slide slide-3"></div>
                        <div class="slide slide-4"></div>
                    </div>
                </div>

            </div>
        </div>
    <?php
    }
    ?>



    <?php
    if (isset($_GET['Almacenes'])) {
        if (isset($_SESSION['cargo'])) {
            if ($_SESSION['cargo'] == "1" or $_SESSION['cargo'] == "0") {
                require("almacen/controlador_almacen/super_controlador_almacen.php");
                if (isset($_GET['id_almacen'])) {
                    get_paquetes_alm($_GET['id_almacen']);
                    echo "<br>";
                    get_lotes_alm($_GET['id_almacen']);
                } else {

                    get_all_almacenes($_SESSION["id"], $_SESSION["cargo"]);
                }
            }
        }
    }



    if (isset($_GET['Entrada'])) {
        if (isset($_SESSION['cargo'])) {
            if ($_SESSION['cargo'] == "1" or $_SESSION['cargo'] == "0" or $_SESSION['cargo'] == "4") {
                require("almacen/controlador_almacen/super_controlador_almacen.php");

                entrada_paquetes($_SESSION['cargo']);
    ?>

        <?php
            }
        }
    }




    if (isset($_GET['Camiones'])) {
        require("vehiculos/controlador_vehiculos/super_controlador_vehiculos.php");

        get_all_vehiculos($_SESSION["id"], $_SESSION["cargo"]);
    }

    if (
        isset($_GET['Inicio'])
        or
        isset($_GET['Bienvenido'])
        or
        (isset($_GET['Seguimiento']))
        or
        (isset($_GET['color']))
        or

        empty($_GET)
    ) {
        ?>

        <a href="paquete"> </a>
        <div class="contenedorFormulario">
            <form id="paquete" class="formBase" id="formPaquete" action="seguimientoDePaquete.php" method="GET">

                <div class="formulario vertical">
                    <?php switch ($_SESSION["color"]) {
                        case 'negro':
                            echo
                            '<img src="Imagenes/Logo_quickcarry-sin-fondo1.png" alt="logo" height="70px" width="70px">';
                            break;
                        case 'blanco':
                            echo
                            '<img src="Imagenes/Logo_quickcarry-VERDE.png" alt="logo" height="70px" width="70px">';
                            break;
                    }
                    ?>

                    <h2>Seguimiento de Paquete</h2>
                    <br>
                    <div>
                        <input type="text" class="controles" name="Codigo" id="Codigo" placeholder="Codigo:" maxlength="32" required>
                        <label for="myInput" id="paquete">Codigo:</label>
                    </div>
                    <br>
                    <div class="btn">
                        <button>Ingresar</button>
                    </div>

                </div>
            </form>

        </div>

    <?php
    }

    if (isset($_GET['Usuarios']) and  $_SESSION['cargo'] == "0") {


        require("usuarios/controlador_usuario/super_controlador_usuario.php");

        get_all();
    }

    if (isset($_GET['Rutas']) and  $_SESSION['cargo'] == "0") {


        require("vehiculos/controlador_vehiculos/super_controlador_ruta.php");

        get_all_rutas();
    }
    ?>




    <!-- Menu derecha -->
    <aside class="menuLateral">
        <ul class="columna">
            <li class="botones"><a href="usuarios/views_usuario/login.php">
                    <i class="fa-regular fa-circle-user"></i></a>
            </li>
            <li>
                <a href='?color=<?php
                                if (isset($_SESSION['color'])) {
                                    switch ($_SESSION['color']) {
                                        case 'blanco':
                                            echo "negro";
                                            break;
                                        case 'negro':
                                            echo "blanco";
                                            break;
                                        default:
                                            echo "negro";
                                            break;
                                    }
                                }
                                ?>'>
                    <div id="tema">
                        <div class="boton"></div>
                    </div>
                </a>
            </li>
            <li>
                <a href="terminar.php"><i class="fa-regular fa-circle-xmark"></i></a>
            </li>

        </ul>
    </aside>


    <!--foooter-->
    <footer class="footer">

        <div class="contenedorFooter">
            <div class="footer-row">

                <div class="enlaces">
                    <h4>Comapañia</h4>
                    <ul>
                        <li><a href="">Nosotros</a></li>
                    </ul>
                </div>

                <div class="enlaces">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="">cloudwareESI23@gmail.com</a></li>
                        <li><a href="">2622 8856</a></li>
                    </ul>
                </div>
                <div class="enlaces">
                    <h4>ayuda</h4>
                    <ul>
                        <li><a href="contraseñas.php">Contraseñas de prueba</a></li>
                    </ul>
                </div>
                <div class="enlaces">
                    <h4>Redes</h4>
                    <div class="redes">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

        </div>


</body>

</html>