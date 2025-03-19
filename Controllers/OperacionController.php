<?php

require_once __DIR__ . "/../Models/OperacionModel.php";

class OperacionController
{

  private $operacionModel;

  public function __construct()
  {
    $this->operacionModel = new OperacionModel();
  }

  public function obtenerOperaciones()
  {
    $operaciones = $this->operacionModel->obtenerOperaciones();
    return $operaciones;
  }

  public function obtenerOperacionesValorMinimo($valorMinimo)
  {
    $operacionesValorMinimo = $this->operacionModel->obtenerOperacionesValorMinimo($valorMinimo);
    return $operacionesValorMinimo;
  }

}

?>