<?php

class persona
{
  // Propiedades

  public $nombre;
  public $apellido;
  public $email;
  public $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_nombre($nombre)
  {
    $this->nombre = $nombre;
  }
  function get_nombre()
  {
    return $this->nombre;
  }

  function set_apellido($apellido)
  {
    $this->apellido = $apellido;
  }
  function get_apellido()
  {
    return $this->apellido;
  }

  function set_email($email)
  {
    $this->email = $email;
  }
  function get_email()
  {
    return $this->email;
  }



  //funciones REST

  public function get_usuario($id)
  {



    $query = "select * from empleado where  empleado.id_empleado = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    switch ($matriz[0]["cargo"]) {
      case '2':
        $query = "SELECT 
        e.id_empleado, 	email, 	
        nombre, 	apellido, 	CI, 	
        nro_telefono, 	cargo, 	id_matricula
           from empleado e 
         INNER JOIN conduce c on e.id_empleado = c.id_empleado 
         where  e.id_empleado = ? ";
        $resultado = $this->base_datos->conexion()->execute_query($query, $id);
        $empleado = array();
        $empleado = $resultado->fetch_all(MYSQLI_ASSOC);
        break;

      case '1':
        $query = "SELECT         
        e.id_empleado, 	email, 	
        nombre, 	apellido, 	CI, 	
        nro_telefono, 	cargo, 	id_almacen
        from empleado e 
        INNER JOIN asignado a on e.id_empleado = a.id_empleado 
        where  e.id_empleado = ? ";
        $resultado = $this->base_datos->conexion()->execute_query($query, $id);
        $empleado = array();
        $empleado = $resultado->fetch_all(MYSQLI_ASSOC);
        break;
      default:
        $query = "SELECT         
        id_empleado, 	email, 	
        nombre, 	apellido, 	CI, 	
        nro_telefono, 	cargo
        from empleado
        where  e.id_empleado = ? ";
        $resultado = $this->base_datos->conexion()->execute_query($query, $id);
        $empleado = array();
        $empleado = $resultado->fetch_all(MYSQLI_ASSOC);
        break;
    }
    return $empleado;
  }

  public function get_usuario_all()
  {
    $query = "select * from empleado";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function delete_usuario($id)
  {
    $query = "DELETE FROM asignado WHERE asignado.id_empleado= ?";
    $this->base_datos->conexion()->execute_query($query, $id);
    $query = "DELETE FROM conduce WHERE conduce.id_empleado= ?";
    $this->base_datos->conexion()->execute_query($query, $id);
    $query = "DELETE FROM empleado WHERE empleado.id_empleado= ?";
    $this->base_datos->conexion()->execute_query($query, $id);
  }

  public function update_usuario($variables, $variables_login)
  {
    echo "<br>";
    var_dump($variables);
    echo "<br>";
    $insert = "UPDATE empleado SET email= ? , nombre= ? , 
    apellido= ?, CI= ?, nro_telefono= ?, cargo= ?  where empleado.id_empleado= ? ";

    $this->base_datos->conexion()->execute_query($insert, $variables);

    $insert_login = "UPDATE login SET email= ? , password= ? where login.email= ? ";
    $this->base_datos->conexion()->execute_query($insert_login, $variables_login);
  }

  public function put_usuario($variables, $variables_login)
  {
    //email nombre apellido CI nro_telefono cargo
    $insert = "INSERT INTO empleado VALUES (NULL, ?, ? , ? , ? , ? , ?)";
    $this->base_datos->conexion()->execute_query($insert, $variables);

    $insert_login = "INSERT INTO login VALUES ( ? , ?)";
    $this->base_datos->conexion()->execute_query($insert_login, $variables_login);
  }

  public function put_almacen($variables)
  {

    //email nombre apellido CI nro_telefono cargo
    $insert = "INSERT INTO asignado VALUES (?, ?)";
    $this->base_datos->conexion()->execute_query($insert, $variables);
  }

  public function put_conduce($variables)
  {

    //email nombre apellido CI nro_telefono cargo
    $insert = "INSERT INTO conduce VALUES (?, ?)";
    $this->base_datos->conexion()->execute_query($insert, $variables);
  }
}
