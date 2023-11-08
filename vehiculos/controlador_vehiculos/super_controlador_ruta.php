<?php


function get_all_rutas()
{
    $rutas = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
        NULL
    );

    $valor = json_decode($rutas, true);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/views_vehiculos/mostrar_rutas.php",);
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

function get_ruta($id)
{
    $L = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_rutas.php",
        $id
    );

    $valor = json_decode($L, true);
    return $valor;
}

function get_rutas_lista()
{
    $L = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_rutas.php",
        NULL
    );

    $valor = json_decode($L, true);
    return $valor;
}

function get_locaciones_lista()
{
    $L = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_locaciones.php",
        NULL
    );

    return json_decode($L, true);;
}

function del_vehiculos($id)
{
    $L = llamadoDeAPI(
        "DELETE",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        $id
    );
    return $L;
}
