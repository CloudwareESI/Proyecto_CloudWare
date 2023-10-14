<?php
session_start();
require_once "db/funciones_utiles.php";
require_once "almacen/controlador_almacen/super_controlador_almacen.php";

$paquete = get_paquete($_GET["Codigo"]);
//var_dump($paquete[0]);
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
    <link rel="stylesheet" href="estiloSeguimiento.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>QuickCarry</title>
</head>


<body>
<header>
        <div class="home">
           <a href="http://localhost/Proyecto_Cloudware/"><img src="imagenes/imagen-home.png" width="70px" height="70px"></a>
        </div>
    </header>
    
    <form action="" method="get">

    
        
        <div class="seguimientoMuestra">
        <div class="tituloSeguimiento">
        <h1>Delivery de QuickCarry</h1>
        <h2>ID: </h2>
        </div>

        <div class="barras">
            <i id="barra1" class="fa-solid fa-house-laptop"></i>
            <div class="barra1">
                <div class="transicion1"></div>
            </div>
            <i id="barra2" class="fa-solid fa-truck-arrow-right"></i>
            <div class="barra2">
                <div class="transicion2"></div>
            </div>
            <i id="barra3" class="fa-solid fa-boxes-packing"></i>

            <div class="barra3">
                <div class="transicion3"></div>
            </div>
            <i id="barra4" class="fa-solid fa-truck-arrow-right"></i>

            <div class="barra4">
                <div class="transicion"></div>
            </div>
            <i id="barra4" class="fa-solid fa-house-user"></i>
        </div>

        <div class="infoPaquete">
            <h1>Estado actual</h1>
            <p>Su paquete se encuentra en camino al almacén más cercano</p>
        </div>
        <!-- Cuadro de información de paquete -->
        <div class="cuadroInfo">
                <p>Nombre: </p>
                <p>Fecha de salida: </p>
                <p>Fecha de llegada:</p>
                <p>Peso: </p>
                <p>Tamaño: </p>
            </div>
        <?php
        if (isset($paquete["fecha_ingreso"])) {



            if (isset($paquete["fecha_transporte"])) {



                if (isset($paquete["fecha_recibido"])) {



                    if (isset($paquete["fecha_cargado"])) {



                        if (isset($paquete["fecha_entrega"])) {
                        }
                    }
                }
            }
        }
        ?>
    </form>
</body>

</html>