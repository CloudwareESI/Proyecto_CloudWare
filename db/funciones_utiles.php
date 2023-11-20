<?php
function llamadoDeAPI($method, $url, $data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  $url,);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = json_encode($data);
    switch ($method) {
        case "GET":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            ));

            break;

        case "POST":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            ));

            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            ));

            break;

        case "DELETE":
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            ));

            break;
    }

    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        //Solo habilitar la linea de abajo para debug
        echo "<br>" . $response . "<br>";
        return $response;
    }
    curl_close($curl);
};

function validate($data)
{

    $data = trim($data); //elimina espacios vacios

    $data = stripslashes($data); //elimina barras de comentario para evitar problemas

    $data = htmlspecialchars($data); //evita que caracteres especiales causen problemas

    return $data;
}

function get_localidades_lista()
{
    $L = llamadoDeAPI("GET", "http://".$_SERVER["HTTP_HOST"]."//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_localidad.php", NULL);

    $valor = json_decode($L, true);
    return $valor;
}