
<?php
var_dump($_POST);
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

        $password = $contraseniaHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $persona = array($email, $nombre, $apellido, $CI, $telefono, $cargo);
        $login = array($email, $password);
        $valor = array($op, $persona, $login);

        $L = llamadoDeAPI("PUT", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $valor);

        break;


    case 'modificar':
        $nombre = $_POST['nombre'];

        $apellido = $_POST['apellido'];

        $email = $_POST['email'];

        $email_viejo = $_POST['viejo'];

        $telefono = $_POST['telefono'];
        $CI = $_POST['CI'];
        $cargo = $_POST['cargo'];

        $password = $contraseniaHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $id = $_POST['id'];

        $persona = array($email, $nombre, $apellido, $CI, $telefono, $cargo, $id);
        $login = array($email, $password, $email_viejo);
        $valor = array($persona, $login);

        $L = llamadoDeAPI("POST", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $valor);
        echo "<br> Proyecto_CloudwareProyecto_Cloudware";
        break;

    case 'asignar_vehiculo':
        $id = $_POST['id_empleado'];
        $matricula = $_POST['matricula'];
        foreach ($id as $fila) {
            $asignar = array($matricula, $fila);
            $valor = array($op, $asignar);
            $L = llamadoDeAPI("PUT", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $valor);
        }

        break;

    case 'asignar_almacen':
        $id = $_POST['id_empleado'];
        $almacen = $_POST['almacen'];
        foreach ($id as $fila) {
            $asignar = array($almacen, $fila);
            $valor = array($op, $asignar);
            $L = llamadoDeAPI("PUT", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $valor);
        }

        break;

    case 'eliminar':
        $id = array($_POST['id']);
        var_dump($id);

        $L = llamadoDeAPI("DELETE", "http://" . $_SERVER["HTTP_HOST"] . "//Proyecto_Cloudware/usuarios/modelo_usuario/REST_usuario.php", $id);

        break;
}
header("Location:http://" . $_SERVER["HTTP_HOST"] . "/Proyecto_Cloudware/index.php?Usuarios");
?>