<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>BD</title>
</head>

<body>
    <div class="contenedor">
        <?php
        $bd = new mysqli("localhost", "root", "", "php"); //llama a la BD
        $p = $bd->query(' select * from personas where id=' . $_GET['id'] . ''); //recive el ID de la persona, primeras comillas para el comando segundas para el get
        $persona = $p->fetch_array(MYSQLI_ASSOC);
        ?>
        <h1>Modificacion de datos</h1>
        <form action="modificar.php" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

            <div class="subcontenedor">
                <?= "<p>Nombre actual: " . $persona['nombre'] . "</p>" ?> <!-- Esta line llama al nombre desde la BD-->

                <label for="nombre">Nuevo nombre:</label>

                <input type="text" name="nombre"><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Apellido actual:" . $persona['apellido'] . "</p>" ?>

                <label for="apellido">Nuevo apellido:</label>

                <input type="text" name="apellido"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Apellido actual:" . $persona['email'] . "</p>" ?>

                <label for="apellido">Nuevo email:</label>

                <input type="text" name="email"><br><br>

            </div>
            <div class="subcontenedor">

                <?= "<p>Apellido actual:" . $persona['password'] . "</p>" ?>

                <label for="apellido">Nueva Contraseña:</label>

                <input type="text" name="password"><br><br>

            </div>
            <div class="subcontenedor">

                <input type="submit" value="Actualizar">

            </div>

        </form>
</body>

</html>