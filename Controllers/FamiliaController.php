<?php

require_once __DIR__ . "/../Models/FamiliaModel.php";

class FamiliaController
{

  private $familiaModel;
  private $conexion;

  public function __construct()
  {
    $this->familiaModel = new FamiliaModel();
    $this->conexion = Conexion::connectPDO();
  }

  public function obtenerMiembros()
  {
    $miembros = $this->familiaModel->obtenerMiembros();
    return $miembros;
  }

  public function getTraidores($lealtad)
  {
    $traidores = $this->familiaModel->getTraidores($lealtad);
    return $traidores;
  }

  public function procesarTraidores($traidores)
  {

    $this->conexion->begin_transaction();

    try {

      foreach ($traidores as $traidor) {
        $this->familiaModel->eliminarMiembro($traidor['id']);
      }


      $this->conexion->commit();
      return "Proceso de eliminación exitoso.";
    } catch (Exception $ex) {
      $this->conexion->rollback();
      $this->familiaModel->eliminarTraidores();
      echo "ERROR. Todos los traidores eliminados por seguridad.";
      return "Error en proceso de eliminación: " . $ex->getMessage();
    }

  }

}

?>