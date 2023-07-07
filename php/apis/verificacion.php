<?php

session_start();

include "../utils/db_conn.php";
include "../utils/funciones_utiles.php";

if (isset($_POST['mail']) && isset($_POST['password'])) {

    $usuario = validate($_POST['mail']);

    $password = validate($_POST['password']);

    if (empty($usuario)) {

        header("Location:http://localhost/Proyecto_CloudWare/login.html?error=User Name is required");
        //en el caso que alguien entrara a esta pagina por otros medios sin email esto los devolvera a login

        exit();
    } else if (empty($password)) {

        header("Location:http://localhost/Proyecto_CloudWare/login.html?error=Password is required");
        //en el caso que alguien entrara a esta pagina por otros medios sin password esto los devolvera a login
        exit();
    } else {

        $sql = "SELECT * FROM personas WHERE email='$usuario' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $usuario && $row['password'] === $password) {

                echo "Logged in!";


                $_SESSION['email'] = $row['email'];
                $_SESSION['empleado'] = $row['empleado'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['id'] = $row['id'];
                    header("Location:http://localhost/Proyecto_Cloudware/index.php"); //Aqui es donde terminamos si todo esta bien escrito


                exit();
            } else {

                header("Location:http://localhost/Proyecto_CloudWare/login.html?error=Incorect User name or password"); //si la password esta incorrecta nos devuelve al login

                exit();
            }
        } else {

            header("Location:http://localhost/Proyecto_CloudWare/login.html?error=Incorect User name or password"); //si la password esta incorrecta nos devuelve al login

            exit();
        }
    }
} else {

    header("Location:http://localhost/Proyecto_CloudWare/login.html"); //si falta la password nos devuelve a login

    exit();
}
