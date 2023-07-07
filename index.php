<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="estilos/estiloIndex.css">
    <title>QuickCarry</title>
</head>

<?php
session_start();
?>

<script>
    var nombre = "<?php echo  $_SESSION['nombre'];  ?>";
    if (nombre !== "") {
        alert("Bienvenido " + nombre + "!");
    }

</script>

<body>

    <header>
        <nav>
            <ul>
                <img id="imgLogin" img src="Imagenes/Logo_quickcarry-sin-fondo.png" alt="">

                <li>
                    <a href="">
                        <p>inicio</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Seguimiento de Paquete</p>
                    </a>
                </li>
                <li>
                    <?php

                    if (isset($_SESSION['empleado'])) {
                        if ($_SESSION['empleado'] == 1) {
                            echo "
                            <a href='php/interfaces/central_de_almacenes.php'>
                            <p>Almacén</p> ";
                        } else {


                        }
                    } else {

                    }

                    ?>
                    </a>
                </li>
                <li>
                    <a href="sobreNosotros.html">
                        <p>Nosotros</p>
                    </a>
                </li>
            </ul>

            <div class="perfil">
                <nav>
                    <ul>
                        <li>
                            <a href=""><img src="Imagenes/imagen-perfil.png" alt="" height="70px" width="70px"></a>
                            <ul>
                                <li><a href="">Perfil</a></li>
                                <br>
                                <li><a href="login.html">Cambiar cuenta</a></li>
                                <br>
                                <li><a href="php/utils/terminar.php">Cerrar sesion</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href=""> <img src="Imagenes/imagen-menu.png" alt="" height="60px" width="60px"></a>
                            <ul>

                                <li><a href="">Tema</a></li>
                                <li><a href="#">Idioma</a></li>

                            </ul>
                        </li>
            </div>
        </nav>

    </header>



</body>

</html>