<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry-sin-fondo.png">
    <link rel="stylesheet" href="css/estiloIndex.css">
    <title>QuickCarry</title>
</head>

<body>

    <div class="contenedor">
        <h1>Modificacion de datos</h1>
        <form action="../controlador_usuario/agregar_usu.php" method="post">
            <input type="hidden" name="op" value="modificar">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="viejo" value="<?= $_GET['email'] ?>">

            <div class="subcontenedor">
                <?= "<p>Nombre actual: " . $_GET['nombre'] . "</p>" ?>

                <label for="nombre">Nuevo nombre:</label>

                <input type="text" name="nombre"><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Apellido actual: " . $_GET['apellido'] . "</p>" ?>

                <label for="apellido">Nuevo apellido:</label>

                <input type="text" name="apellido"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Mail actual: " . $_GET['email'] . "</p>" ?>

                <label for="apellido">Nuevo email:</label>

                <input type="text" name="email"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Insertar nueva contraseña</p>" ?>

                <label for="apellido">CI:</label>

                <input type="text" name="CI"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Insertar nuevo telofono</p>" ?>

                <label for="apellido">telefono:</label>

                <input type="text" name="telefono"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Insertar nueva contraseña</p>" ?>

                <label for="apellido">Nueva Contraseña:</label>

                <input type="text" name="password"><br><br>

            </div>
            <div class="subcontenedor">

                <label for="cargo">Cargo:</label>

                <input type="text" name="cargo"><br><br>

            </div>
            <div class="subcontenedor">

                <input type="submit" value="Actualizar">

            </div>
    </div>

</body>

</html>