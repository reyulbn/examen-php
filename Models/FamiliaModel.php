<?php

require_once __DIR__ . "/../Config/Conexion.php";

class FamiliaModel
{

  private $conexion;

  public function __construct()
  {
    $this->conexion = Conexion::connectPDO();
  }

  public function obtenerMiembros()
  {

    $consulta = "SELECT * FROM miembros";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);

  }

  public function getTraidores($lealtad)
  {
    $consulta = "SELECT * FROM miembros WHERE lealtad < ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("i", $lealtad);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);

  }

  public function eliminarMiembro($codigoMiembro)
  {
    $consulta = "DELETE FROM miembros WHERE id = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("i", $codigoMiembro);
    $stmt->execute();
  }

  public function eliminarTraidores()
  {
    $consulta = "DELETE FROM miembros WHERE lealtad < 80";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->execute();
  }

}

?>