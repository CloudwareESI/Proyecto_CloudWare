<?php

class base_de_datos
{


  public $sname = "localhost";

  public $unmae = "root";

  public $password = "";

  public $db_name = "cloudware";

  public function __construct()
  {
  }

  public function conexion()
  {
    //$conn = mysqli_connect('192.168.5.50','lucas.caballero','54798621','cloudware'); //conecta a la base de datos por medio de root
    $conn = mysqli_connect('localhost','root','','cloudware'); //conecta a la base de datos por medio de root


    if (!$conn) {
      echo "error de conexion";
    }

    return $conn;
  }
}
