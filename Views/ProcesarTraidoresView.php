<?php

require_once __DIR__ . "/../Controllers/FamiliaController.php";

$familiaController = new FamiliaController();

$traidores = $familiaController->getTraidores(80);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Estilos/estiloForm.css">
  <title>Procesar Traidores - Familia Corleone</title>
</head>

<body>
  <div class="container">

    <h2>Procesar Traidores - Familia Corleone</h2>

    <?php if (!empty($traidores)) { ?>

      <h3>Lista de Traidores (Lealtad < 80%):</h3>


          <table border="1">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Lealtad (%)</th>
            </tr>
          <?php } ?>

          <?php

          foreach ($traidores as $traidor) {
            $id = $traidor['id'];
            $nombre = $traidor['nombre'];
            $lealtad = $traidor['lealtad'];
            echo "<tr><td>$id</td><td>$nombre</td><td>$lealtad</td></tr>";
          }

          ?>

        </table>

        <br>

        <?php
        if (!empty($traidores)) {
          echo $familiaController->procesarTraidores($traidores);
        } else {
          echo "Ya no hay traidores.";
        }
        ?>

  </div>
  <br><br>
  <a href="../Index.php">Volver</a>
</body>

</html>