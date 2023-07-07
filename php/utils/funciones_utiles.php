<?php
function httpRequest($url, $op, $id)
{
    $data = array( //lo que mandaremos por http Request
        'id' => $id,
        'opcion' => $op
    );

    $ch = curl_init();
    $options = array( //opciones para el cURL
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => 1
    );

    curl_setopt_array($ch, $options);

    $result = curl_exec($ch);

    curl_close($ch); //se cierra el cURL

    return $result;
};

function validate($data)
{

    $data = trim($data); //elimina espacios vacios

    $data = stripslashes($data); //elimina barras de comentario para evitar problemas

    $data = htmlspecialchars($data); //evita que caracteres especiales causen problemas

    return $data;
}


?>