<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry.png">
    <link rel="stylesheet" href="">
    <title> Almacen QuickCarry</title>



<body>
    <div class="contenedor">
        <?php
        include "../utils/funciones_utiles.php";
        //Llamamos a el archivo donde tenemos nuestra funcion httpRequest
        $id=$_GET['id'];
        $id_a=$_GET['id_a'];
        //Recibimos las variables con el ID del lote a eliminar y la ID de el almacen para regresar a la pagina de edición de ella.
        ?>


        <h1>Modificacion de datos</h1>

        <form action="../apis/api_almacen.php" method="post">

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="id_a" value=<?= $id_a ?>>
            <input type="hidden" name="opcion" value="5">

            <h2> Esta seguro que quiere marcar el lote n°<?php echo $id; ?> como dañado? </h2>

            </div>
            <div class="subcontenedor">

                <input type="submit" value="Estoy seguro">

            </div>

        </form>
</body>

</html>