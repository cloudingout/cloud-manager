{% extends 'index.html' %}

{% block title %}Usuarios - Actualizar{% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-sm-11 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 col-md-8 text-left">
              <div class="box">
                <form action="" method="POST">
                  <h1 class="title no-margin">Actualización de datos de {{ data[0]['name'] }} {{ data[0]['last_name'] }}</h1>
                  <div class="input-field col-xs-12 top">
                    <label for="name">Nombres</label>
                    <input type="text" name="name" id="name" value="{{ data[0]['name'] }}">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="last-name">Apellidos</label>
                    <input type="text" name="last-name" id="last-name" value="{{ data[0]['last_name'] }}">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="email">Correo electrónico: </label>
                    <input type="email" name="email" id="email" value="{{ data[0]['email'] }}">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="telephone">Telefono: </label>
                    <input type="text" name="telephone" id="telephone" value="{{ data[0]['telephone'] }}">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <button class="btn waves-effect waves-light indigo" type="submit" name="update">
                      Actualizar
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="divider"></div>
          </div>
      </div>
    </div>
  </div>
{% endblock %}