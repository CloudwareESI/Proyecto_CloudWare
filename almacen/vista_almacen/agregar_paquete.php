<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../../estilos/modificar.css">
    <link rel="icon" type="image/jpg" href="../../Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>QuickCarry</title>
</head>


<body>
    <?php require "../../db/db_conn.php";

    $base_datos = new base_de_datos();

    $query = "SELECT * FROM localidad l INNER JOIN departamento d ON l.id_dep = d.id_departamento; ";
    $resultado = $base_datos->conexion()->execute_query($query);
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);
    var_dump($matriz);

    ?>
    <div class="contenedor">

        <h1>Agregar datos</h1>
        <form action="../controlador_almacen/agregar_paquetes.php" method="post">
            <input type="hidden" name="op" value="agregar">
            <input type="hidden" name="id_almacen" value=<?php $_GET = "id_almacen" ?>>
            <div class="subcontenedor">

                <label for="nombre_paquete">Nombre:</label>

                <input type="text" name="nombre_paquete"><br>

            </div>
            <div class="subcontenedor">

                <label for="dimenciones">Dimenciones:</label>

                <input type="text" name="dimenciones"><br><br>

            </div>
            <div class="subcontenedor">

                <label for="peso">Peso:</label>

                <input type="text" name="peso"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Fragil?:</p>" ?>

                <label for="peso">0 para no 1 para si:</label>

                <input type="number" name="fragil"><br><br>

            </div>
            <div class="subcontenedor">

                <label for="Calle destino">Calle_destino:</label>

                <input type="text" name="calle_destino"><br><br>

            </div>
            <div class="subcontenedor">

                <label for="Localidad destino">Localidad:</label>

                <select name="localidad_destino">
                    <?php 
                        foreach ($matriz as $fila) {
                            echo "<option value='". $fila["id_localidad"] . "'>"
                            . $fila["nombre_localidad"] ." " . $fila["nombre_departamento"] .
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