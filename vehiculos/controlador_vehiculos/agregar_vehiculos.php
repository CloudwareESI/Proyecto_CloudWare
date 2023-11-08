
<?php
include "../../db/funciones_utiles.php";
$op = $_POST['op'];
switch ($op) {
    case 'agregar':
        $matricula = $_POST['matricula'];

        $estado = $_POST['estado'];

        $modelo = $_POST['modelo'];

        $rol = $_POST['rol'];

        $vehiculos = array($matricula, $estado, $modelo, $rol);

        $L = llamadoDeAPI(
            "PUT",
            "http://127.0.0.1//".$_SERVER["HTTP_HOST"]."/vehiculos/modelo_vehiculos/REST_vehiculos.php",
            $vehiculos
        );

        break;


    case 'modificar':
        $matricula_vieja = $_POST['matricula_vieja'];

        $estado = $_POST['estado'];

        $modelo = $_POST['modelo'];

        $rol = $_POST['rol'];

        $vehiculos = array($estado, $modelo, $rol, $matricula_vieja);

        $L = llamadoDeAPI(
            "POST",
            "http://127.0.0.1//".$_SERVER["HTTP_HOST"]."/vehiculos/modelo_vehiculos/REST_vehiculos.php",
            $vehiculos
        );
        break;

    case 'eliminar':
        $id = array($_POST["matricula"]);
        $L = llamadoDeAPI(
            "DELETE",
            "http://127.0.0.1//".$_SERVER["HTTP_HOST"]."/vehiculos/modelo_vehiculos/REST_vehiculos.php",
            $id
        );

        break;

    default:
        # code...
        break;
}
header("Location:http://".$_SERVER["HTTP_HOST"]."/Proyecto_Cloudware/index.php?Camiones");

?>