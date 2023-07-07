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
        $id = $_GET['id'];
        $id_a = $_GET['id_a'];
        $inst = json_decode(httpRequest("http://127.0.0.1/PROYECTO_CLOUDWARE/php/apis/api_almacen.php", "4", $id), true);
        ?>




        <form action="../apis/api_almacen.php" method="post">
            <div class="dentro">
                <h1>Modificacion de datos</h1>

                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="id_a" value=<?= $id_a ?>>
                <input type="hidden" name="opcion" value="3">

                <div class="subcontenedor">
                    

                    <label for="nombre_lote">Nuevo nombre:</label>

                    <input type="text" name="nombre_lote" placeholder="<?= "Nombre actual: " . $inst['nombre_lote'] . "" ?>"><br><br>

                </div>
                <div class="subcontenedor">

                    <label for="peso">Nuevo peso:</label>

                    <input type="text" name="peso" placeholder="<?= "Peso actual:" . $inst['peso'] . " kg" ?>"><br><br>

                </div>
                <div class="subcontenedor">

                    

                    <label for="dimensiones">Nuevas dimensiones:</label>

                    <input type="text" name="dimensiones" placeholder="<?= "dimensiones actuales:" . $inst['dimensiones'] . " cm3" ?>"><br><br>

                </div>
                <div class="subcontenedor">

                    <input type="submit" value="Actualizar" id="actualizar">

                </div>
            </div>
        </form>
</body>

</html>