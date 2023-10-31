<?php

class almacen
{
  // Propiedades

  public $id_almacen;
  public $id_direccion;
  private $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_direccion($id_direccion)
  {
    $this->id_direccion = $id_direccion;
  }
  function get_direccion()
  {
    return $this->id_direccion;
  }

  function set_id($id_almacen)
  {
    $this->id_almacen = $id_almacen;
  }
  function get_id()
  {
    return $this->id_almacen;
  }



  //funciones REST

  public function get_almacen($id_almacen)
  {
    $query = "SELECT 
    id_almacen, 
    calle, chapa, id_localidad_almacen, 
    nombre_localidad, id_dep, 
    nombre_departamento  
    FROM almacen a 
    INNER JOIN Localidad l ON a. id_localidad_almacen  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento
    where  id_almacen = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_almacen);
    $matriz = array();

    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_almacen_all()
  {
    $query = "SELECT 
    id_almacen, 
    calle, chapa, id_localidad_almacen, 
    nombre_localidad, id_dep, 
    nombre_departamento  
    FROM almacen a 
    INNER JOIN Localidad l ON a. id_localidad_almacen  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento; ";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();

    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function delete_almacen($id)
  {
    $id_u = json_decode($id);
    $query = "DELETE * from almacen where id_almacen = ? ";
    $this->base_datos->conexion()->execute_query($query, $id_u);
  }

  public function update_almacen($variables)
  {
    $insert = "UPDATE almacen SET calle= ? , chapa=?  id_localidad_almacen= ? where id_almacen = ? ";

    $this->base_datos->conexion()->execute_query($insert, $variables);
  }

  public function put_almacen($variables)
  {

    $insert = "INSERT INTO almacen VALUES ( NULL, ? , ?, NULL)";

    $this->base_datos->conexion()->execute_query($insert, $variables);
    var_dump($variables);

  }
}
