<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="Imagenes/Logo_quickcarry.png">
    <link rel="stylesheet" href="http://localhost/Proyecto_Cloudware/css/estilo.css">
    <title>Almacen <?php echo "1"; //aqui pondremos el id eventualmente 
                    ?></title>
</head>
<?php
session_start();
if ($_SESSION['empleado'] == 1) {
    # code...
} else {
    header("Location:http://localhost/Proyecto_Cloudware/index.php?");
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

        <h1>Gestión de almacén</h1>
        <?php
        include "../utils/funciones_utiles.php"; //httpRequest ahora esta aqui

        $id = $_GET['id'];
        $inst = json_decode(httpRequest("http://127.0.0.1/PROYECTO_CLOUDWARE/php/apis/api_almacen.php", "2", $id), true);

        echo "<table class='tabla'>
        <thead>
        <tr>
        <td id='titulo' colspan='6' id='imagenTabla'>
        Lotes
        </td>
        </tr>
        <tr>
        <td id='titulo'>Nombre</td> 
        <td id='titulo'>Id</td> 
        <td id='titulo'>Peso</td> 
        <td id='titulo'>Dimensiones</td> 
        <td id='titulo'>Editar</td>
        <td id='titulo'>Eliminar</td>
        </tr>
        <thead>";
        foreach ($inst as $fila) {
            echo '<tbody>
            <tr>

            <td>' . $fila['nombre_lote'] . '</td>  

            <td>' . $fila['id_lote'] . '</td>

            <td>' . $fila['peso'] . ' kg' . '</td>

            <td>' . $fila['dimensiones'] . ' cm3' . '</td>

            <td id="imagenTabla">' . '<a href="../interfaces/lote_edit.php?id=' . $fila['id_lote'] .
                '&id_a=' . $fila['almacen_id'] . '"><img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png" width="60px" height="60px"></a>'
                . '</td>

            <td id="imagenTabla">' . '<a href="../interfaces/lote_del.php?id=' . $fila['id_lote'] .
                '&id_a=' . $fila['almacen_id'] . '"><img id="imagenTabla" src="http://localhost/Proyecto_Cloudware/imagenes/imagenBorrar.png" width="60px" height="60px"></a>'
                . '</td>

            </td>
            </div></td>
            </tr>
            </tbody>';
        }
        echo "
        <tr>
        <td  colspan='6' id='imagenTabla'>
        Agregar

        <a href='../interfaces/lote_agregar.php?id_a=" . $id . "'>
        <img id='imagenTabla' 
        src='http://localhost/Proyecto_Cloudware/imagenes/imagenEditar.png' width='60px' height='60px'>
        </a>

        </td>
        </tr>
        </table><br><br><br>";
        ?>

</body>

</html>