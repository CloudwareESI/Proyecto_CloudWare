<?php

class localidades
{
  // Propiedades

  public $id_localidad;

  public $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_id_localidad($id_localidad)
  {
    $this->id_localidad = $id_localidad;
  }
  function get_id_localidad()
  {
    return $this->id_localidad;
  }


  //funciones REST

  public function get_localidad($id_localidad)
  {
    $query = "SELECT 
    l.id_localidad, nombre_localidad, 
    id_departamento, nombre_departamento
    FROM localidad l
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    where  l.id_localidad = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_localidad);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_localidades_all()
  {
    $query = "SELECT 
    l.id_localidad, nombre_localidad, 
    id_departamento, nombre_departamento
    FROM localidad l
    INNER JOIN departamento d ON l.id_dep = d.id_departamento ";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }


  public function update_localidad($var_localidad)
  {

    $insert_localidad = "UPDATE localidad VALUES 
    nombre_localidad= ?, id_dep= ? 
    where = id_localidad= ?";
    $this->base_datos->conexion()->execute_query($insert_localidad, $var_localidad);

  }

  public function put_localidads($var_localidad)
  {

    $conexion = $this->base_datos->conexion();
    $insert_localidad = "INSERT INTO localidad VALUES ( NULL );";
    $conexion->execute_query($insert_localidad);
    $new_id = $conexion->insert_id;

    foreach ($var_localidad as $fila) {
      $fila[0] = $new_id;
      $this->put_localidades($fila);
    }

    return $new_id;
  }

  public function put_localidades($var_localidad)
  {

    $insert_localidad = "INSERT INTO localidad VALUES (NULL, ?, ?);";
    $this->base_datos->conexion()->execute_query($insert_localidad, $var_localidad);

  }
}
