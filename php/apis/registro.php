<?php
session_start();

include "../utils/db_conn.php";
include "../utils/funciones_utiles.php";

$nombre =  validate($_POST['nombre']);
$apellido =  validate($_POST['apellido']);
$email = validate($_POST['mail']);
$password =  validate($_POST['password']);

$sql = "SELECT * FROM personas WHERE email='$email' OR password='$password'"; //Se comprueba si alguien ya usa este el email o password
$comprovacion = mysqli_query($conn, $sql);

echo "</table>";
if (mysqli_num_rows($comprovacion) === 0) //si el comprobado es positivo se niega el registro
{
    $insert = "INSERT INTO personas VALUES ( NULL, '$nombre', '$apellido', '$password','$email','0')";
    $registro = mysqli_query($conn, $insert);


    $nueva = "SELECT * FROM personas WHERE email='$email'";
    $nuevacuenta = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($nuevacuenta);


    $_SESSION['email'] = $row['email'];
    $_SESSION['empleado'] = $row['empleado'];
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['id'] = $row['id'];
    
    echo "Registro exitoso";


    header("http://localhost/Proyecto_Cloudware/index.php");
}else{
    header("http://localhost/Proyecto_Cloudware/registro.html?Registro impossible email o contraseña ya en uso");

}


