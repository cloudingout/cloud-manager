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
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3 top">
                      <i class="material-icons prefix">account_circle</i>
                      <label for="email">Correo Electrónico</label>
                      <input id="email" type="email" name="email" class="validate">
                    </div>
                    <div class="input-field col-xs-12 col-sm-6 col-sm-offset-3">
                      <i class="material-icons prefix">vpn_key</i>
                      <label for="password">Contraseña</label>
                      <input id="password" type="password" name="password" class="validate">
                    </div>
                    <div class="input-field col-xs-12 text-center">
                      <button class="btn waves-effect waves-light indigo" type="submit" name="login" value="xx">
                        Iniciar 
                        <i class="material-icons right">cloud</i> 
                      </button>
                    </div>
                </form>
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
