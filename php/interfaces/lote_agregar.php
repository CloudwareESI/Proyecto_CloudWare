<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry.png">
    <link rel="stylesheet" href="http://localhost/Proyecto_Cloudware/estilos/estiloLoteEdit.css">
    <title> Almacen QuickCarry</title>

<body>
    <div class="contenedor">
        <?php
        include "../utils/funciones_utiles.php";
        $id_a = $_GET['id_a'];
        
        ?>




        <form action="../apis/api_almacen.php" method="post">
            <div class="dentro">
                <h1>Nuevo Lote para la almacen n°<?php echo $id_a; ?></h1>
                <input type="hidden" name="id_a" value=<?= $id_a ?>>
                <input type="hidden" name="opcion" value="6">

                <div class="subcontenedor">
                    

                    <label for="nombre_lote">Nombre:</label>

                    <input type="text" name="nombre_lote" placeholder="">
                    <br><br>

                </div>
                <div class="subcontenedor">

                    <label for="peso">Peso:</label>

                    <input type="text" name="peso" placeholder="">
                    <br><br>

                </div>
                <div class="subcontenedor">

                    

                    <label for="dimensiones">Dimensiones:</label>

                    <input type="text" name="dimensiones" placeholder="">
                    <br><br>

                </div>
                <div class="subcontenedor">

                    <input type="submit" value="Actualizar" id="actualizar">

                </div>
            </div>
        </form>
</body>

</html>