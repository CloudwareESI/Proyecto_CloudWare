<?php 
session_start();
?>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">

        <?php switch ($_SESSION["color"]) { 
        case 'negro':
            ?>
            <link rel="stylesheet" href="../../estilos/estiloDef.css">
            <?php
            break;
        case 'blanco':
            ?>
            <link rel="stylesheet" href="../../estilos/estiloColor.css">
            <?php
            break; } 
        ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <title>QuickCarry</title>
    </head>
    <header>
        <div class="home">
           <a href="../../index.php?Rutas"><i class="fa-solid fa-reply"></i></a>
        </div>
    </header>
    <?php
    require "../../db/funciones_utiles.php";
    require "../../almacen/controlador_almacen/super_controlador_almacen.php";

    $matriz = get_almacenes_lista();
    ?>

    <body>
     <div class="contenedorFormulario">
    
        <form class="formBase" action="../controlador_vehiculos/gestion_ruta.php" method="POST">
        <div class="formulario vertical">
        <h2>Agregar ruta</h2>
        <input type="hidden" name="op" value="agregar">
         <div class="formularioModificar">
            <label> Punto de inicio de la ruta</label>
       
            <select name="almacen[0]">

                <?php foreach ($matriz as $fila) {
                    echo "<option value='" . $fila["id_almacen"] . "'>"
                        . $fila["id_almacen"] . " "
                        . $fila["nombre_localidad"] . " "
                        . $fila["nombre_departamento"] .
                        "</option>";
                } ?>

            </select>
            <input type="hidden" name="tiempo[0]" value="00:00">
            </div>

            
            <?php
            //agregar line de ubicacion

            for ($i = 1; $i <= $_POST["ubicaciones"]; $i++) {

            ?>
             <div class="formularioModificar">                <label> Destino de trecho <?php echo $i; ?> de la ruta</label>
                <select name="almacen[<?php echo $i; ?>]">
                    <?php foreach ($matriz as $fila) {
                        echo "<option value='" . $fila["id_almacen"] . "'>"
                            . $fila["id_almacen"] . " "
                            . $fila["nombre_localidad"] . " "
                            . $fila["nombre_departamento"] .
                            "</option>";
                    } ?>

                </select>
                </div>
                <div class="formularioModificar">  
                <label>Tiempo estimado de trecho <?php echo $i; ?></label>
                <input type="time" name="tiempo[<?php echo $i; ?>]">
                </div>
      
            <?php 
            
        
        }
            ?>

            <div class="btn">
                <input id="btn" type="submit" value="Actualizar">
            </div>
        </form>
        </div>
                </div>
    </body>

    </html>