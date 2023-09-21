<?php

require_once "../modelo_camiones/clase_camion.php";

$camion = new camion();



$id = array('2');


$cami = $camion->get_camion($id);
var_dump($cami);
echo "<br>";
echo "<br>";



$A = json_encode($cami);
var_dump($A);
echo "<br>";
echo "<br>";
