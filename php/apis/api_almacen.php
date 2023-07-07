<?php
//recivimos parametros de el cURL
$opcion = $_POST['opcion'];
if (empty($opcion)) {
    $opcion = $_GET['opcion'];
}


$bd = new mysqli("localhost", "root", "", "php");

switch ($opcion) {
    case 0:

        echo "i es igual a 0";

        break;


    case 1:

        //llama a BD
        $inst = $bd->query("select * from almacen");

        header('content-type: application/json'); //marca que se lanza un archivo json

        $matriz = array();

        foreach ($inst->fetch_all(MYSQLI_ASSOC) as $fila) {


            $p = ["id_almacen" => $fila['id_almacen'], "direccion" => $fila['direccion'], "ciudad" => $fila['ciudad']];


            array_push($matriz, $p); //Agregamos otra linea, esto se repite hasta que no tengamos sufficientes datos
        }

        echo json_encode($matriz); //codifica nuestro array a JSON

        break;


    case 2:

        $id = $_POST['id'];

        $inst = $bd->query("select * from lote where almacen_id = " . $id . '');

        header('content-type: application/json'); //marca que se lanza un archivo json


        $matriz = array();

        foreach ($inst->fetch_all(MYSQLI_ASSOC) as $fila) {


            $p = ["id_lote" => $fila['id_lote'], "nombre_lote" => $fila['nombre_lote'], "peso" => $fila['peso'], "dimensiones" => $fila['dimensiones'], "almacen_id" => $fila['almacen_id']];


            array_push($matriz, $p); //Agregamos otra linea, esto se repite hasta que no tengamos sufficientes datos
        }

        echo json_encode($matriz); //codifica nuestro array a JSON

        break;


    case 3:
        $id = $_POST['id'];

        $nombre_lote = $_POST['nombre_lote'];
        $peso = $_POST['peso'];
        $dimensiones = $_POST['dimensiones'];
        //recivimos variables a editar
        $update = "UPDATE lote SET 
            nombre_lote='" . $nombre_lote . "
            ', peso='" . $peso . "
            ', dimensiones='" . $dimensiones . "
            ' Where lote.id_lote='" . $id . "'";

        $bd->query($update);

        header('Location:../interfaces/almacen.php?id=' . $_POST['id_a'] . '');

        break;


    case 4:
        $id = $_POST['id'];

        $lote = $bd->query(' select * from lote where id_lote=' . $id . ''); //recibe el ID de la persona, primeras comillas para el comando segundas para el get

        header('content-type: application/json');


        $matriz = $lote->fetch_array(MYSQLI_ASSOC);

        echo json_encode($matriz); //codifica nuestro array a JSON

        break;


    case 5:
        $id = $_POST['id'];

        $delete = "DELETE FROM lote WHERE lote.id_lote='" . $id . "'";

        $bd->query($delete); //querry da ordenes a la BD

        header('Location:../interfaces/almacen.php?id=' . $_POST['id_a'] . ''); //HEADER CAMBIA LA PAGINA

        break;

    case 6:


        $nombre_lote = $_POST['nombre_lote'];
        $peso = $_POST['peso'];
        $dimensiones = $_POST['dimensiones'];
        $id_a = $_POST['id_a'];
        //recivimos variables a insertar
        $insert = "INSERT INTO lote VALUES ( NULL,'$nombre_lote','$peso','$dimensiones','$id_a')"; //inserta una nueva linea a la BD

        $bd->query($insert);

        header('Location:../interfaces/almacen.php?id=' . $_POST['id_a'] . ''); //HEADER CAMBIA LA PAGINA

        break;

    default:

        header('content-type: application/json');
        $matriz = array(

            'mensaje' => 'error'


        );
        echo json_encode($matriz); //lanza un JSON donde la unica variable llama un error.

        break;
}
