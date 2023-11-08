<?php
session_start();
require_once "db/funciones_utiles.php";
require_once "almacen/controlador_almacen/super_controlador_almacen.php";

$paquete = get_paquete($_GET["Codigo"]);
var_dump($paquete);
// Obtén el valor de fecha_entrega y pásalo como una variable JavaScript

$fechaEntrega = isset($paquete["fecha_entrega"]) ? json_encode($paquete["fecha_entrega"]) : 'undefined';

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
    <link rel="stylesheet" href="estilos/estiloDef.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>QuickCarry</title>
</head>


<body>
    <header>
        <div class="home">
            <a href="http://localhost/Proyecto_Cloudware/"><img src="imagenes/imagen-home.png" width="70px" height="70px"></a>


    </header>
    <div class="tituloSeguimiento">
        <h1>Delivery de QuickCarry</h1>
        <h2>ID: </h2>
    </div>
    </div>

    <div class="contenedorSeguimiento">
        <i id="barra1" class="fa-solid fa-house-laptop"></i>
        <div class="seguimiento">
            <div class="seguir">
                <div class="carga">
                </div>
            </div>
        </div>

        <i id="barra2" class="fa-solid fa-truck-arrow-right"></i>
        <div class="seguimiento">
            <div class="seguir">
                <div class="carga">
                </div>
            </div>
        </div>
        <i id="barra3" class="fa-solid fa-boxes-packing"></i>

        <div class="seguimiento">
            <div class="seguir">
                <div class="carga">
                </div>
            </div>
        </div>
        <i id="barra4" class="fa-solid fa-truck-arrow-right"></i>

        <div class="seguimiento">
            <div class="seguir">
                <div class="carga">
                </div>
            </div>
        </div>
        <i id="barra4" class="fa-solid fa-house-user"></i>
    </div>

    <div class="infoPaquete">
        <h1>Estado actual</h1>
        <br>

        TEST
        <?php
        switch (true) {

            case (isset($paquete[0]["fecha_ingreso"])
                and !isset($paquete[0]["fecha_transporte"])
                and !isset($paquete[0]["fecha_recibido"])):
        ?>
                <p id="msjEstado">
                    Su paquete esta en gestion
                </p>
                <script src="detener.js"></script>
            <?php
                break;


            case (isset($paquete[0]["fecha_transporte"])
                and !isset($paquete[0]["fecha_recibido"])):
            ?>
                <p id="msjEstado">
                    Su paquete se encuentra en camino al almacén
                </p>
                <script src="detener.js"></script>
            <?php
                break;

            case (isset($paquete[0]["fecha_recibido"])
                and !isset($paquete[0]["fecha_transporte"])):
            ?>
                <p id="msjEstado">
                    Su paquete se encuentra en camino al almacén más cercano
                </p>
                <script src="detener.js"></script>
            <?php
                break;

            case (isset($paquete[0]["fecha_transporte"])
                and isset($paquete[0]["fecha_recibido"])):
            ?>
                <p id="msjEstado">
                    Su paquete se encuentra en camino al almacén más cercano
                </p>
                <script src="detener.js"></script>
            <?php
                break;

            case (isset($paquete[0]["fecha_recibido"])
                and !isset($paquete[0]["fecha_cargado"])):
            ?>
                <p id="msjEstado">
                    Su paquete se encuentra en camino al almacén más cercano
                </p>
                <script src="detener.js"></script>
            <?php
                break;

            case (isset($paquete[0]["fecha_cargado"])
                and !isset($paquete[0]["fecha_entrega"])):
            ?>
                <p id="msjEstado">
                    Su paquete se encuentra en camino a su residencia
                </p>
                <script src="detener.js"></script>
            <?php
                break;

            case (isset($paquete[0]["fecha_entrega"])):
            ?>
                <p id="msjEstado">
                    Su paquete a sido entregado
                </p>
                <script src="detener.js"></script>
        <?php
                break;
        }
        ?>

        <!-- Cuadro de información de paquete -->
        <div class="cuadroInfo">
            <h3>Nombre: <?= $paquete[0]["nombre_paquete"]; ?> </h3>

            <br>
            <h3>Peso: <?= $paquete[0]["peso"]; ?> gramos</h3>

            <br>
            <h3>Tamaño: <?= $paquete[0]["dimenciones"]; ?> cm3</h3>

            <br>
            <h3>Fecha de salida: </h3>
            <?php if (isset($paquete[0]["fecha_cargado"])) {
                echo "</p>" . $paquete[0]["fecha_cargado"] . "</p>";
            } else {
                echo "<p>Todavia no a salido en transporte a su residencia </p>";
            } ?>

            <br>
            <h3>Fecha de llegada:</h3>

            <?php if (isset($paquete[0]["fecha_entrega"])) {
                echo "</p>Entregado " . $paquete[0]["fecha_cargado"] . "</p>";
            } else {
                echo "<p>Todavia no se entrego </p>";
            } ?>


        </div>

    </div>


</body>

</html>