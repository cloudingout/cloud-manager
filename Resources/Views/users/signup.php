{% extends 'index.html' %}

{% block title %} Sign up {% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-md-5">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 col-md-10 text-left">
              <div class="box">
                <form action="" method="POST" accept-charset="UTF-8">
                  <h1 class="title no-margin text-center">Regístrate</h1>
                    <div class="input-field col-xs-12 top">
                      <i class="material-icons prefix">email</i>
                      <label for="email">Correo Electrónico</label>
                      <input id="email" type="email" name="email" class="validate">
                    </div>
                    <div class="input-field col-xs-12 top">
                      <i class="material-icons prefix">vpn_key</i>
                      <label for="password">Contraseña</label>
                      <input id="password" type="password" name="password" class="validate">
                    </div>
                    <div class="input-field col-xs-12 top">
                      <i class="material-icons prefix">vpn_key</i>
                      <label for="confirm-password">Confirmar Contraseña</label>
                      <input id="confirm-password" type="password" name="confirm-password" class="validate">
                    </div>
                    <div class="input-field col-xs-12 top">
                      <button class="btn waves-effect waves-light indigo full-width" type="submit" name="iniciar">
                        Regístrate
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