
<?php

$persona_edit = new mysqli("localhost", "root", "", "php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = $_POST['id'];

$update = "UPDATE personas SET 
nombre='" . $nombre . "
', apellido='" . $apellido . "
', email='" . $email . "
', password='" . $password . "
' Where personas.id='" . $id . "'";

$persona_edit->query($update);

header('Location:/ABMPersonas/index.php');
?>