<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Actualizar</title>
</head>
<body>
  <h2>Actualización de planes de <?php echo $data[0]['name'] ?></h2>
  <form action="" method="POST">
    <label for="name">Nombre: </label>
    <input type="text" name="name" id="name" value="<?php echo $data[0]['name']; ?>"> <br>
    <label for="cpu">CPU: </label>
    <input type="number" name="cpu" id="cpu" value="<?php echo $data[0]['processors']; ?>"> <br>
    <label for="ram">RAM: </label>
    <input type="number" name="ram" id="ram" value="<?php echo $data[0]['ram']; ?>"> <br>
    <label for="hard-disk">Disco Duro: </label>
    <input type="number" name="hard-disk" id="hard-disk" value="<?php echo $data[0]['hard_disk']; ?>"> <br>
    <label for="price">Precio: </label>
    <input type="number" name="price" id="price" value="<?php echo $data[0]['price']; ?>"> <br>
    <input type="submit" value="Actualizar" name="update">
  </form>

</body>
</html>