<?php

require_once __DIR__ . "/../Config/Conexion.php";

class OperacionModel
{

  private $conexion;

  public function __construct()
  {
    $this->conexion = Conexion::connectPDO();
  }

  public function obtenerOperaciones()
  {

    $consulta = "SELECT * FROM operaciones";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);

  }

  public function obtenerOperacionesValorMinimo($valorMinimo)
  {
    $consulta = "SELECT * FROM operaciones WHERE valor_estimado > ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("i", $valorMinimo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
  }

}

?>