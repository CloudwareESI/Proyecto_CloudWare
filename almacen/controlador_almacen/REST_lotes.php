<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_almacen/clase_lotes.php";

$lotes = new lotes();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');

		
		if (isset($valor['matricula'])){
			$id = array($valor['matricula']);
			$lot = $lotes->get_lote_cam($id);
			$encryptado = json_encode($lot);
			echo $encryptado;
			die;
		}else if (isset($valor)) {
			$id = $valor;
			$lot = $lotes->get_lote($id);
			$encryptado = json_encode($lot);


			echo $encryptado;
			die;
		}else{ 
			$lot = $lotes->get_lotes_all();
			$encryptado = json_encode($lot);

			echo $encryptado;
			die;
		}


		break;

	case 'POST':
		echo "POST";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		$lotes->update_lote($valor);

		break;

	case 'PUT':
		
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');
		$lot = $lotes->put_lotes($valor);

		$encryptado = json_encode($lot);
		echo $encryptado;
		break;

	case 'DELETE':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);

		$lotes->delete_lotes($valor);
		break;
}
