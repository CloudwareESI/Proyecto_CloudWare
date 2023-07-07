<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry.png">
    <link rel="stylesheet" href="http://localhost/Proyecto_Cloudware/estilos/estilo.css">
    <title> Almacen QuickCarry</title>
</head>
<?php
session_start();
if ($_SESSION['empleado'] == 1) {
    # code...
} else {
    header("Location:http://localhost/Proyecto_Cloudware/index.php?error=No deberias estar aqui");
}
?>

<body>
    <header>
        <div class="home">
            <a href="http://localhost/Proyecto_Cloudware/index.php"><img id="imgLogin" 
            src="http://localhost/Proyecto_Cloudware/imagenes/imagen-home.png" 
            width="70px" height="70px"></a>
        </div>
    </header>


    <div class="contenedor flex">

        <h1>Central de almacenes</h1>
        <?php
        include "../utils/funciones_utiles.php"; //httpRequest ahora esta aqui

        $inst = json_decode(httpRequest("http://127.0.0.1/PROYECTO_CLOUDWARE/php/apis/api_almacen.php", "1", "0"), true);

        echo "<table class='tabla'>
        <thead>
        <tr>
        <td id='titulo' colspan='6' id='imagenTabla'>
        Almacenes
        </td>
        </tr>
        <tr>
        <td>N° almacen</td> 
        <td id='titulo'>Dirección</td> 
        <td id='titulo'>Ciudad</td> 
        <td id='titulo'>Modificar</td>
        </tr></thead>";
        foreach ($inst as $fila) {
            echo '<tr>

            <td>' . $fila['id_almacen'] . '</td>  

            <td>' . $fila['direccion'] . '</td>

            <td>' . $fila['ciudad'] . '</td>

            <td id="imagenTabla">' . '<a href="../interfaces/almacen.php?id=' . $fila['id_almacen'] . '"><img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png" width="60px" height="60px"></a>' . '</td>
            </td>
            </tr></tbody>';
        }
        echo "</table><br><br><br>";


        ?>
</body>

</html>