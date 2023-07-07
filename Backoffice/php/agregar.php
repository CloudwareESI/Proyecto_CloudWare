
<?php
$bd = new mysqli("localhost", "root", "", "php");

$nombre = $_POST['nombre'];

$apellido = $_POST['apellido'];

$email = $_POST['email'];

$password = $_POST['password'];

$insert = "INSERT INTO personas VALUES ( NULL, '$nombre', '$apellido', '$password','$email','1')";

$bd->query($insert);

header('Location:/ABMPersonas/index.php');
?>