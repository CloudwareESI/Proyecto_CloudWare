<?php
require_once "../../almacen/modelo_almacen/clase_lotes.php";

$lotes = new lotes();

foreach ($_POST["lotes"] as $fila) {
    $id_lote = array($fila);

    $valor = $lotes->get_lote($id_lote);
    $valor_extraido =  $valor[0];
    $lote = array(
        $valor_extraido["fecha_creacion"],
        date("Y-m-d"),
        $valor_extraido["fecha_transporte"],
        $valor_extraido["id_destino"],
        NULL,
        $valor_extraido["id_destino"],
        $valor_extraido["id_lote"]
    );
$lotes->update_lote($lote);

}