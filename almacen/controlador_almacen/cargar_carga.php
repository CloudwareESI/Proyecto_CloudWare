<?php
require_once "../../db/funciones_utiles.php";
require_once "super_controlador_almacen.php";

switch ($_POST["opcion"]) {
    case 'lote':
        $matricula = $_POST['matricula'];
        $dia = date('Y-m-d H:i:s');

        foreach ($_POST["lotes"] as $fila) {
            $id_lote = array($fila);

            $valor = json_decode(
                llamadoDeAPI(
                    "GET",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
                    $id_lote
                ),
                true
            );

            $valor_extraido =  $valor[0];

            $destinado = array(
                $matricula,
                $valor_extraido["fecha_de_entrega"],
                $dia, $valor_extraido["id_lote"]
            );
            llamadoDeAPI(
                "POST",
                "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
                $destinado
            );
        }
        break;




    case 'paquete':
        $matricula = $_POST['matricula'];

        foreach ($_POST["paquetes"] as $fila) {
            $id_paquete = array($fila);

            $identificador = array('id_paquete' => $fila);
            $valor = json_decode(llamadoDeAPI(
                "GET",
                "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                $identificador
            ), true);

            $valor_extraido =  $valor[0];



            $paquete = array(
                $valor_extraido["nombre_paquete"],
                $valor_extraido["dimenciones"],
                $valor_extraido["peso"],
                $valor_extraido["fragil"],
                $valor_extraido["destino_calle"],
                $valor_extraido["fecha_recibido"],
                $valor_extraido["fecha_entrega"],
                date('Y-m-d H:i:s'),
                $valor_extraido["fecha_ingreso"],
                $valor_extraido["id_lote_portador"],
                $valor_extraido["id_localidad_destino"],
                $matricula,
                $valor_extraido["id_paquete"]
            );

            llamadoDeAPI(
                "POST",
                "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                $paquete
            );
        }
        break;



    case 'formar':
        $locacion = NULL;
        if (!isset($_POST['paquetes'])) {
            if (!isset($_POST["id_almacen"])) {
                echo "entrada";
                header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/index.php?Entrada");
            } else {
                echo $_POST["id_almacen"];
                header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware?id_almacen=" . $_POST["id_almacen"] . "&Almacenes=1");
            }
        } else {

            foreach ($_POST["paquetes"] as $fila) {
                $id_paquete = array("id_paquete" => $fila);

                $valor = json_decode(llamadoDeAPI(
                    "GET",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                    $id_paquete
                ), true);


                $paquete = $valor[0];
                echo "<br>". $paquete["id_localidad_destino"] . "<br>";

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

            

            //Marcamos si hay una alamacen destino
            if (isset($_POST["destino"])) {
                $vars_destino = explode("|", $_POST["destino"]);
                $var_destino = array($vars_destino["0"], $vars_destino["1"], NULL);
                $var_lote = array("0");
            } else {
                $var_destino = array("0", "1", NULL);
                $var_lote = array("1");
            }
            $vars = array($var_lote, $var_destino);


            $id_lote =
                llamadoDeAPI(
                    "PUT",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
                    $vars,
                    true
                );




            foreach ($_POST["paquetes"] as $fila) {
                $id_paquete = array("id_paquete" => $fila);

                $valor = json_decode(llamadoDeAPI(
                    "GET",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                    $id_paquete
                ), true);

                $paquete = $valor[0];


                echo "<br>";
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
                    $id_lote,
                    $paquete['id_localidad_destino'],
                    $paquete['matricula_transporte'],
                    $paquete['id_paquete'],
                );
                llamadoDeAPI(
                    "POST",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
                    $pack
                );
            }
        }

        break;
}

if (!isset($_POST["id_almacen"])) {
    echo "entrada";
    header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/index.php?Entrada");
} else {
    echo $_POST["id_almacen"];
    header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware?id_almacen=" . $_POST["id_almacen"] . "&Almacenes=1");
}
