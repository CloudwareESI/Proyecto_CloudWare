<?php
include "../../db/db_conn.php";
include "../../db/funciones_utiles.php";

$conn = new base_de_datos();
$data = file_get_contents("php://input");
$valor = json_decode($data, true);

if (isset($valor["0"]) && isset($valor["1"])) {

    $usuario = validate($valor["0"]);

    $password = validate($valor["1"]);


    if (empty($usuario)) {

        header("Location:http://localhost/Proyecto_Cloudware/login.html?error=User Name is required");
        //en el caso que alguien entrara a esta pagina por otros medios sin email esto los devolvera a login

        exit();
    } else if (empty($password)) {

        header("Location:http://localhost/Proyecto_Cloudware/login.html?error=Password is required");
        //en el caso que alguien entrara a esta pagina por otros medios sin password esto los devolvera a login
        exit();
    } else {

        $sql = "SELECT * FROM login WHERE email='$usuario'";

        $result = mysqli_query($conn->conexion(), $sql);

        if (mysqli_num_rows($result) === 1) {

            $linea = mysqli_fetch_assoc($result);

            $email_sql = "SELECT * FROM login WHERE email='$usuario'";

            $result_email = mysqli_query($conn->conexion(), $email_sql);
            $login = mysqli_fetch_assoc($result_email);
            
            if ($linea['email'] === $usuario && password_verify($password, $login['password']) === true) {


                $usu_sql = "SELECT * FROM empleado WHERE email='$usuario'
                ";

                $result_usu = mysqli_query($conn->conexion(), $usu_sql);
                $linea_usu = mysqli_fetch_assoc($result_usu);


                header('content-type: application/json');

                $encryptado = json_encode($linea_usu);

                echo $encryptado;
                exit();
            } else {
                header('content-type: application/json');
                $error = json_encode("Usuario o contraseña incorrectos"); //si la password esta incorrecta nos devuelve al login
                echo $error;    
                exit();
            }
        } else {
            header('content-type: application/json');
            $error = json_encode("Usuario o contraseña incorrectos");
            echo $error;
            exit();
        }
    }
} else {
    header('content-type: application/json');
    $error = json_encode("Usuario o contraseña no insertados"); //si falta la password nos devuelve a login
    echo $error;    
    exit();
}
