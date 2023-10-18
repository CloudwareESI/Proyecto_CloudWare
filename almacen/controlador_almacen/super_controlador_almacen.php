<?php


function get_all_almacenes()
{
    $almacenes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php", NULL);

    $valor = json_decode($almacenes, true);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/almacen/vista_almacen/almacenes.php",);
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
    $paquetes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", NULL);
    $vehiculos = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php", NULL);

    $valor = array(json_decode($paquetes, true,), json_decode($vehiculos, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/almacen/vista_almacen/mostrar_paquetes.php",);
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

    $lotes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php", NULL);
    $vehiculos = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php", NULL);

    $valor = array($id_alm, json_decode($lotes, true), json_decode($vehiculos, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/almacen/vista_almacen/mostrar_lotes.php",);
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
    
    $identificador = array('id_alm' => $id_alm);

    $paquetes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", $identificador);



    $valor = array($id_alm, json_decode($paquetes, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/almacen/vista_almacen/mostrar_paquetes.php",);
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

function get_paquete($id_paquete)
{
    $identificador = array('id_paquete' => $id_paquete);
    $paquetes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", $identificador);

    $valor = json_decode($paquetes, true);

    return $valor;
}

function del_paquete($id)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", $id);
    return $L;
}
function del_lote($id)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php", $id);
    return $L;
}

function get_almacen_almacenes($id_a)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php", $id_a);

    $valor = json_decode($L, true);
    return $valor;
}

function del_almacen_almacen($id_a)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php", $id_a);
    return $L;
}


function entrada_paquetes($rol){
    
    $paquetes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php", NULL);
    $lotes = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php", NULL);
    
    $vehiculos = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php", NULL);

    $valor = array(json_decode($paquetes, true), json_decode($lotes, true), json_decode($vehiculos, true), $rol);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/almacen/vista_almacen/entrada_paquetes.php",);
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