<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="estilos/modificar.css">
    <title>QuickCarry</title>
</head>

<?php require "../../db/db_conn.php";

$base_datos = new base_de_datos();

$query = "SELECT * FROM localidad l INNER JOIN departamento d ON l.id_dep = d.id_departamento; ";
$resultado = $base_datos->conexion()->execute_query($query);
$matriz = $resultado->fetch_all(MYSQLI_ASSOC);
var_dump($matriz);

?>
<body>

    <div class="contenedor">
        <h1>Modificacion de datos</h1>
        <form action="../controlador_almacen/agregar_paquetes.php" method="post">
            <input type="hidden" name="op" value="modificar">
            <input type="hidden" name="id_paquete" value="<?= $_GET['id_paquete'] ?>">
            <input type="hidden" name="fecha_recibido" value="<?= $_GET['fecha_recibido'] ?>">
            <input type="hidden" name="fecha_entrega" value="<?= $_GET['fecha_entrega'] ?>">
            <input type="hidden" name="id_lote" value="<?= $_GET['id_lote'] ?>">

            <div class="subcontenedor">
                <?= "<p>Nombre actual: " . $_GET['nombre_paquete'] . "</p>" ?>

                <label for="matricula">Nombre de paquete:</label>

                <input type="text" name="nombre_paquete"><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>dimenciones actuales: " . $_GET['dimenciones'] . "</p>" ?>

                <label for="dimenciones">Nuevas dimenciones:</label>

                <input type="text" name="dimenciones"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Peso actual: " . $_GET['peso'] . "</p>" ?>

                <label for="peso">Nuevo peso:</label>

                <input type="text" name="peso"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Fragil?: " . $_GET['fragil'] . "</p>" ?>

                <label for="peso">0 para no 1 para si:</label>

                <input type="number" name="fragil"><br><br>

            </div>
            
            <div class="subcontenedor">

                <label for="Localidad destino">Localidad:</label>

                <select name="localidad_destino">
                    <?php
                    foreach ($matriz as $fila) {
                        echo "<option value='" . $fila["id_localidad"] . "'>"
                            . $fila["nombre_localidad"] . " " . $fila["nombre_departamento"] .
                            "</option>";
                    }
                    ?>
                </select>

            </div>

            <div class="subcontenedor">

                <input type="submit" value="Actualizar">

            </div>
    </div>

</body>

</html>