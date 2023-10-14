<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_almacen/clase_almacen.php";

$almacen = new almacen();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');

		if (isset($valor)) {
			$id = $valor;
			$alm = $almacen->get_almacen($id);
			$encryptado = json_encode($alm);


			echo $encryptado;
			die;
		}else{
			$alm = $almacen->get_almacen_all();
			$encryptado = json_encode($alm);
			echo $encryptado;
			die;
		}


		break;

	case 'POST':
		echo "POST";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		$almacen->update_almacen($valor);

		break;

	case 'PUT':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		$almacen->put_almacen($valor);
		break;

	case 'DELETE':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);

		$almacen->delete_almacen($valor);
		break;
}
