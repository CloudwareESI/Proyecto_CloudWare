<?php
include "../../db/funciones_utiles.php";
$op = $_POST['op'];

switch ($op) {

    case 'agregar':

        $chapa = $_POST['chapa'];
        $destino_calle = $_POST['calle_destino'];
        $id_localidad_destino = $_POST['localidad_destino'];

        $almacen = array(
            $destino_calle,
            $chapa,
            $id_localidad_destino
        );

        $L = llamadoDeAPI(
            "PUT",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
            $almacen
        );

        break;

    case 'eliminar':
        $id = array($_POST["id_almacen"]);
        llamadoDeAPI(
            "DELETE",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
            $id
        );

        break;
    default:

        break;
}


header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/index.php?Almacenes");
