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
    </thead>

    <?php foreach ($data as $datos): ?>
    <tr>
      <td><?php echo $datos['id']; ?></td>
      <td><?php echo $datos['user_type']; ?></td>
      <td><?php echo $datos['name']. ' ' . $datos['last_name']; ?></td>
      <td><?php echo $datos['email']; ?></td>
      <td><?php echo $datos['telephone']; ?></td>
      <td>$<?php echo $datos['balance']; ?> USD</td>
    </tr>
    <?php endforeach ?>
  </table>
</body>
</html>