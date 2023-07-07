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
        <div class="subcontenedor">
            <h1>Eliminar Persona</h1>
            <?php
            $bd = new mysqli("localhost", "root", "", "php");
            $p = $bd->query(' select * from personas where id=' . $_GET['id'] . ''); //recive el ID de la persona, primeras comillas para el comando segundas para el get
            $personas = $p->fetch_array(MYSQLI_ASSOC);
            echo '<h4>¿Esta seguro que desea eliminar a ' . $personas['nombre'] .' '. $personas['apellido'] . ' ?</h4>';

            echo '<div class="box subcontenedor"><a href="eliminar.php?id=' . $personas['id'] . '"><b>CONFIRMAR</b><img class="icnEliminar" src="../assets/eliminar.png"></a></div>';
            ?>
        </div>
        </div>
</body>

</html>