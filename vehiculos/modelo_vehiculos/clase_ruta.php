<?php

class rutas
{
  // Propiedades

  public $id_ruta;

  public $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_id_ruta($id_ruta)
  {
    $this->id_ruta = $id_ruta;
  }
  function get_id_ruta()
  {
    return $this->id_ruta;
  }


  //funciones REST

  public function get_ruta($id_ruta)
  {
    $query = "SELECT 
    r.id_ruta, u.id_almacen, id_localidad, nombre_localidad, 
    id_departamento, nombre_departamento, a.chapa, a.calle
    FROM ruta r
    INNER JOIN  ubicacion u ON r.id_ruta = u.id_ruta
    INNER JOIN almacen a ON u.id_almacen = a.id_almacen
    INNER JOIN localidad l ON a.id_localidad_almacen = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    where  r.id_ruta = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_ruta);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_rutas_all()
  {
    $query = "SELECT 
    *
    FROM ruta ";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    $coleccion_rutas = array();
    $num_rutas = "0";

    foreach ($matriz as $fila) {

      $id = array($fila["id_ruta"]);
      

      $coleccion_rutas[$num_rutas] = $this->get_ruta($id);

      $num_rutas = $num_rutas+1;

    }

    return $coleccion_rutas;
  }

  public function delete_rutas($id_ruta)
  {
    //Se encuentra a todos las destinaciones cuales siguen la ruta
    $query_pqt_ruta = "SELECT * FROM destinado where id_ruta = ?";
    $resultado = $this->base_datos->conexion()->execute_query($query_pqt_ruta, $id_ruta);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    var_dump($matriz);

    //Cada destinacion es eliminada
    if (isset($matriz)) {
      foreach ($matriz as $fila) {
        $id_paquete = array($fila['id_ruta']);
        $insert = "DELETE FROM destinado
        where id_ruta= ? ";
        $this->base_datos->conexion()->execute_query($insert, $id_paquete);
      }
    }

    //Se encuentra a todos las ubicaciones de la ruta
    $query_pqt_ruta = "SELECT * FROM ubicacion where id_ruta = ?";
    $resultado = $this->base_datos->conexion()->execute_query($query_pqt_ruta, $id_ruta);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    var_dump($matriz);

    //Cada ubicacion es eliminada
    if (isset($matriz)) {
      foreach ($matriz as $fila) {
        $id_paquete = array($fila['id_ruta']);
        $insert = "DELETE FROM ubicacion
        where id_ruta= ? ";
        $this->base_datos->conexion()->execute_query($insert, $id_paquete);
      }
    }

    //El ruta es eliminado
    $query = "DELETE FROM ruta where id_ruta = ? ";
    $this->base_datos->conexion()->execute_query($query, $id_ruta);
  }


  public function update_ubicaciones($var_ubicacion)
  {

    $insert_ubicacion = "UPDATE ubicacion VALUES 
    posicion= ?, tiempo_trecho= ? 
    where = id_ruta= ? , id_almacen= ? ;";
    $this->base_datos->conexion()->execute_query($insert_ubicacion, $var_ubicacion);

  }

  public function put_rutas($var_ruta, $var_ubicacion)
  {

    $conexion = $this->base_datos->conexion();
    $insert_ruta = "INSERT INTO ruta VALUES ( ? );";
    $conexion->execute_query($insert_ruta, $var_ruta);
    $new_id = $conexion->insert_id;

var_dump($new_id);
  }

  public function put_ubicaciones($var_ubicacion)
  {

    $insert_ubicacion = "INSERT INTO ubicacion VALUES ( ?, ?, ?, ?);";
    $this->base_datos->conexion()->execute_query($insert_ubicacion, $var_ubicacion);

  }
}
