	<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_almacen/clase_paquetes.php";

$paquetes = new paquetes();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');

		if (isset($valor['id_paquete'])) {
			$id = array($valor['id_paquete']);
			$paq = $paquetes->get_paquete($id);
			$encryptado = json_encode($paq);
			echo $encryptado;
			die;
		} else if (isset($valor['id_lote'])) {
			$id = array($valor['id_lote']);
			$paq = $paquetes->get_paquetes_lot($id);
			$encryptado = json_encode($paq);
			echo $encryptado;
			die;
		} else if (isset($valor['id_alm'])) {
			$id = array($valor['id_alm']);
			$paq = $paquetes->get_paquetes_alm($id);
			$encryptado = json_encode($paq);
			echo $encryptado;
			die;
		} else if (isset($valor['matricula'])){
			$id = array($valor['matricula']);
			$paq = $paquetes->get_paquetes_cam($id);
			$encryptado = json_encode($paq);
			echo $encryptado;
			die;
		}else{
			$paq = $paquetes->get_paquetes_all();
			$encryptado = json_encode($paq);
			echo $encryptado;
			die;
		}

		break;

	case 'POST':
		echo "POST";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		$paquetes->update_paquetes($valor);

		break;

	case 'PUT':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		$paquetes->put_paquetes($valor);
		break;

	case 'DELETE':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);

		$paquetes->delete_paquetes($valor);
		break;
}
