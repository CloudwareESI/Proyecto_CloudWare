<?php

$sname = "localhost";

$unmae = "root";

$password = "";

$db_name = "php";

$conn = mysqli_connect($sname, $unmae, $password, $db_name); //conecta a la base de datos por medio de root

if (!$conn) {

    echo "Connection failed!";
}
