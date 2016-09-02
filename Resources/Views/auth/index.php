{% extends 'index.html' %}

{% block title %} Autenticación {% endblock %}
{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-sm-11 col-md-8">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 col-md-11 text-left">
              <div class="box">
                <form action="" method="POST" accept-charset="UTF-8">
                  <h1 class="title no-margin text-center">Inicia sesión</h1>
                    <div class="form-group label-floating col-xs-12 col-sm-6 col-sm-offset-3 top">
                      <label for="email" class="control-label">Correo Electrónico</label>
                      <input id="email" type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group label-floating col-xs-12 col-sm-6 col-sm-offset-3">
                      <label for="password" class="control-label">Contraseña</label>
                      <input id="password" type="password" name="password" class="form-control">
                    </div>
                    <div class="input-group col-xs-12 center-xs">
                      <button class="btn btn-raised btn-inverse" type="submit" name="login" value="login">
                        Iniciar 
                      </button>
                    </div>
                </form>
                {% if data is not empty %}
                  <div class="alert alert-dismissible alert-danger top relative col-xs-6 col-xs-offset-3">
                    <button type="button" class="close" data-dismiss="alert" style="padding-right: 20px">×</button>
                    <ul>                    
                  {% for error in data %}
                      <li>{{ error }}</li>
                  {% endfor %}
                    </ul>
                  </div>
                {% endif %}
              </div>
            </div>
          </div>
          <div class="divider"></div>
          <div class="bottom-space">
            <div class="row top-space center-xs">
              <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="box">
                  <p>¿Aún no estas registrado(a)?</p>
                  <a href="users/signup">Crea una cuenta</a>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="box">
                  <p>¿Olvidaste tu contraseña?</p>
                  <a href="">Recuperar contraseña</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{% endblock %}
