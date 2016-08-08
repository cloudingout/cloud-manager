{% extends 'index.html' %}
{% block title %}Planes disponibles{% endblock %}
{% block content %}
  <h2>Actualización de planes de {{ data[0]['name'] }}</h2>
  <form action="" method="POST">
    <label for="name">Nombre: </label>
    <input type="text" name="name" id="name" value="{{ data[0]['name']}}"> <br>
    <label for="cpu">CPU: </label>
    <input type="number" name="cpu" id="cpu" value="{{ data[0]['processors']}}"> <br>
    <label for="ram">RAM: </label>
    <input type="number" name="ram" id="ram" value="{{ data[0]['ram']}}"> <br>
    <label for="hard-disk">Disco Duro: </label>
    <input type="number" name="hard-disk" id="hard-disk" value="{{ data[0]['hard_disk']}}"> <br>
    <label for="price">Precio: </label>
    <input type="number" name="price" id="price" value="{{ data[0]['price']}}"> <br>
    <input type="submit" value="Actualizar" name="update">
  </form>
{% endblock %}