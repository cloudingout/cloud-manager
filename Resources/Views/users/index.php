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
      <th>Tipo de usuario</th>
      <th>Nombres</th>
      <th>Correo Electrónico</th>
      <th>Contacto</th>
      <th>Saldo</th>
      <th colspan="2">Opciones</th>
    </thead>

    <?php foreach ($data as $datos): ?>
    <tr>
      <td><?php echo $datos['id']; ?></td>
      <td><?php echo $datos['user_type']; ?></td>
      <td><?php echo $datos['name']. ' ' . $datos['last_name']; ?></td>
      <td><?php echo $datos['email']; ?></td>
      <td><?php echo $datos['telephone']; ?></td>
      <td>$<?php echo $datos['balance']; ?> USD</td>
      <td>
        <a href="<?php echo URL; ?>users/update/<?php echo $datos['id']; ?>">Editar</a>
      </td>
      <td>
      <?php if ($datos['status'] == 1): ?>
        <a href="<?php echo URL; ?>users/changeStatus/<?php echo $datos['id']; ?>">Desactivar</a>
      <?php else: ?>
        <a href="<?php echo URL; ?>users/changeStatus/<?php echo $datos['id']; ?>">Activar</a>
      <?php endif ?>
      </td>
    </tr>
    <?php endforeach ?>
  </table>
</body>
</html>