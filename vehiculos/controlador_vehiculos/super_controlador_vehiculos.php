<?php


function get_all_vehiculos($usuario, $cargo)
{


    if ($cargo == "0" or $cargo == "2") {
        if ($cargo == "0") {
            $camiones = llamadoDeAPI(
                "GET",
                "http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
                NULL
            );

            $valor = array(json_decode($camiones, true), $cargo);
        } else if ($cargo == "2") {

            $conduce = llamadoDeAPI(
                "GET",
                "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php",
                array($usuario)
            );


            foreach (json_decode($conduce, true) as $key => $fila) {


                $camiones[$key] = json_decode(llamadoDeAPI(
                    "GET",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
                    array($fila["id_matricula"])
                ), true)[0];
            }
            $valor = array($camiones, $cargo);
        }
    }



    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/views_vehiculos/mostrar_vehiculos.php",);
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
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        $id
    );

    $valor = json_decode($L, true);
    return $valor;
}

function get_vehiculos_lista()
{


    $L = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        NULL
    );


    $valor = json_decode($L, true);
    return $valor;
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

function obtener_carga($matricula, $tipo)
{
    $id = array("matricula" => $matricula);
    $valor = NULL;

    if ($tipo == "1") {
        $carga = llamadoDeAPI(
            "GET",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
            $id
        );
        if (isset(json_decode($carga, true)[0])) {

            $lote0 = json_decode($carga, true)[0];
            $ruta = json_decode(obt_ruta(array($lote0["id_ruta"])), true);
        } else {

            $ruta = json_decode(obt_ruta(array(0)), true);
        }



        foreach ($ruta as $k => $v) {
            $destinos[$k] = $v["calle"] . " " . $v["chapa"] . " " . $v["nombre_departamento"];
        }
    } else {

        $carga = llamadoDeAPI(
            "GET",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
            $id
        );

        foreach (json_decode($carga, true) as $k => $v) {
            $destinos[$k] = $v["destino_calle"] . " " . $v["nombre_departamento"];
        }
    }

    if (isset($destinos)) {
        $valor = array(json_decode($carga, true), $matricula, $tipo, $destinos);
    } else {
        $valor = array(json_decode($carga, true), $matricula, $tipo, NULL);
    }
    return $valor;
}

function obt_ruta($id_ruta)
{
    $ruta = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
        $id_ruta
    );

    return $ruta;
}

function marcha($matricula)
{


    $vehiculo = json_decode(
        llamadoDeAPI(
            "GET",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
            array($matricula)
        ),
        true
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
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        $vehiculo_cambios
    );
    return $vehiculo_cambios;
}
