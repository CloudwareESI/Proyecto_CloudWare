<?php
include "../../db/funciones_utiles.php";
$op = $_POST['op'];
switch ($op) {
    case 'agregar':

        $x = 0;
        $ubicaciones = array();

        $rutas = json_decode(
            llamadoDeAPI(
                "GET",
                "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
                NULL
            ),
            true
        );

        foreach ($rutas as $ruta) {
            foreach ($ruta as $posicion) {
                $id = array($posicion["id_ruta"] + 1);
            }
        }

        echo "<br> ";

        foreach ($_POST["almacen"] as $fila) {
            $ubicacion = array(
                $posicion["id_ruta"] + 1,
                $fila,
                $x,
                $_POST["tiempo"][$x]
            );

            echo "<br>";
            echo "<br>";
            var_dump($ubicacion);
            echo "<br>";

            $ubicaciones[$x] = $ubicacion;
            $x = $x + 1;
        }

        $datos = array($id, $ubicaciones);
        llamadoDeAPI(
            "PUT",
            "http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
            $datos
        );

        break;

    case 'eliminar_ruta':

        $datos = array($_POST["id"]);
        llamadoDeAPI(
            "DELETE",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
            $datos
        );

        break;


    case 'eliminar_ubicacion':

        $datos = array(
            $_POST["id_ruta"],
            $_POST["id_almacen"]
        );
        var_dump($datos);
        llamadoDeAPI(
            "DELETE",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
            $datos
        );

        break;
    default:
        # code...
        break;
}
//header("Location:http://".$_SERVER["HTTP_HOST"]."/Proyecto_Cloudware/Administracion.php");
