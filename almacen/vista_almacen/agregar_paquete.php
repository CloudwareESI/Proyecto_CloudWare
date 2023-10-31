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

<body>
    <?php require "../../db/funciones_utiles.php";
    $matriz = get_localidades_lista();

    ?>
    <div class="contenedorFormulario">


        <form action="../controlador_almacen/agregar_paquetes.php" method="post">
            <h2>Agregar datos</h2>
            <div class="formulario">
                <input type="hidden" name="op" value="agregar">
                <input type="hidden" name="id_almacen" value=<?php $_GET = "id_almacen" ?>>

                <div class="formularioModificar">
                    <label for="nombre_paquete">Nombre:</label>
                    <input type="text" name="nombre_paquete">
                </div>
                <div class="formularioModificar">
                    <label for="dimenciones">Dimenciones:</label>
                    <input type="text" name="dimenciones">
                </div>
                <div class="formularioModificar">
                    <label for="peso">Peso:</label>
                    <input type="text" name="peso">
                </div>
                <div class="formularioModificar">
                    <?= "<p>Fragil?:</p>" ?>
                    <label for="peso">0 para no 1 para si:</label>
                    <input type="number" name="fragil">
                </div>
                <div class="formularioModificar">
                    <label for="Calle destino">Calle_destino:</label>
                    <input type="text" name="calle_destino">
                </div>
                <div class="formularioModificar">
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
                <div class="btn">
                    <input id="btn" type="submit" value="Actualizar">
                </div>
            </div>
    </div>
</body>

</html>