<?php
require_once "../modelo_almacen/clase_lotes.php";
require_once "../../almacen/modelo_almacen/clase_lotes.php";

$lotes = new lotes();

$matricula = $_POST['matricula'];

foreach ($_POST["lotes"] as $fila) {
    $id_lote = array($fila);

    $valor = $lotes->get_lote($id_lote);
    $valor_extraido =  $valor[0];
    $lote = array(
        $valor_extraido["fecha_creacion"],
        $valor_extraido["fecha_de_entrega"],
        $valor_extraido["fecha_transporte"],
        $valor_extraido["id_almacen"],
        $matricula,
        $valor_extraido["id_destino"],
        $valor_extraido["id_lote"]
    );
$lotes->update_lote($lote);

}