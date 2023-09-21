<?php

require_once "../modelo_vehiculos/clase_vehiculos.php";

$vehiculos = new vehiculos();



$id = array('2');


$veh = $vehiculos->get_vehiculos($id);
var_dump($veh);
echo "<br>";
echo "<br>";



$A = json_encode($veh);
var_dump($A);
echo "<br>";
echo "<br>";
