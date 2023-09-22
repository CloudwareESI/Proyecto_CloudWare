
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
        
        $L = llamadoDeAPI("PUT", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/controlador_vehiculos/REST_vehiculos.php", $vehiculos);

        break;


    case 'modificar':
        $matricula = $_POST['matricula'];
        $matricula_vieja = $_POST['matricula_vieja'];
        
        $estado = $_POST['estado'];
        
        $modelo = $_POST['modelo'];

        $rol = $_POST['rol'];

        $vehiculos = array($matricula, $estado, $modelo, $rol, $matricula_vieja);
        
        $L = llamadoDeAPI("POST", "http://127.0.0.1//Proyecto_Cloudware/vehiculos/controlador_vehiculos/REST_vehiculos.php", $vehiculos);

        echo "<br> Proyecto_CloudwareProyecto_Cloudware";
        break;


    default:
        # code...
        break;
}
//header("Location:http://localhost/Proyecto_Cloudware/Administracion.php");

?>