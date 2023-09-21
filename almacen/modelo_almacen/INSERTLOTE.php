<?php

include "../../db/db_conn.php";

$base_datos = new base_de_datos();
$conexion = $base_datos->conexion();



$insert = "INSERT INTO lote VALUES ( NULL, CURDATE() , NULL); ";

$resultado = $conexion->execute_query($insert);
echo "<br>";
echo "<br>";
echo "New record has id: " .$conexion -> insert_id;
echo "<br>";
echo "<br>";
