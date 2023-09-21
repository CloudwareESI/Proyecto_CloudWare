<?php


function get_all_almacenes()
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_almacen.php", NULL);

    $valor = json_decode($L, true);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/vista_almacen/almacenes.php",);
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

function get_all_paquetes()
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_paquetes.php", NULL);

    $valor = json_decode($L, true);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/vista_almacen/mostrar_paquetes.php",);
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

function get_lotes_alm($id_alm)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_lotes.php", NULL);

    $valor = array($id_alm, json_decode($L, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/vista_almacen/mostrar_lotes.php",);
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

function get_paquetes_alm($id_alm)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_paquetes.php", $id_alm);

    $valor = array($id_alm, json_decode($L, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/vista_almacen/mostrar_paquetes.php",);
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

function get_paquete($id)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_paquetes.php", $id);

    $valor = json_decode($L, true);

    return $valor;
}

function del_paquete($id)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_paquetes.php", $id);
    return $L;
}
function del_lote($id)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_lotes.php", $id);
    return $L;
}

function get_almacen_almacenes($id_a)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_almacen.php", $id_a);

    $valor = json_decode($L, true);
    return $valor;
}

function del_almacen_almacen($id_a)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_almacen.php", $id_a);
    return $L;
}


function entrada_paquetes(){
    
    $P = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_paquetes.php", NULL);
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/controlador_almacen/REST_lotes.php", NULL);

    $valor = array(json_decode($P, true), json_decode($L, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware_v2/almacen/vista_almacen/entrada_paquetes.php",);
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