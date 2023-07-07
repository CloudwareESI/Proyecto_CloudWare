<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Agregar</title>
</head>

<body>
    <div class="contenedor">
        <h1>Agregar datos</h1>
        <form action="agregar.php" method="post">
            <div class="subcontenedor">
                <label for="nombre">Nombre:</label>

                <input type="text" name="nombre"><br>
            </div>
            <div class="subcontenedor">
                <label for="apellido">Apellido:</label>

                <input type="text" name="apellido"><br><br>
            </div>
            <div class="subcontenedor">
                <label for="email">Email:</label>

                <input type="text" name="email"><br><br>
            </div>
            <div class="subcontenedor">
                <label for="contraseña">Contraseña:</label>

                <input type="text" name="password"><br><br>
            </div>


            <input type="submit" value="Añadir">
        </form>
    </div>
</body>

</html>