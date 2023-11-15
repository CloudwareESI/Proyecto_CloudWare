<?php
include "../../db/funciones_utiles.php";
$op = $_POST['op'];

var_dump($_POST);
echo "<br>";
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
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $paquete
        );

        break;


    case 'modificar':

        $identificador = array('id_paquete' => $_POST['id_paquete']);
        $valor = json_decode(llamadoDeAPI(
            "GET",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $identificador
        ), true)[0];

        $nombre_paquete = $_POST['nombre_paquete'];

        $dimenciones = $_POST['dimenciones'];

        $peso = $_POST['peso'];

        $fragil = $_POST['fragil'];

        $id_paquete = $_POST['id_paquete'];




        $paquete = array(
            $nombre_paquete,
            $dimenciones,
            $peso,
            $fragil,
            $_POST['calle_destino'],
            $valor["fecha_recibido"],
            $valor["fecha_entrega"],
            $valor["fecha_cargado"],
            $valor["fecha_ingreso"],
            $valor["id_lote_portador"],
            $_POST['localidad_destino'],
            $valor["matricula_transporte"],
            $_POST['id_paquete']
        );
        echo "<br>";
        var_dump($paquete);
        echo "<br>";
        $L = llamadoDeAPI(
            "POST",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $paquete
        );

        echo "<br> Proyecto_CloudwareProyecto_Cloudware";
        break;

    case 'eliminar':

        $id = array($_POST["id_paquete"]);
        llamadoDeAPI(
            "DELETE",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $id
        );

        break;

    case 'eliminarLote':

        $id = array($_POST["id_lote"]);
        llamadoDeAPI(
            "DELETE",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
            $id
        );

        break;
    default:

        break;
}

if (!isset($_POST["id_almacen"])) {
    echo "<br>entrada";
    header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/index.php?Entrada");
} else {
    echo "<br> almacen detectada".$_POST["id_almacen"];
    header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware?id_almacen=" . $_POST["id_almacen"] . "&Almacenes=1");
}
