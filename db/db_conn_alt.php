<?php

class conexion{

private $conexion;
    public function bd(){
        $this->conexion = new mysqli('192.168.5.50','lucas.caballero','54798621','cloudware'); 

       return $this->conexion;
    }

}

?>