<?php


function get_all()
{
    $empleados = llamadoDeAPI("GET", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", NULL);
    $vehiculos = llamadoDeAPI("GET", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php", NULL);
    $almacenes = llamadoDeAPI("GET", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php", NULL);

    $valor = array(json_decode($empleados, true,), json_decode($vehiculos, true), json_decode($almacenes, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/views_usuario/mostrar_usuarios.php",);
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
    $L = llamadoDeAPI("GET", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $id);

    $valor = json_decode($L, true);
    return $valor;
}

function del_persona($id)
{
    $L = llamadoDeAPI("DELETE", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $id);
    return $L;
}
