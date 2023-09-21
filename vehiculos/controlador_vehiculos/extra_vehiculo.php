<?php
require_once "../modelo_vehiculos/func_camion.php";

$estado = marcha(array($_GET["matricula"]));


header("Location:http://localhost/proyecto_cloudware_v2/vehiculos/views_vehiculos/vehiculo.php?matricula=" .
    $_GET['matricula'] .
    "&rol=" . $_GET['rol'] .
    "&estado=" . $estado);
