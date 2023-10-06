<?php


function get_all_vehiculos()
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/controlador_vehiculos/REST_vehiculos.php", NULL);

    $valor = json_decode($L, true);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/vehiculos/views_vehiculos/mostrar_vehiculos.php",);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = json_encode($valor);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json)
    ));
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        echo $response;
    }
    curl_close($curl);
}

function get_vehiculo($id)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/controlador_vehiculos/REST_vehiculos.php", $id);

    $valor = json_decode($L, true);
    return $valor;
}
function get_vehiculos_lista()
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/controlador_vehiculos/REST_vehiculos.php", NULL);

    $valor = json_decode($L, true);
    return $valor;
}

function del_vehiculos($id)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/controlador_vehiculos/REST_vehiculos.php", $id);
    return $L;
}

function obtener_carga($matricula , $tipo){
    $id = array("matricula" => $matricula);
    $valor = NULL;

    if ($tipo == "1"){
        $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_lotes.php", $id);
        return $L;
        $valor= array(json_decode($L), $matricula, $tipo);
    }else{
        $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/controlador_almacen/REST_paquetes.php", $id);
        return $L;
        $valor= array(json_decode($L), $matricula, $tipo);
    }
return $valor;
}