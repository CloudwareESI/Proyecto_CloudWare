<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_vehiculos/clase_vehiculos.php";

$vehiculos = new vehiculos();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');

		if (isset($valor)) {
			$id = $valor;
			$veh = $vehiculos->get_vehiculos($id);
			$encryptado = json_encode($veh);


			echo $encryptado;
			die;
		} else {
			$veh = $vehiculos->get_vehiculos_all();
			$encryptado = json_encode($veh);
			echo $encryptado;
			die;
		}

		break;

	case 'POST':
		echo "POST <br>";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		$vehiculos->update_vehiculos($valor);

		break;

	case 'PUT':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		$vehiculos->put_vehiculos($valor);
		break;

	case 'DELETE':

		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		
		$vehiculos->delete_vehiculos($valor);
		break;
}
