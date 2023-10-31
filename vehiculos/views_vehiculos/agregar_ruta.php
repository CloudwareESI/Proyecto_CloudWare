<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="../../estilos/modificar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>QuickCarry</title>
</head>
<?php
require "../../db/funciones_utiles.php";
require "../../almacen/controlador_almacen/super_controlador_almacen.php";

$matriz = get_almacenes_lista();
?>

<body>

    <h2>Agregar ruta</h2>
    <form action="../controlador_vehiculos/agregar_ruta.php" method="POST">
        <input type="hidden" name="op" value="agregar">
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
        <br><br>
        <?php
        for ($i = 1; $i <= $_POST["ubicaciones"]; $i++) {

        ?>
            <label> Destino de trecho <?php echo $i; ?> de la ruta</label>
            <select name="almacen[<?php echo $i; ?>]">
                <?php foreach ($matriz as $fila) {
                    echo "<option value='" . $fila["id_almacen"] . "'>"
                        . $fila["id_almacen"] . " "
                        . $fila["nombre_localidad"] . " "
                        . $fila["nombre_departamento"] .
                        "</option>";
                } ?>

            </select>

            <label>Tiempo estimado de trecho <?php echo $i; ?></label>
            <input type="time" name="tiempo[<?php echo $i; ?>]">

            <br><br>
        <?php }
        ?>

        <div class="btn">
            <input id="btn" type="submit" value="Actualizar">
        </div>
    </form>

</body>

</html>