<?php 

function obtenerCamiones(){
    require "../../db/db_conn.php";

    $base_datos = new base_de_datos();
    $query = "SELECT * FROM localidad l INNER JOIN departamento d ON l.id_dep = d.id_departamento; ";
    $resultado = $base_datos->conexion()->execute_query($query);
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);
    json_encode($matriz);
    var_dump($matriz); 
};
?>