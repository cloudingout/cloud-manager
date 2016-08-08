{% extends 'index.html' %}

{% block title %} Autenticación {% endblock %}
{% block content %}
<div class="container">
  <div class="row">
    <div class="col s12 m10 offset-m1">
    <div class="card medium">
      <div class="card-content">
      <h2 card-title>Inicia sesión</h2>
      <form action="" method="POST">
        <input type="email" name="email"><br>
        <input type="password" name="password"> <br>
        <button type="submit" class="btn btn-success">Iniciar</button>
      </form>
      </div>
    </div>
    </div>
  </div>
</div>
{% endblock %}
