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
                  <div class="form-group label-floating col-xs-12 top">
                    <label for="name" class="control-label">Nombres</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ data[0]['name'] }}">
                  </div>
                  <div class="form-group label-floating col-xs-12 top">
                    <label for="last-name" class="control-label">Apellidos</label>
                    <input type="text" name="last-name" class="form-control" id="last-name" value="{{ data[0]['last_name'] }}">
                  </div>
                  <div class="form-group label-floating col-xs-12 top">
                    <label for="email" class="control-label">Correo electrónico: </label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ data[0]['email'] }}">
                  </div>
                  <div class="input-group col-xs-12 top">
                    <button class="btn btn-raised btn-inverse" type="submit" name="update">
                      Actualizar
                    </button>
                  </div>
                </form>
                {% if data is not empty and request == "POST" %}
                  <div class="alert alert-dismissible alert-warning top relative">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                      <ul>
                        {% for warning in data %}
                          <li>{{ warning }}</li>
                        {% endfor %}
                      </ul>
                  </div>
                {% endif %}
              </div>
            </div>
          </div>
          <div class="divider"></div>
          </div>
      </div>
    </div>
  </div>
{% endblock %}