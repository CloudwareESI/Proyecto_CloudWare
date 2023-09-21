
<?php
include "../../db/funciones_utiles.php";
$op = $_POST['op'];
switch ($op) {
    case 'agregar':
        $nombre = $_POST['nombre'];

        $apellido = $_POST['apellido'];

        $email = $_POST['email'];

        $CI = $_POST['CI'];

        $telefono = $_POST['telefono'];

        $cargo = $_POST['cargo'];

        $password = $_POST['password'];

        $persona = array($email, $nombre, $apellido, $CI, $telefono, $cargo);
        $login = array($email, $password);
        $valor = array($op, $persona, $login);

        $L = llamadoDeAPI("PUT", "http://127.0.0.1//Proyecto_Cloudware_v2/usuarios/controlador_usuario/REST_usuario.php", $valor);

        break;


    case 'modificar':
        $nombre = $_POST['nombre'];

        $apellido = $_POST['apellido'];

        $email = $_POST['email'];

        $email_viejo = $_POST['viejo'];

        $telefono = $_POST['telefono'];
        $CI = $_POST['CI'];
        $cargo = $_POST['cargo'];

        $password = $_POST['password'];

        $id = $_POST['id'];

        $persona = array($email, $nombre, $apellido, $CI, $telefono, $cargo, $id);
        $login = array($email, $password, $email_viejo);
        $valor = array($persona, $login);

        $L = llamadoDeAPI("POST", "http://127.0.0.1//Proyecto_Cloudware_v2/usuarios/controlador_usuario/REST_usuario.php", $valor);
        echo "<br> Proyecto_Cloudware_v2Proyecto_Cloudware_v2";
        break;

    case 'asignar_vehiculo':
        $id = $_POST['id_empleado'];
        $matricula = $_POST['matricula'];
        foreach ($id as $fila) {
            $asignar = array($matricula, $fila);
            $valor = array($op, $asignar);
            $L = llamadoDeAPI("PUT", "http://127.0.0.1//Proyecto_Cloudware_v2/usuarios/controlador_usuario/REST_usuario.php", $valor);    
        }

        break;
}
header("Location:http://localhost/Proyecto_Cloudware_v2/index.php");
?>