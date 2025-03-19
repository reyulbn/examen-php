<?php

require_once __DIR__ . "/../Controllers/FamiliaController.php";
require_once __DIR__ . "/../Controllers/OperacionController.php";
require_once __DIR__ . "/../Controllers/AsignacionController.php";


$familiaController = new FamiliaController();
$operacionController = new OperacionController();
$asignacionController = new AsignacionController();

$miembros = $familiaController->obtenerMiembros();
$operaciones = $operacionController->obtenerOperacionesValorMinimo(150000);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigoMiembro']) && isset($_POST['operacionSeleccionada'])) {
  $miembro = $_POST['codigoMiembro'];
  $operacion = $_POST['operacionSeleccionada'];
  if ($asignacionController->validarAsignacion($miembro, $operacion)) {
    $asignacionController->nuevaAsignacion($miembro, $operacion, date('y-m-d'));
  } else {
    echo "Error. La asignación ya existe.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asignación de Operaciones - Familia Corleone</title>
  <link rel="stylesheet" href="../Estilos/estiloForm.css">
</head>

<body>

  <form method="POST">

    <h2>Asignación de Operaciones - Familia Corleone</h2>
    <br>

    <h3>Seleccionar Miembro:</h3>

    <select name="codigoMiembro" id="codigoMiembro">
      <?php

      foreach ($miembros as $miembro) {
        $codigo = $miembro['id'];
        $nombre = $miembro['nombre'];
        $rol = $miembro['rol'];
        echo "<option value='$codigo'>$nombre ($rol)</option>";
      }

      ?>
    </select>

    <h3>Seleccionar Operación (valor > 150000€)</h3>

    <?php

    foreach ($operaciones as $operacion) {
      $codigo = $operacion['id'];
      $nombre = $operacion['nombre'];
      $valor = $operacion['valor_estimado'];
      echo "<input type='radio' name='operacionSeleccionada' value='$codigo'>$nombre - {$valor}€<br>";
    }

    ?>

    <br><br>
    <button type="submit">Asignar Operación</button>
    <br><br>
    <a href="../Index.php">Volver</a>
  </form>





</body>

</html>