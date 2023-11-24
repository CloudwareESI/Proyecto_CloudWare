<?php


function get_all_almacenes($usuario, $cargo)
{

    if ($cargo == "0" or $cargo == "1") {
        if ($cargo == "0") {
            $almacenes = json_decode(llamadoDeAPI(
                "GET",
                "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
                NULL
            ), true);
        } else if ($cargo == "1") {

            $asignado = llamadoDeAPI(
                "GET",
                "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php",
                array($usuario)
            );


            foreach (json_decode($asignado, true) as $key => $fila) {
		

                $almacenes[$key] = json_decode(llamadoDeAPI(
                    "GET",
                    "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
                    array($fila["id_almacen"])
                ), true)[0];
            }
        }

        $localidades = json_decode(llamadoDeAPI(
            "GET",
            "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_localidad.php",
            NULL
        ), true);

        $valor = array($almacenes, $cargo, $localidades);
    }

    $curl = curl_init();
    curl_setopt(
        $curl,
        CURLOPT_URL,
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/vista_almacen/almacenes.php",
    );
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

function get_almacenes_lista()
{
    $almacenes = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
        NULL
    );

    return json_decode($almacenes, true);
}

function get_all_paquetes()
{
    $paquetes = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
        NULL
    );
    $vehiculos = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        NULL
    );

    $valor = array(json_decode($paquetes, true,), json_decode($vehiculos, true));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/vista_almacen/mostrar_paquetes.php",);
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

    $lotes = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
        NULL
    );
    $vehiculos = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        NULL
    );

    $lotes_almacen = array();

    $numero_lotes = "0";


    foreach (json_decode($lotes, true) as $fila) {

        if (
            $fila["id_almacen"] == $id_alm
            and isset($fila["fecha_de_entrega"] )  
        ) {
            $lotes_almacen[$numero_lotes] = $fila;
        }

        if ($id_alm == "1") {
            if (
                $fila["id_almacen"] != $id_alm
                and !isset($fila["fecha_de_entrega"]) and !isset($fila["matricula"]) 
            ) {
                $lotes_almacen[$numero_lotes] = $fila;
            }
        }
        $numero_lotes = $numero_lotes + "1";
    }

    $valor = array($id_alm, $lotes_almacen, json_decode($vehiculos, true));


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/vista_almacen/mostrar_lotes.php",);
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
    $paquetes = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
        NULL
    );
    $rutas = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_ruta.php",
        NULL
    );
    $vehiculos = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        NULL
    );
    $localidades = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_localidad.php",
        NULL
    );

    $paquetes_almacen = array();

    $numero_paquetes = "0";


    //selecciona los paquetes que son del almacen
    foreach (json_decode($paquetes, true) as $fila) {

        if (
            $fila["id_almacen"] == $id_alm
            and isset($fila["fecha_de_entrega"])
            and !isset($fila["fecha_entrega"])
            and !isset($fila["fecha_entrega"])
            and !isset($fila["matricula_transporte"])
        ) {
            $paquetes_almacen[$numero_paquetes] = $fila;
        }

        if ($id_alm == "1") {
            if (
                $fila["id_almacen"] != $id_alm
                and isset($fila["id_lote"])
                and !isset($fila["fecha_de_entrega"])
                and !isset($fila["fecha_entrega"])
                and !isset($fila["matricula_transporte"])
            ) {
                $paquetes_almacen[$numero_paquetes] = $fila;
            }else if(
                !isset($fila["id_lote"]) 
                and !isset($fila["fecha_de_entrega"])
                and !isset($fila["fecha_entrega"])
                and !isset($fila["matricula_transporte"])
                and isset($fila["fecha_recibido"])
            ) {
                $paquetes_almacen[$numero_paquetes] = $fila;
            }
        }
        $numero_paquetes = $numero_paquetes + "1";
    }

    $valor = array(
        $id_alm,
        $paquetes_almacen,
        json_decode($vehiculos, true),
        json_decode($rutas, true),
        json_decode($localidades, true)
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/vista_almacen/mostrar_paquetes.php",);
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
    $paquetes = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
        $identificador
    );

    $valor = json_decode($paquetes, true);

    return $valor;
}

function del_paquete($id)
{
    $L = llamadoDeAPI(
        "DELETE",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
        $id
    );
    return $L;
}
function del_lote($id)
{
    $L = llamadoDeAPI(
        "DELETE",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
        $id
    );
    return $L;
}

function get_almacen_almacenes($id_a)
{
    $L = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
        $id_a
    );

    $valor = json_decode($L, true);
    return $valor;
}



function del_almacen_almacen($id_a)
{
    $L = llamadoDeAPI(
        "DELETE",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_almacen.php",
        $id_a
    );
    return $L;
}


function entrada_paquetes($rol)
{

    $paquetes_todos = json_decode(llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_paquetes.php",
        NULL
    ), true);
    $x = 0;

    $paquetes = array();
    foreach ($paquetes_todos as $value) {
        if (!isset($value["id_lote_portador"])) {
            if (!isset($value["fecha_recibido"])) {
                echo "<br>";
                $paquetes[$x] = $value;
                $x++;
            }
        }
    }


    $lotes_todos = json_decode(llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/modelo_almacen/REST_lotes.php",
        NULL
    ), true);

    $x = 0;
    $lotes = array();
    foreach ($lotes_todos as $value) {
        if (!isset($value["fecha_transporte"])) {
            if (!isset($value["fecha_de_entrega"])) {
                if ($value["id_almacen"] == "1") {
                    echo "<br>";
                    $lotes[$x] = $value;
                    $x++;
                }
            }
        }
    }

    $vehiculos = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_vehiculos.php",
        NULL
    );
    $localidades = llamadoDeAPI(
        "GET",
        "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/vehiculos/modelo_vehiculos/REST_localidad.php",
        NULL
    );

    $valor = array(
        $paquetes,
        $lotes,
        json_decode($vehiculos, true),
        $rol,
        json_decode($localidades, true)

    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/almacen/vista_almacen/entrada_paquetes.php",);
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
