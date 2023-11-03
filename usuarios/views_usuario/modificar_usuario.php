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

    <div class="contenedorFormulario">

        <form action="../controlador_usuario/agregar_usu.php" method="post">
            <div class="formulario">
                <h2>Modificacion de datos</h2>
                <input type="hidden" name="op" value="modificar">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="viejo" value="<?= $_GET['email'] ?>">

                <div class="formularioModificar">
                    <?= "<p>Nombre actual: " . $_GET['nombre'] . "</p>" ?>
                    <label for="nombre">Nuevo nombre:</label>
                    <input type="text" name="nombre">
                </div>

                <div class="formularioModificar">

                    <?= "<p>Apellido actual: " . $_GET['apellido'] . "</p>" ?>

                    <label for="apellido">Nuevo apellido:</label>

                    <input type="text" name="apellido">

                </div>
                <div class="formularioModificar">

                    <?= "<p>Mail actual: " . $_GET['email'] . "</p>" ?>

                    <label for="apellido">Nuevo email:</label>

                    <input type="text" name="email">

                </div>
                <div class="formularioModificar">

                    <?= "<p>Insertar nueva contraseña</p>" ?>

                    <label for="apellido">CI:</label>

                    <input type="text" name="CI">

                </div>
                <div class="formularioModificar">

                    <?= "<p>Insertar nuevo telofono</p>" ?>

                    <label for="apellido">telefono:</label>

                    <input type="text" name="telefono">

                </div>
                <div class="formularioModificar">

                    <?= "<p>Insertar nueva contraseña</p>" ?>

                    <label for="apellido">Nueva Contraseña:</label>

                    <input type="text" name="password">

                </div>
                <div class="formularioModificar">

                    <label for="cargo">Cargo:</label>

                    <input type="text" name="cargo">

                </div>
                <div class="btn">

                    <input id="btn" type="submit" value="Actualizar">

                </div>
            </div>
        </form>
    </div>
</body>

</html>