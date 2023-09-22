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

        $sql = "SELECT * FROM login WHERE email='$usuario' AND password='$password'";

        $result = mysqli_query($conn->conexion(), $sql);

        if (mysqli_num_rows($result) === 1) {

            $linea = mysqli_fetch_assoc($result);

            if ($linea['email'] === $usuario && $linea['password'] === $password) {


                $usu_sql = "SELECT * FROM empleado WHERE email='$usuario'";

                $result_usu = mysqli_query($conn->conexion(), $usu_sql);
                $linea_usu = mysqli_fetch_assoc($result_usu);


                header('content-type: application/json');

                $encryptado = json_encode($linea_usu);

                echo $encryptado;
                exit();
            } else {

                header("Location:http://localhost/Proyecto_Cloudware/login.html?error=Incorect User name or password"); //si la password esta incorrecta nos devuelve al login

                exit();
            }
        } else {
            header('content-type: application/json');
            json_encode("Incorect User name or password");
            echo $error;
            exit();
        }
    }
} else {

    header("Location:http://localhost/Proyecto_Cloudware/login.html"); //si falta la password nos devuelve a login

    exit();
}
