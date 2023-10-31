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
                "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
                NULL
            ),
            true
        );

        foreach ($rutas as $ruta) {
            foreach ($ruta as $ubicacion) {
                $id = array($ubicacion["id_ruta"]+1);

            }

        }

        echo "<br> ";

        foreach ($_POST["almacen"] as $fila) {
            $ubicacion = array(
                NULL,
                $fila,
                $x,
                $_POST["tiempo"][$x]
            );



            $ubicaciones[$x] = $ubicacion;
            $x = $x + 1;
        }

        $datos = array($id, $ubicaciones);
        llamadoDeAPI("PUT", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php", $datos);

        break;

        case 'eliminar':
    
            $datos = array($id);
            llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php", $datos);
    
            break;

    default:
        # code...
        break;
}
header("Location:http://localhost/Proyecto_Cloudware/Administracion.php");
