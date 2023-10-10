<?php
include "../../db/funciones_utiles.php";
require_once "../modelo_usuario/clase_usuario.php";

$persona = new persona();

switch ($_SERVER['REQUEST_METHOD']) {

	case 'GET':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		header('content-type: application/json');

		if (isset($valor)) {
			$id = $valor;
			$usu = $persona->get_usuario($id);
			$encryptado = json_encode($usu);


			echo $encryptado;
			die;
		} else {
			$usu = $persona->get_usuario_all();
			$encryptado = json_encode($usu);
			echo $encryptado;
			die;
		}


		break;

	case 'POST':
		echo "POST";
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		$persona->update_usuario($valor[0], $valor[1]);

		break;

	case 'PUT':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);
		var_dump($valor);
		switch ($valor[0]) {
			case 'asignar_almacen':
				$persona->put_almacen($valor[1]);
				break;

			case 'asignar_vehiculo':
				$persona->put_conduce($valor[1]);
				break;

			case 'agregar':
				$persona->put_usuario($valor[1], $valor[2]);
				break;
		}


	case 'DELETE':
		$data = file_get_contents("php://input");
		$valor = json_decode($data, true);

		$persona->delete_usuario($valor);
		break;
}
