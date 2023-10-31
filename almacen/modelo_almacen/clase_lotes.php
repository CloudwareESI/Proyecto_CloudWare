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
    g.id_lote, fecha_creacion, 
    fecha_de_entrega, fecha_transporte, 
    e.id_almacen, v.matricula, nombre_localidad, 
    id_departamento, nombre_departamento , e.id_ruta 
    FROM lote g 
    INNER JOIN destinado e ON g.id_lote = e.id_lote 
    INNER JOIN almacen a ON e.id_almacen = a.id_almacen
    INNER JOIN localidad l ON a.id_localidad_almacen = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    LEFT JOIN vehiculo v ON e.matricula = v.matricula
    where  g.id_lote = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_lote);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_lote_cam($matricula)
  {
    $query = "SELECT 
    g.id_lote, fecha_creacion, 
    fecha_de_entrega, fecha_transporte, 
    e.id_almacen, v.matricula, nombre_localidad, 
    id_departamento, nombre_departamento , e.id_ruta 
    FROM lote g 
    INNER JOIN destinado e ON g.id_lote = e.id_lote 
    INNER JOIN almacen a ON e.id_almacen = a.id_almacen
    INNER JOIN localidad l ON a.id_localidad_almacen = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    LEFT JOIN vehiculo v ON e.matricula = v.matricula
    where  e.matricula = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $matricula);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_lotes_all()
  {
    $query = "SELECT 
    g.id_lote, fecha_creacion, 
    fecha_de_entrega, fecha_transporte, 
    e.id_almacen, v.matricula, nombre_localidad, 
    id_departamento, nombre_departamento, e.id_ruta  
    FROM lote g 
    INNER JOIN destinado e ON g.id_lote = e.id_lote 
    INNER JOIN almacen a ON e.id_almacen = a.id_almacen
    INNER JOIN localidad l ON a.id_localidad_almacen = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento 
    LEFT JOIN vehiculo v ON e.matricula = v.matricula;  ";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function delete_lotes($id_lote)
  {
    //Se encuentra a todos los paquetes del lote
    $query_pqt_lote = "SELECT * FROM paquete where paquete.id_lote_portador = ?";
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

  public function update_lote($var_destino)
  {

    if (isset($var_destino)) {
      $insert = "UPDATE destinado SET  	
      matricula = ? ,
      fecha_de_entrega = ? ,
      fecha_transporte = ? 
      where id_lote = ? ";

      $this->base_datos->conexion()->execute_query($insert, $var_destino);
    }
  }

  public function put_lotes($var_lote, $var_destino)
  {

    $conexion = $this->base_datos->conexion();
    $insert_lote = "INSERT INTO lote VALUES ( NULL, NOW(), ? );";
    $conexion->execute_query($insert_lote, $var_lote);
    $new_id = $conexion->insert_id;

    $var_destino[2] = $new_id;

    $insert_destinacion = "INSERT INTO destinado VALUES ( ?, ?, ?, NULL, NULL, NULL );";
    $conexion->execute_query($insert_destinacion, $var_destino);

    return $new_id;
  }
}
