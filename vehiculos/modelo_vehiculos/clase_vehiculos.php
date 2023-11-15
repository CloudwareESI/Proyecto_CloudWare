<?php

class vehiculos
{
  // Propiedades

  public $matricula;
  public $estado;
  public $modelo;
  public $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_matricula($matricula)
  {
    $this->matricula = $matricula;
  }
  function get_matricula()
  {
    return $this->matricula;
  }

  function set_estado($estado)
  {
    $this->estado = $estado;
  }
  function get_estado()
  {
    return $this->estado;
  }

  function set_modelo($modelo)
  {
    $this->modelo = $modelo;
  }
  function get_modelo()
  {
    return $this->modelo;
  }



  //funciones REST

  public function get_vehiculos($id)
  {
    $query = "select * from vehiculo where  matricula = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    if ($matriz[0]["rol"] == 1) {
      $query = "SELECT v.matricula, 
      v.estado , 
      v.modelo, 
      v.rol, 
      v.peso_maximo, 
      SUM(p.peso)/1000 AS carga_actual
      FROM `vehiculo` v 
      LEFT JOIN destinado l ON v.matricula = l.matricula 
      LEFT JOIN paquete p ON l.id_lote = p.id_lote_portador
      WHERE p.fecha_entrega IS NULL 
      AND l.fecha_de_entrega IS NULL
      AND v.matricula = ?
      GROUP BY v.matricula";

    } else if($matriz[0]["rol"] == 2){
      $query = "SELECT v.matricula, 
      v.estado , 
      v.modelo, 
      v.rol, 
      v.peso_maximo, 
      SUM(p.peso)/1000 AS carga_actual
      FROM `vehiculo` v
      LEFT JOIN paquete p ON v.matricula = p.matricula_transporte
      WHERE p.fecha_entrega IS NULL
      AND v.matricula = ?
      GROUP BY v.matricula";

    }else{
      $query = "select * from vehiculo where  matricula = ? ";
    }

    $resultado = $this->base_datos->conexion()->execute_query($query, $id);
    $vehiculo = array();
    $vehiculo = $resultado->fetch_all(MYSQLI_ASSOC);
    if (!isset($vehiculo[0])){
      $query = "select * from vehiculo where  matricula = ? ";
      $resultado = $this->base_datos->conexion()->execute_query($query, $id);
      $vehiculo = array();
      $vehiculo = $resultado->fetch_all(MYSQLI_ASSOC);
    }
    return $vehiculo;
  }

  public function get_vehiculos_all()
  {
    $query = "select * from vehiculo";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function delete_vehiculos($id)
  {
    var_dump($id);
    $query = "DELETE FROM vehiculo WHERE vehiculo.matricula= ?";
    $this->base_datos->conexion()->execute_query($query, $id);
  }

  public function update_vehiculos($variables)
  {
    echo "<br>";
    var_dump($variables);
    echo "<br>";
    $insert = "UPDATE vehiculo SET estado= ? , modelo= ?, rol= ?, peso_maximo = ? where vehiculo.matricula= ? ";

    $this->base_datos->conexion()->execute_query($insert, $variables);
  }

  public function put_vehiculos($variables)
  {

    //matricula estado modelo id_almacen
    $insert = "INSERT INTO vehiculo VALUES (?, ? , ? , ?, ?)";
    $this->base_datos->conexion()->execute_query($insert, $variables);
  }
}
