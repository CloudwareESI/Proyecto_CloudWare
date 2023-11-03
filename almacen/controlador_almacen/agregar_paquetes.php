<?php
include "../../db/funciones_utiles.php";
$op = $_POST['op'];

switch ($op) {

    case 'agregar':

        $nombre_paquete = $_POST['nombre_paquete'];

        $dimenciones = $_POST['dimenciones'];

        $peso = $_POST['peso'];

        $fragil = $_POST['fragil'];

        $destino_calle = $_POST['calle_destino'];
        $id_localidad_destino = $_POST['localidad_destino'];

        $paquete = array(
            $nombre_paquete,
            $dimenciones,
            $peso,
            $fragil,
            $destino_calle,
            $id_localidad_destino,
        );

        $L = llamadoDeAPI(
            "PUT",
            "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $paquete
        );

        break;


    case 'modificar':
        $nombre_paquete = $_POST['nombre_paquete'];

        $dimenciones = $_POST['dimenciones'];

        $peso = $_POST['peso'];

        $fragil = $_POST['fragil'];

        $id_paquete = $_POST['id_paquete'];

        $fecha_recibido = $_POST['fecha_recibido'];
        if (isset($fecha_recibido)) {
            $fecha_recibido = NULL;
        }

        $fecha_entrega = $_POST['fecha_entrega'];
        if (isset($fecha_entrega)) {
            $fecha_entrega = NULL;
        }
        $fecha_cargado = $_POST['fecha_entrega'];
        if (isset($fecha_entrega)) {
            $fecha_entrega = NULL;
        }

        $id_lote = $_POST['id_lote'];
        if (isset($id_lote)) {
            $id_lote = NULL;
        }
        $matricula_transporte = $_POST['matricula_transporte'];
        if (isset($matricula_transporte)) {
            $matricula_transporte = NULL;
        }

        $id_almacen = $_POST['id_almacen'];

        $id_cruce = $_POST['id_cruce'];

        $paquete = array(
            $nombre_paquete,
            $dimenciones,
            $peso,
            $fragil,
            $destino_calle,
            $fecha_recibido,
            $fecha_entrega,
            $fecha_cargado,
            $fecha_ingreso,
            $id_lote,
            $id_localidad_destino,
            $matricula_transporte,
            $id_paquete,
        );

        $L = llamadoDeAPI(
            "POST",
            "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $paquete
        );

        echo "<br> Proyecto_CloudwareProyecto_Cloudware";
        break;

    case 'eliminar':

        $id = array($_POST["id_paquete"]);
        llamadoDeAPI(
            "DELETE",
            "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $id
        );

        break;

    case 'eliminarLote':

        $id = array($_POST["id_lote"]);
        llamadoDeAPI(
            "DELETE",
            "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
            $id
        );

        break;
    default:

        break;
}

if ($_POST["id_almacen"] = "N/A") {
    //header("Location:http://localhost/Proyecto_Cloudware?id_almacen=".$_POST["id_almacen"]."&Almacenes=1");

} else {
    //header("Location:http://localhost/Proyecto_Cloudware/index.php?Entrada");

}
