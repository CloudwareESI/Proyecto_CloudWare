<?php

class paquetes
{
  // Propiedades

  public $nombre_paquete;
  public $dimensiones;
  public $peso;
  public $fragil;
  public $id_paquete;
  public $fecha_recibido;
  public $fecha_entrega;
  public $id_lote;
  public $id_almacen;
  public $id_cruece;
  public $base_datos;

  public function __construct()
  {
    include "../../db/db_conn.php";

    $this->base_datos = new base_de_datos();
  }

  // Setters y getters 
  function set_nombre_paquete($nombre_paquete)
  {
    $this->nombre_paquete = $nombre_paquete;
  }
  function get_nombre_paquete()
  {
    return $this->nombre_paquete;
  }

  function set_dimensiones($dimensiones)
  {
    $this->dimensiones = $dimensiones;
  }
  function get_dimensiones()
  {
    return $this->dimensiones;
  }

  function set_peso($peso)
  {
    $this->peso = $peso;
  }
  function get_peso()
  {
    return $this->peso;
  }
  function set_fragil($fragil)
  {
    $this->fragil = $fragil;
  }
  function get_fragil()
  {
    return $this->fragil;
  }
  function set_id_paquete($id_paquete)
  {
    $this->id_paquete = $id_paquete;
  }
  function get_id_paquete()
  {
    return $this->id_paquete;
  }
  function set_fecha_recibido($fecha_recibido)
  {
    $this->fecha_recibido = $fecha_recibido;
  }
  function get_fecha_recibido()
  {
    return $this->fecha_recibido;
  }
  function set_fecha_entrega($fecha_entrega)
  {
    $this->fecha_entrega = $fecha_entrega;
  }
  function get_fecha_entrega()
  {
    return $this->fecha_entrega;
  }
  function set_id_lote($id_lote)
  {
    $this->id_lote = $id_lote;
  }
  function get_id_lote()
  {
    return $this->id_lote;
  }
  function set_id_almacen($id_almacen)
  {
    $this->id_almacen = $id_almacen;
  }
  function get_id_almacen()
  {
    return $this->id_almacen;
  }
  function set_id_cruece($id_cruece)
  {
    $this->id_cruece = $id_cruece;
  }
  function get_id_cruece()
  {
    return $this->id_cruece;
  }




  //funciones REST

  public function get_paquete($id)
  {
    $query = "SELECT 
    nombre_paquete, peso, 
    dimenciones, fragil, 
    id_paquete, 
    fecha_recibido, fecha_entrega, 
    fecha_cargado, fecha_ingreso,
    id_lote_portador, destino_calle, 
    id_localidad_destino , 
    nombre_localidad, id_departamento , nombre_departamento , id_almacen
    FROM paquete p 
    INNER JOIN Localidad l ON p.id_localidad_destino  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento
	  LEFT JOIN lote g ON p.id_lote_portador = g.id_lote
    WHERE  id_paquete = ? ";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_paquetes_all()
  {
    $query = "SELECT 
    nombre_paquete, peso, 
    dimenciones, fragil, 
    id_paquete, 
    fecha_recibido, fecha_entrega, 
    fecha_cargado, fecha_ingreso,
    id_lote_portador, destino_calle, 
    id_localidad_destino , 
    nombre_localidad, id_departamento , nombre_departamento , id_almacen
    FROM paquete p 
    INNER JOIN Localidad l ON p.id_localidad_destino  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento
	  LEFT JOIN lote g ON p.id_lote_portador = g.id_lote ";
    $resultado = $this->base_datos->conexion()->execute_query($query);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_paquetes_alm($id_alm)
  {
    $query = "SELECT 
    nombre_paquete, peso, 
    dimenciones, fragil, 
    id_paquete, 
    fecha_recibido, fecha_entrega, 
    fecha_cargado, fecha_ingreso,
    id_lote_portador, destino_calle, 
    id_localidad_destino , 
    nombre_localidad, id_departamento , nombre_departamento , id_almacen
    FROM paquete p 
    INNER JOIN Localidad l ON p.id_localidad_destino  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento
	  LEFT JOIN lote g ON p.id_lote_portador = g.id_lote
    WHERE id_almacen  = ?";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_alm);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }

  public function get_paquetes_lot($id_lote)
  {
    $query = "SELECT 
    nombre_paquete, peso, 
    dimenciones, fragil, 
    id_paquete, 
    fecha_recibido, fecha_entrega, 
    fecha_cargado, fecha_ingreso,
    id_lote_portador, destino_calle, 
    id_localidad_destino , 
    nombre_localidad, id_departamento , nombre_departamento , id_almacen
    FROM paquete p 
    INNER JOIN Localidad l ON p.id_localidad_destino  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento
	  LEFT JOIN lote g ON p.id_lote_portador = g.id_lote
    WHERE id_lote_portador  = ?";
    $resultado = $this->base_datos->conexion()->execute_query($query, $id_lote);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }
  public function get_paquete_lot($ids)
  {
    $query = "SELECT 
    nombre_paquete, peso, 
    dimenciones, fragil, 
    id_paquete, 
    fecha_recibido, fecha_entrega, 
    fecha_cargado, fecha_ingreso,
    id_lote_portador, destino_calle, 
    id_localidad_destino , 
    nombre_localidad, id_departamento , nombre_departamento , id_almacen
    FROM paquete p 
    INNER JOIN Localidad l ON p.id_localidad_destino  = l.id_localidad 
    INNER JOIN departamento d ON l.id_dep = d.id_departamento
	  LEFT JOIN lote g ON p.id_lote_portador = g.id_lote
    WHERE id_lote_portador  = ? and id_paquete= ?";
    $resultado = $this->base_datos->conexion()->execute_query($query, $ids);
    $matriz = array();
    $matriz = $resultado->fetch_all(MYSQLI_ASSOC);

    return $matriz;
  }


  public function delete_paquetes($id)
  {
    $query = "DELETE FROM paquete WHERE paquete.id_paquete = ?";
    $this->base_datos->conexion()->execute_query($query, $id);
  }

  public function update_paquetes($variables)
  {
    echo "<br>";
    var_dump($variables);
    echo "<br>";
    $insert = "UPDATE paquete SET 
    nombre_paquete= ? , 
    dimenciones= ? , 
    peso= ?, 
    fragil= ?, 
    destino_calle= ?, 
    fecha_recibido= ?, 
    fecha_entrega= ?, 
    fecha_cargado= ?, 
    fecha_ingreso= ?, 
    id_lote_portador= ?, 
    id_localidad_destino = ?
    where paquete.id_paquete= ? ";

    $this->base_datos->conexion()->execute_query($insert, $variables);
  }

  public function put_paquetes($variables)
  {

    //id_paquete estado modelo id_almacen
    $insert = "INSERT INTO paquete VALUES (NULL, ?, ?, ?, ?, ?, NULL, NULL, NULL, CURDATE(), NULL, ?, NULL )";
    $this->base_datos->conexion()->execute_query($insert, $variables);
  }
}
