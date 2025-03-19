<?php

require_once __DIR__ . "/../Config/Conexion.php";

class AsignacionModel
{

  private $conexion;

  public function __construct()
  {
    $this->conexion = Conexion::connectPDO();
  }

  public function nuevaAsignacion($codigoMiembro, $codigoOperacion, $fecha)
  {
    $consulta = "INSERT INTO asignaciones (id_miembro, id_operacion, fecha) VALUES (?,?,?)";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("iis", $codigoMiembro, $codigoOperacion, $fecha);
    $stmt->execute();
  }


  public function validarAsignacion($codigoMiembro, $codigoOperacion)
  {
    $consulta = "SELECT id FROM asignaciones WHERE id_miembro = ? AND id_operacion = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("ii", $codigoMiembro, $codigoOperacion);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);

  }

}

?>