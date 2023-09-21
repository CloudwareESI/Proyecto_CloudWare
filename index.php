<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="estilos/estilo.css">
    <link rel="stylesheet" href="estilos/estiloTablas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>QuickCarry</title>
</head>

<?php
session_start();
var_dump($_SESSION);
include "db/funciones_utiles.php";
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
                    <a href="?Seguimiento">
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
                    if ($_SESSION['cargo'] == "1" or $_SESSION['cargo'] == "0") {
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
                ?>

                <li>
                    <a href="sobreNosotros.html">
                        <p>Nosotros</p>
                    </a>
                </li>
                </div>
        </nav>
    </header>


    <?php
    if(isset($_GET['Inicio']) 
    or 
    empty($_GET)){
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
        require_once("almacen/controlador_almacen/super_controlador_almacen.php");
        if (isset($_GET['id_almacen'])) {
            get_paquetes_alm($_GET['id_almacen']);
            echo "<br>";
            get_lotes_alm($_GET['id_almacen']);
        } else {

            get_all_almacenes();
        }
    }

    if (isset($_GET['Entrada'])) {
        require_once("almacen/controlador_almacen/super_controlador_almacen.php");

        entrada_paquetes();

    ?>
        <div class='contenedor'>
            <button class="btnAniadir" onclick="window.location.href='almacen/vista_almacen/agregar_paquete.php';">
                Agregar
            </button>
        </div>








    <?php
    }



    if (isset($_GET['Camiones'])) {
        require_once("vehiculos/controlador_vehiculos/super_controlador_vehiculos.php");

        get_all_vehiculos();
    }

    if (isset($_GET['Seguimiento'])) {
        echo '
        <div class="paquete">
            <form action="php/apis/verificacion.php" method="post">

              <div class="idPaquete">
                    <img src="Imagenes/Logo_quickcarry-sin-fondo1.png" alt="logo" height="70px" width="70px">
                    <br>
                    <h2 id="paquete">Seguimiento de Paquete</h2>
                    <br>
                    <br>
                    <div class="form">
                        <input type="text" class="controles" name="Codigo" id="Codigo" placeholder="Codigo:" maxlength="32" required>
                        <label for="myInput" id="paquete">Codigo:</label>
                    </div>
                    <br>
                    <button>Ingresar</button>
                </div>
            
            </form>
            </div>
        ';
    }

    if (isset($_GET['Usuarios']) and  $_SESSION['cargo'] == "0") {


        require_once("usuarios/controlador_usuario/super_controlador_usuario.php");

        get_all();
    }


    ?>




    <!-- Menu derecha -->
    <aside class="menuLateral">
        <ul class="columna">
            <li class="botones"><a href="usuarios/views_usuario/login.html">
                    <img src="Imagenes/imagen-perfil.png" alt="perfil" height="40px" width="40px"></a>
            </li>
            <li>
                <div id="tema">
                    <div class="boton"></div>
                </div>
                <script src="boton.js"></script>
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
                        <li><a href="">nosotros</a></li>
                        <li><a href="">nosotros</a></li>
                        <li><a href="">nosotros</a></li>
                        <li><a href="">nosotros</a></li>
                    </ul>
                </div>
                <div class="enlaces">
                    <h4>ayuda</h4>
                    <ul>
                        <li><a href="">aaaa</a></li>
                        <li><a href="">aaaa</a></li>
                        <li><a href="">aaaa</a></li>
                        <li><a href="">aaaa</a></li>
                    </ul>
                </div>
                <div class="enlaces">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="">Correo</a></li>
                        <li><a href="">telefono</a></li>
                        <li><a href="">aaaa</a></li>
                        <li><a href="">aaaa</a></li>
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