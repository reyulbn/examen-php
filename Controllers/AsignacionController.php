<?php

require_once __DIR__ . "/../Models/AsignacionModel.php";

class AsignacionController
{

  private $asignacionModel;
  private $conexion;

  public function __construct()
  {
    $this->asignacionModel = new AsignacionModel();
    $this->conexion = Conexion::connectPDO();
  }

  public function nuevaAsignacion($codigoMiembro, $codigoOperacion, $fecha)
  {
    $this->conexion->begin_transaction();

    try {

      $this->asignacionModel->nuevaAsignacion($codigoMiembro, $codigoOperacion, $fecha);

      $this->conexion->commit();
      return "Asignación exitosa.";
    } catch (Exception $ex) {
      $this->conexion->rollback();
      return "Error en asignación: " . $ex->getMessage();
    }
  }

  public function validarAsignacion($codigoMiembro, $codigoOperacion)
  {

    if (empty($this->asignacionModel->validarAsignacion($codigoMiembro, $codigoOperacion))) {
      return true;
    } else {
      return false;
    }

  }

}

?>