<?php

function obt_rutas()
{
    require "../../db/db_conn.php";
    $base_datos = new base_de_datos();

    $insert = "SELECT * FROM ruta ";
    $base_datos->conexion()->execute_query($insert);
}

function marcha($id)
{
    require "../../db/db_conn.php";
    $base_datos = new base_de_datos();

    $query = "SELECT estado from vehiculo where  matricula = ? ";
    $estado_actual = $base_datos->conexion()->execute_query($query, $id);
    $matriz = $estado_actual->fetch_all(MYSQLI_ASSOC);
    $estado_actual = $matriz[0];

    switch ($estado_actual["estado"]) {
        case '0':
            $insert = "UPDATE vehiculo SET estado= 1 where vehiculo.matricula= ? ";

            break;
        case '1':
            $insert = "UPDATE vehiculo SET estado= 0 where vehiculo.matricula= ? ";

            break;
    }

    $base_datos->conexion()->execute_query($insert, $id);

    return $estado_actual["estado"];
}
