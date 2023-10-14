<?php
require "../../db/funciones_utiles.php";
require_once "../modelo_almacen/clase_paquetes.php";
require_once "../modelo_almacen/clase_lotes.php";
require "super_controlador_almacen.php";

$paquetes = new paquetes();

$locacion = NULL;


foreach ($_POST["paquetes"] as $fila) {
    $id_paquete = array("id_paquete" => $fila);

    $valor = get_paquete($id_paquete);

    $paquete = $valor[0];


    echo "<br>";
    if (isset($locacion)) {
        if ($locacion === $paquete["id_localidad_destino"]) {
            echo "misma Locacion";
        } else {
        }
    } else {
        $locacion = $paquete["id_localidad_destino"];
    }
}



$Alms = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php", NULL);
$almacenes = json_decode($Alms, true);
echo "<br>";
var_dump($almacenes);
echo "<br>";
foreach ($almacenes as $fila) {
    if ($fila["id_localidad_almacen"] === $locacion) {
        if (isset($_POST["id_almacen"])) {
            $var = array($_POST["id_almacen"], $locacion);
        } else {
            $var = array(NULL, "1");
        }



        $L = llamadoDeAPI("PUT", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php", $var);

        var_dump($L);


        foreach ($_POST["paquetes"] as $fila) {
            $id_paquete = array("id_paquete" => $fila);

            $valor = get_paquete($id_paquete);

            $paquete = $valor[0];
            var_dump($paquete);


            $paquete['id_lote_portador'] = $L;

            echo "<br>";
            var_dump($paquete);
            $pack = array(
                $paquete['nombre_paquete'],
                $paquete['dimenciones'],
                $paquete['peso'],
                $paquete['fragil'],
                $paquete['destino_calle'],
                $paquete['fecha_recibido'],
                $paquete['fecha_entrega'],
                $paquete['fecha_cargado'],
                $paquete['fecha_ingreso'],
                $paquete['id_lote_portador'],
                $paquete['id_localidad_destino'],
                $paquete['id_paquete'],
            );
            $P = llamadoDeAPI("POST", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", $pack);
        }

        header("Location:http://localhost/Proyecto_Cloudware/index.php");


        exit;
    }
}
