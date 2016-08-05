{% extends 'index.html' %}
{% block title %}Usuarios{% endblock %}
{% block content %}  
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

    {% for user in data %}
      <tr>
        <td>{{ user.id }}</td>
        <td>{{ user.user_type }}</td>
        <td>{{ user.last_name}}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.telephone }}</td>
        <td>$ {{ user.balance }} USD</td>
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
    {% endfor %}
  </table>
{% endblock %}