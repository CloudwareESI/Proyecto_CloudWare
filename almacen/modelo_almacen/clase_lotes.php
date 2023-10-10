<?php

class lotes
{
  // Propiedades

  public $id_lote;
  public $fecha_creacion;
  public $Matricula;
  public $id_almacen;
  private $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_id_lote($id_lote)
  {
    $this->id_lote = $id_lote;
  }
  function get_id_lote()
  {
    return $this->id_lote;
  }

  function set_fecha_creacion($fecha_creacion)
  {
    $this->fecha_creacion = $fecha_creacion;
  }
  function get_fecha_creacion()
  {
    return $this->fecha_creacion;
  }

  function set_Matricula($Matricula)
  {
    $this->Matricula = $Matricula;
  }
  function get_Matricula()
  {
    return $this->Matricula;
  }

  function set_id_almacen($id_almacen)
  {
    $this->id_almacen = $id_almacen;
  }
  function get_id_almacen()
  {
    return $this->id_almacen;
  }

  //funciones REST

  public function get_lote($id_lote)
  {
    $query = "SELECT 
    id_lote, fecha_creacion, 
    fecha_de_entrega, fecha_transporte, 
    id_almacen, matricula_camion, 
    id_destino, nombre_localidad, 
    id_departamento, nombre_departamento 
    FROM lote g 
    INNER JOIN Localidad l ON g.id_destino = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    LEFT JOIN vehiculo v ON g.matricula_camion = v.matricula
    where  id_lote = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_lote);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_lote_cam($matricula)
  {
    $query = "SELECT 
    id_lote, fecha_creacion, 
    fecha_de_entrega, fecha_transporte, 
    id_almacen, matricula_camion, 
    id_destino, nombre_localidad, 
    id_departamento, nombre_departamento 
    FROM lote g 
    INNER JOIN Localidad l ON g.id_destino = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    LEFT JOIN vehiculo v ON g.matricula_camion = v.matricula
    where  matricula_camion = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $matricula);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_lotes_all()
  {
    $query = "SELECT 
    id_lote, fecha_creacion, 
    fecha_de_entrega, fecha_transporte, 
    id_almacen, matricula_camion, 
    id_destino, nombre_localidad, 
    id_departamento, nombre_departamento 
    FROM lote g 
    INNER JOIN Localidad l ON g.id_destino = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    LEFT JOIN vehiculo v ON g.matricula_camion = v.matricula;  ";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function delete_lotes($id_lote)
  {
    //Se encuentra a todos los paquetes del lote
    $query_pqt_lote= "SELECT * FROM paquete where paquete.id_lote_portador = ?";
    $resultado = $this->base_datos->conexion()->execute_query($query_pqt_lote, $id_lote);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);
var_dump($matriz);
    //Cada paquete asignado a este lote es deasignado
    if (isset($matriz)) {
      foreach ($matriz as $fila) {
        $id_paquete = array($fila['id_paquete']);
        $insert = "UPDATE paquete SET 
        id_lote_portador= NULL
        where paquete.id_paquete= ? ";
        $this->base_datos->conexion()->execute_query($insert, $id_paquete);   
      }
    }

    
    //El lote es eliminado
    $query = "DELETE FROM lote where id_lote = ? ";
    $this->base_datos->conexion()->execute_query($query, $id_lote);
  }

  public function update_lote($variables)
  {
    $insert = "UPDATE lote SET  	
    fecha_creacion= ? ,	fecha_de_entrega= ? ,	
    fecha_transporte= ? ,	id_almacen= ? , 
    matricula_camion= ? , id_destino= ?
    where id_lote = ? ";

    $this->base_datos->conexion()->execute_query($insert, $variables);
  }

  public function put_lotes($variables)
  {
    if (empty($variables[0])) {
      if ($variables[0] = "0") {
        $conexion = $this->base_datos->conexion();
        $insert = "INSERT INTO lote VALUES ( NULL, CURDATE(), NULL , NULL, ? , NULL, ?);";

        $conexion->execute_query($insert, $variables);

        $new_id = $conexion->insert_id;

        return $new_id;
      } else {
        $variables = array($variables[1]);
        $conexion = $this->base_datos->conexion();
        $insert = "INSERT INTO lote VALUES ( NULL, CURDATE(), NULL , NULL, NULL , NULL, ?);";

        $conexion->execute_query($insert, $variables);

        $new_id = $conexion->insert_id;

        return $new_id;
      }
    } else {


      $conexion = $this->base_datos->conexion();
      $insert = "INSERT INTO lote VALUES ( NULL, CURDATE(), NULL , NULL, ? , NULL, ?);";

      $conexion->execute_query($insert, $variables);

      $new_id = $conexion->insert_id;

      return $new_id;
    }
  }
}
