{% extends 'index.html' %}

{% block title %} Users {% endblock %}

{% block content %}
      
  <!-- Crear los usuarios -->
  <h2>Creación de usuarios</h2>
  <form action="" method="POST">
    <label for="user-type">Tipo de usuario</label>
    <select name="user-type" id="user-type">
      <option value="1">Administrador</option>
      <option value="1">Administrador</option>
    </select> <br>
    <label for="name">Nombres</label>
    <input type="text" name="name" id="name"> <br>
    <label for="last-name">Apellidos</label>
    <input type="text" name="last-name" id="last-name"> <br>
    <label for="email">Correo Electrónico</label>
    <input type="email" name="email" id="email"> <br>
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password"> <br>
    <label for="telephone">Teléfono</label>
    <input type="text" name="telephone" id="telephone"> <br>
    <input type="submit" name="register" value="Registrar"> <br>
  </form>
{% endblock %}  