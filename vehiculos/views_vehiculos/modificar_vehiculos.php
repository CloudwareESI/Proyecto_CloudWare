<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <title>QuickCarry</title>
</head>

<body>

    <div class="contenedor">
        <h1>Modificacion de datos</h1>
        <form action="../controlador_vehiculos/agregar_vehiculos.php" method="post">
            <input type="hidden" name="op" value="modificar">
            <input type="hidden" name="matricula_vieja" value="<?= $_GET['matricula'] ?>">

            <div class="subcontenedor">
                <?= "<p>Matricula actual: " . $_GET['matricula'] . "</p>" ?>

                <label for="matricula">Nueva matricula:</label>

                <input type="text" name="matricula"><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Estado actual: " . $_GET['estado'] . "</p>" ?>

                <label for="estado">Nuevo estado:</label>

                <input type="text" name="estado"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Modelo actual: " . $_GET['modelo'] . "</p>" ?>

                <label for="modelo">Nuevo modelo:</label>

                <input type="text" name="modelo"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Rol actual: " . $_GET['rol'] . "</p>" ?>

                <label for="rol">Nuevo Rol:</label>

                <input type="text" name="rol"><br><br>

            </div>

            <div class="subcontenedor">

                <input type="submit" value="Actualizar">

            </div>
    </div>

</body>

</html>