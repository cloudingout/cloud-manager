{% extends 'index.html' %}

{% block title %} Sign up {% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-sm-11 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 text-left">
              <div class="box">
                <form action="" method="POST" accept-charset="UTF-8">
                  <h1 class="title no-margin text-center">Registrate</h1>
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3 top">
                      <label for="name">Nombres</label>
                      <input id="name" type="text" name="name" class="validate">
                    </div>
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3 top">
                      <label for="last-name">Apellidos</label>
                      <input id="last-name" type="text" name="last-name" class="validate">
                    </div>
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3 top">
                      <label for="email">Correo Electrónico</label>
                      <input id="email" type="email" name="email" class="validate">
                    </div>
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3">
                      <label for="password">Contraseña</label>
                      <input id="password" type="password" name="password" class="validate">
                    </div>
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3">
                      <label for="telephone">Teléfono</label>
                      <input id="telephone" type="text" name="telephone" class="validate">
                    </div>
                    <div class="input-field col-xs-12 col-md-4 col-md-offset-6 text-center">
                      <button class="btn waves-effect waves-light indigo" type="submit" name="iniciar">
                        Registrar 
                      </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="divider"></div>
          <div class="bottom-space"></div>
        </div>
      </div>
    </div>
  </div>
{% endblock %}  