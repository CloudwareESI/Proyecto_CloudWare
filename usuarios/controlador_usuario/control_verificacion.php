<?php
session_start();
$mail = $_POST['mail'];
$pass = $_POST['password'];
$login = array($mail, $pass);


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,  "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/verificador.php",);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = json_encode($login);

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
    //$datos =
    $datos = $response;
}
curl_close($curl);

$variables = json_decode($datos, true);
if (isset($variables['id_empleado'])) {


    $_SESSION['id'] = $variables['id_empleado'];
    $_SESSION['cargo'] = $variables['cargo'];
    $_SESSION['nombre'] = $variables['nombre'];
    $_SESSION['apellido'] = $variables['apellido'];
    var_dump($_SESSION);

    header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/index.php?Bienvenido=1");
} else {
    
    header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/usuarios/views_usuario/login.php?error=".$variables);
}
