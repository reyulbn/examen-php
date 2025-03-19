<?php
require_once 'ConexionSOAP.php';

class CosaNostraService
{

  private $conexion;

  public function __construct()
  {
    $this->conexion = (new ConexionSOAP())->getConexion();
  }

  public function getTraidores($lealtad)
  {

  }

}
?>