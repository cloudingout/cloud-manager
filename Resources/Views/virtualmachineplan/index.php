<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>
</head>
<body>
  <!-- Mostrar los usuarios -->
  <h2>Usuarios</h2>
  <table border="1">
    <thead>
      <th>UID</th>
      <th>Nombres</th>
      <th>CPU</th>
      <th>RAM</th>
      <th>Disco Duro</th>
      <th>Precio</th>
      <th colspan="2">Opciones</th>
    </thead>

    <?php foreach ($data as $datos): ?>
    <tr>
      <td><?php echo $datos['id']; ?></td>
      <td><?php echo $datos['name']; ?></td>
      <td><?php echo $datos['processors']; ?></td>
      <td><?php echo $datos['ram']; ?></td>
      <td><?php echo $datos['hard_disk']; ?></td>
      <td><?php echo $datos['price']; ?></td>
      <td>
        <a href="<?php echo URL; ?>virtualmachineplan/update/<?php echo $datos['id']; ?>">Editar</a>
      </td>
      <td>
      <?php if ($datos['status'] == 1): ?>
        <a href="<?php echo URL; ?>virtualmachineplan/status/<?php echo $datos['id']; ?>">Desactivar</a>
      <?php else: ?>
        <a href="<?php echo URL; ?>virtualmachineplan/status/<?php echo $datos['id']; ?>">Activar</a>
      <?php endif ?>
      </td>
    </tr>
    <?php endforeach ?>
  </table>
</body>
</html>