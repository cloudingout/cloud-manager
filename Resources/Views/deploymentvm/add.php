{% extends 'index.html' %}

{% block title %} Deploy {% endblock %}

{% block content %}  
  <h2>Despliegue - Agregar</h2>
  <form action="" method="POST">
    <label for="user-id">Usuario</label>
    <select name="user-id" id="user-id">
      <option value="1">Cristhian David García</option>
      <option value="2">Luis Alberto Penagos</option>
    </select> <br> <br>
    <label for="vm-plans">Planes</label>
    <select name="vm-plans" id="vm-plans">
      <option value="1">Maquina de prueba</option>
      <option value="2">Vm Enterpise</option>
    </select> <br> <br>
    <label for="expiry-time">Fecha de expiración</label>
    <input type="date" name="expiry-time" id="expiry-time"> <br> <br>
    <input type="submit" name="buy" value="Comprar">
  </form>
{% endblock %}
