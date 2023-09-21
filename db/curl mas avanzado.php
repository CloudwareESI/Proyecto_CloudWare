<?php

function llamadoDeAPI($method, $url, $data) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  $url,);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    switch ($method) {
        case "GET":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            echo "<br> metodo seleccionado: GET <br>";
            break;

        case "POST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            echo "<br> metodo seleccionado: POST <br>";
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            echo "<br> metodo seleccionado: PUT <br>";
            break;
            
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            echo "<br> metodo seleccionado: DELETE <br>";
            break;
    }

    $response = curl_exec($curl);
    $data = json_decode($response);

    /* Chequeamos por el error 404 (file not found). */
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // Analizamos el codigo devuelto
    switch ($httpCode) {
        case 200:
            $error_status = $httpCode . " : Resultado correcto";
            return ($data);
            break;
        case 404:
            $error_status = $httpCode . " : API no encontrada";
            break;
        case 500:
            $error_status = $httpCode . " : El server respondio con un error";
            break;
        case 502:
            $error_status = $httpCode . " : Los servers estan caidos";
            break;
        case 503:
            $error_status = $httpCode . " : Servicio no disponible";
            break;
        default:
            $error_status = "Undocumented error: " . $httpCode . " : " . curl_error($curl);
            break;
    }
    curl_close($curl);
    echo $error_status;
    die;
}