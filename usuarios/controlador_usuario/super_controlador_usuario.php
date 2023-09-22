<?php


function get_all()
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/usuarios/controlador_usuario/REST_usuario.php", NULL);

    $valor = json_decode($L, true);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/usuarios/views_usuario/mostrar_usuarios.php",);
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

function get_persona($id)
{
    $L = llamadoDeAPI("GET", "http://127.0.0.1//Proyecto_Cloudware/usuarios/controlador_usuario/REST_usuario.php", $id);

    $valor = json_decode($L, true);
    return $valor;
}

function del_persona($id)
{
    $L = llamadoDeAPI("DELETE", "http://127.0.0.1//Proyecto_Cloudware/usuarios/controlador_usuario/REST_usuario.php", $id);
    return $L;
}
