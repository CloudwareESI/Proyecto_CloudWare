<?php


function get_all_vehiculos()
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php", NULL);

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
    $L = llamadoDeAPI(
        "GET",
        "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        $id
    );

    $valor = json_decode($L, true);
    return $valor;
}

function get_vehiculos_lista()
{
    $L = llamadoDeAPI(
        "GET",
        "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        NULL
    );

    $valor = json_decode($L, true);
    return $valor;
}

function del_vehiculos($id)
{
    $L = llamadoDeAPI(
        "DELETE",
        "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        $id
    );
    return $L;
}

function obtener_carga($matricula, $tipo)
{
    $id = array("matricula" => $matricula);
    $valor = NULL;

    if ($tipo == "1") {
        $carga = llamadoDeAPI(
            "GET",
            "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
            $id
        );
        return $carga;
        $valor = array(json_decode($carga), $matricula, $tipo);
    } else {
        $carga = llamadoDeAPI(
            "GET",
            "http://127.0.0.1//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $id
        );
        return $carga;
        $valor = array(json_decode($carga), $matricula, $tipo);
    }
    $ruta = llamadoDeAPI(
        "GET",
        "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
        NULL
    );
    $valor[3] = json_decode($ruta, true);

    return $valor;
}

function obt_ruta($id_ruta)
{
    $ruta = llamadoDeAPI(
        "GET",
        "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
        $id_ruta
    );

    return $ruta;
}

function marcha($matricula)
{


    $vehiculo = json_decode(
        llamadoDeAPI(
            "GET",
            "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
            array($matricula)
        ), true
    )["0"];

    var_dump($vehiculo);

    switch ($vehiculo['estado']) {
        case '0':
            $estado = '1';

            break;
        case '1':
            $estado = '0';

            break;
    }

    $vehiculo_cambios = array(
        $estado,
        $vehiculo['modelo'],
        $vehiculo['rol'],
        $matricula
    );

    llamadoDeAPI(
        "POST",
        "http://127.0.0.1//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        $vehiculo_cambios
    );
    return $vehiculo_cambios;
}