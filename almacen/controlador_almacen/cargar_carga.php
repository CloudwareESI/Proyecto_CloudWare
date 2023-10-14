<?php
require_once "../modelo_almacen/clase_lotes.php";
require "../../db/funciones_utiles.php";
require_once "../modelo_almacen/clase_paquetes.php";
require "super_controlador_almacen.php";



switch ($_POST["opcion"]) {
    case 'lote':
        $matricula = $_POST['matricula'];

        foreach ($_POST["lotes"] as $fila) {
            $id_lote = array($fila);

            $valor = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php", $id_lote);
            $valor_extraido =  $valor[0];
            $lote = array(
                $valor_extraido["fecha_creacion"],
                $valor_extraido["fecha_de_entrega"],
                $valor_extraido["fecha_transporte"],
                $valor_extraido["id_almacen"],
                $matricula,
                $valor_extraido["id_destino"],
                $valor_extraido["id_lote"]
            );
            llamadoDeAPI("POST", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php", $lote);
            
        }
        break;




    case 'paquete':
        $matricula = $_POST['matricula'];

        foreach ($_POST["paquete"] as $fila) {
            $id_paquete = array($fila);

            $identificador = array('id_paquete' => $id_paquete);
            $valor = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", $identificador);

            $valor_extraido =  $valor[0];
            $paquete = array(
                $valor_extraido["nombre_paquete"],
                $valor_extraido["dimenciones"],
                $valor_extraido["peso"],
                $valor_extraido["fragil"],
                $valor_extraido["destino_calle"],
                $valor_extraido["fecha_recibido"],
                $valor_extraido["fecha_entrega"],
                $valor_extraido["fecha_cargado"],
                $valor_extraido["fecha_ingreso"],
                $valor_extraido["id_lote_portador"],
                $valor_extraido["id_localidad_destino"],
                $matricula,
                $valor_extraido["id_paquete"]
            );
            $paquetes->llamadoDeAPI("POST", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", $paquete);

        }
        break;



    case 'formar':
        $locacion = NULL;


        foreach ($_POST["paquetes"] as $fila) {
            $id_paquete = array("id_paquete" => $fila);
            
            $valor =json_decode(llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_paquetes.php", $id_paquete), true);

            
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



        $Alms = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_almacen.php", NULL);
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



                $id_lote = llamadoDeAPI("PUT", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_lotes.php", $var);

                var_dump($id_lote);


                foreach ($_POST["paquetes"] as $fila) {
                    $id_paquete = array("id_paquete" => $fila);

                    $valor =json_decode(llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_paquetes.php", $id_paquete), true);

                    $paquete = $valor[0];
                    var_dump($paquete);

                    echo "<br>";
                    var_dump($paquete);
                    $pack = array(
                        $paquete['nombre_paquete'],
                        $paquete['dimenciones'],
                        $paquete['peso'],
                        $paquete['fragil'],
                        $paquete['destino_calle'],
                        $paquete['fecha_entrega'],
                        $paquete['fecha_recibido'],
                        $paquete['fecha_cargado'],
                        $paquete['fecha_ingreso'],
                        $id_lote,
                        $paquete['id_localidad_destino'],
                        $paquete['matricula_transporte'],
                        $paquete['id_paquete'],
                    );
                    llamadoDeAPI("POST", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_paquetes.php", $pack);
                }

                //header("Location:http://localhost/Proyecto_Cloudware/index.php");


                exit;
            }
        }

        break;
}
//header("Location:http://localhost/Proyecto_Cloudware/index.php");
