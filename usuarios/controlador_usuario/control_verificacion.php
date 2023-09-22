<?php
session_start();
$mail = $_POST['mail'];
$pass = $_POST['password'];
$login = array($mail, $pass);
echo session_id();


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,  "http://127.0.0.1//Proyecto_Cloudware/usuarios/modelo_usuario/verificador.php",);
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

if(isset($datos)){
    $variables = json_decode($datos, true);

    $_SESSION['id'] = $variables['id_usuario'];
    $_SESSION['cargo'] = $variables['cargo'];
    $_SESSION['nombre'] = $variables['nombre'];
    $_SESSION['apellido'] = $variables['apellido'];
    var_dump( $_SESSION );
    
    header("Location:http://localhost/Proyecto_Cloudware/index.php?Bienvenido=1");
}else{

    header("Location:http://localhost/Proyecto_Cloudware/login.html?error=".json_decode($datos));
}

