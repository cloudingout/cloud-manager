<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualización de datos</title>
</head>
<body>
  <h2>Actualización de datos de <?php echo $data[0]['name'] . ' ' . $data[0]['last_name']; ?></h2>
  <form action="" method="POST">
    <label for="name">Nombres: </label>
    <input type="text" name="name" id="name" value="<?php echo $data[0]['name']; ?>"> <br>
    <label for="last-name">Apellidos: </label>
    <input type="text" name="last-name" id="last-name" value="<?php echo $data[0]['last_name']; ?>"> <br>
    <label for="email">Correo electrónico: </label>
    <input type="email" name="email" id="email" value="<?php echo $data[0]['email']; ?>"> <br>
    <label for="telephone">Telefono: </label>
    <input type="text" name="telephone" id="telephone" value="<?php echo $data[0]['telephone']; ?>"> <br>
    <input type="submit" value="Actualizar" name="update">
  </form>
</body>
</html>