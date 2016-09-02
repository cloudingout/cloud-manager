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
                    <div class="form-group label-floating col-xs-12 top">
                      <label for="email" class="control-label">Correo Electrónico</label>
                      <input id="email" type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group label-floating col-xs-12 top">
                      <label for="password" class="control-label">Contraseña</label>
                      <input id="password" type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group label-floating col-xs-12 top">
                      <label for="confirm-password" class="control-label">Confirmar Contraseña</label>
                      <input id="confirm-password" type="password" name="confirm-password" class="form-control">
                    </div>
                    <div class="input-group col-xs-12 top">
                      <button class="btn btn-raised btn-inverse full-width" type="submit" name="iniciar">
                        Regístrate
                      </button>
                    </div>
                </form>
                {% if data is not empty %}
                  <div class="alert alert-dismissible alert-warning top relative">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                      <ul>
                        {% for warning in data %}
                          <li>{{ warning }}</li>
                        {% endfor %}
                      </ul>
                    {% endif %}
                  </div>
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