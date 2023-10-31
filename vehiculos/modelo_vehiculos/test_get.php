<?php

require_once "clase_ruta.php";

$vehiculos = new rutas();



$id = array('2');


$veh = $vehiculos->get_rutas_all();
var_dump($veh);
echo "<br>";
echo "<br>";



$A = json_encode($veh);
var_dump($A);
echo "<br>";
echo "<br>";
