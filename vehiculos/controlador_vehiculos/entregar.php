<?php
require_once "../../db/funciones_utiles.php";
require_once "../../almacen/controlador_almacen/super_controlador_almacen.php";

switch ($_POST["opcion"]) {
    case 'lote':


        foreach ($_POST["lotes"] as $fila) {
            $id_lote = array($fila);

            $valor = json_decode(
                llamadoDeAPI(
                    "GET",
                    "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
                    $id_lote
                ),
                true
            );

            $paquetes = json_decode(
                llamadoDeAPI(
                    "GET",
                    "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquete.php",
                    array("id_lote" => $id_lote)
                ),
                true
            );

            if ($valor[0]["id_ruta"] = 1) {
                foreach ($paquetes as $key => $valor_extraido) {
                    $paquete = array(
                        $valor_extraido["nombre_paquete"],
                        $valor_extraido["dimenciones"],
                        $valor_extraido["peso"],
                        $valor_extraido["fragil"],
                        $valor_extraido["destino_calle"],
                        date('Y-m-d H:i:s'),
                        NULL,
                        $valor_extraido["fecha_cargado"],
                        $valor_extraido["fecha_ingreso"],
                        $valor_extraido["id_lote_portador"],
                        $valor_extraido["id_localidad_destino"],
                        $valor_extraido["matricula"],
                        $valor_extraido["id_paquete"]
                    );
                    $paquetes->llamadoDeAPI(
                        "POST",
                        "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                        $paquete
                    );
                }
            }

            $valor_extraido =  $valor[0];
            $destinado = array(
                $valor_extraido["matricula"],
                date('Y-m-d H:i:s'),
                $valor_extraido["fecha_transporte"],
                $valor_extraido["id_lote"]
            );

            llamadoDeAPI(
                "POST",
                "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
                $destinado
            );
        }

        break;

    case 'paquete':

        $paquete = new lotes();

        foreach ($_POST["paquete"] as $fila) {
            $id_paquete = array($fila);

            $identificador = array('id_paquete' => $id_paquete);
            $valor = llamadoDeAPI(
                "GET",
                "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                $identificador
            );

            $valor_extraido =  $valor[0];
            $paquete = array(
                $valor_extraido["nombre_paquete"],
                $valor_extraido["dimenciones"],
                $valor_extraido["peso"],
                $valor_extraido["fragil"],
                $valor_extraido["destino_calle"],
                $valor_extraido["fecha_recibido"],
                date('Y-m-d H:i:s'),
                $valor_extraido["fecha_cargado"],
                $valor_extraido["fecha_ingreso"],
                $valor_extraido["id_lote_portador"],
                $valor_extraido["id_localidad_destino"],
                $valor_extraido["matricula"],
                $valor_extraido["id_paquete"]
            );
            $paquetes->llamadoDeAPI(
                "POST",
                "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                $paquete
            );
        }
        break;

    default:
        echo "esto no deberia pasar";
        break;
}
//header("Location:http://".$_SERVER["HTTP_HOST"]."/Proyecto_Cloudware/vehiculos/views_vehiculos/vehiculo.php");