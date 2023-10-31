<?php
//Passwords
//Admin long65tyco@gmail.com Long65Rep
//Nata173AB
//
$usuario = "long65tyco@gmail.com";
$password = "Nata173AB";
$conn = mysqli_connect("localhost", "root", "", "bd_quickcarry"); //conecta a la base de datos por medio de root

$email_sql = "SELECT * FROM login WHERE email='$usuario'";

$result_email = mysqli_query($conn, $email_sql);
$login = mysqli_fetch_assoc($result_email);

var_dump($login);

echo "<br>". "password: ". $password .
"<br> Hash en bd: ". $login['password'] ."<br>".
"<br> Hash: ". password_hash($password, PASSWORD_DEFAULT) ."<br>";

var_dump( password_verify("SALVATION", $login['password']) );