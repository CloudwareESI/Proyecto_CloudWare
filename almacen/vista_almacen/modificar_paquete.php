<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="../../estilos/estiloDef.css">
    <title>QuickCarry</title>
</head>

<?php require "../../db/funciones_utiles.php";
$matriz = get_localidades_lista();


?>
<body>

<div class="contenedorFormulario">
    <div class="formulario">
    <form action="../controlador_almacen/agregar_paquetes.php" method="post">
    <h2>Modificacion de datos</h2>
   
        <input type="hidden" name="op" value="modificar">
        <input type="hidden" name="id_paquete" value="<?= $_GET['id_paquete'] ?>">
        <input type="hidden" name="fecha_recibido" value="<?= $_GET['fecha_recibido'] ?>">
        <input type="hidden" name="fecha_entrega" value="<?= $_GET['fecha_entrega'] ?>">
        <input type="hidden" name="id_lote" value="<?= $_GET['id_lote'] ?>">

        <div class="formularioModificar">
            <?= "<p>Nombre actual: " . $_GET['nombre_paquete'] . "</p>" ?>
            <br>
            <label for="matricula">Nombre de paquete:</label>
            <input type="text" name="nombre_paquete">
            </div>

            <div class="formularioModificar">
            <?= "<p>dimenciones actuales: " . $_GET['dimenciones'] . "</p>" ?>
            <br>
            <label for="dimenciones">Nuevas dimenciones:</label>
            <input type="text" name="dimenciones">
            </div>
            <div class="formularioModificar">
            <?= "<p>Peso actual: " . $_GET['peso'] . "</p>" ?>
            <br>
            <label for="peso">Nuevo peso:</label>
            <input type="text" name="peso">
            </div>
            <div class="formularioModificar">
            <?= "<p>Fragil?: " . $_GET['fragil'] . "</p>" ?>
            <br>
            <label for="peso">0 para no 1 para si:</label>
            <input type="number" name="fragil">
            </div>
            <div class="formularioModificar">
            <label for="Localidad destino">Localidad:</label>
           
            <select name="localidad_destino">
            <br>
                <?php
                foreach ($matriz as $fila) {
                    echo "<option value='" . $fila["id_localidad"] . "'>"
                        . $fila["nombre_localidad"] . " " . $fila["nombre_departamento"] .
                        "</option>";
                }
                ?>
            </select>

            </div>
        <div class="btn">

            <input id="btn" type="submit" value="Actualizar">

        </div>
</div>
</div>
</body>

</html>