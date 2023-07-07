<?php
$bd = new mysqli("localhost", "root", "", "php");

$id = $_GET['id'];

$delete = "DELETE FROM personas WHERE personas.id='" . $id . "'";

$bd->query($delete); //querry da ordenes a la BD

header('Location:/ABMPersonas/index.php'); //HEADER CAMBIA LA PAGINA
?>