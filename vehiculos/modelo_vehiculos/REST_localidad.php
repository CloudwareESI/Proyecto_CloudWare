<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_vehiculos/clase_localidad.php";

$localidades = new localidades();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');
		

		if(isset($valor)){
			$localidad = $localidades->get_localidad($valor);

			$encryptado = json_encode($localidad);
			echo $encryptado;
			die;
		}else{
			$localidad = $localidades->get_localidades_all();

			$encryptado = json_encode($localidad);
			echo $encryptado;
			die;
		}
		break;
		
	case 'POST':
		echo "POST";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		$localidades->update_localidad($valor);
		break;

	case 'PUT':
		
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');
		//debe recibir Variables del localidad en la pocicion 0 y variables de destino en la posicion 1
		$lot = $localidades->put_localidades($valor["0"]);

		$encryptado = json_encode($lot);
		echo $encryptado;
		break;

	case 'DELETE':
        //borrar localidades no es apoyado
		break;
}
