<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_vehiculos/clase_ruta.php";

$rutas = new rutas();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');


		if (isset($valor)) {
			$ruta = $rutas->get_ruta($valor);

			$encryptado = json_encode($ruta);
			echo $encryptado;
			die;
		} else {
			$ruta = $rutas->get_rutas_all();

			$encryptado = json_encode($ruta);
			echo $encryptado;
			die;
		}
		break;

	case 'POST':
		echo "POST";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		$rutas->update_ubicaciones($valor["0"], $valor["1"]);
		break;

	case 'PUT':

		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');
		//debe recibir Variables del ruta en la pocicion 0 y variables de destino en la posicion 1
		$lot = $rutas->put_rutas($valor["0"], $valor["1"]);

		$encryptado = json_encode($lot);
		echo $encryptado;
		break;

	case 'DELETE':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		if (isset($valor["1"])) {

			echo "A";
			$rutas->delete_ubicacion($valor);
			break;
		}else{

			$rutas->delete_rutas($valor);
			break;
		}
}
