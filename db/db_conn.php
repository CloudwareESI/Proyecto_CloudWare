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
    $conn = mysqli_connect($this->sname, $this->unmae, $this->password, $this->db_name); //conecta a la base de datos por medio de root


    if (!$conn) {
      echo "error de conexion";
    }

    return $conn;
  }
}
