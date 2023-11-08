<?php
require_once "../controlador_vehiculos/super_controlador_vehiculos.php";
require_once "../../db/funciones_utiles.php";
switch ($_GET["opcion"]) {
    case 'marcha':
        $vehiculo = marcha($_GET["matricula"]);
        header("Location:http://".$_SERVER["HTTP_HOST"]."/proyecto_cloudware/vehiculos/views_vehiculos/vehiculo.php?matricula=" .
        $_GET['matricula'] . "&rol=" . $_GET['rol'] . "&estado=" . $vehiculo["0"]);
        break;
}


