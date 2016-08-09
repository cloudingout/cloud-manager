{% extends 'index.html' %}

{% block title %} Deploy {% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 col-md-8 text-left">
              <div class="box">
                <form action="" method="POST">
                  <h1 class="title no-margin text-center">Despliegue</h1>
                  <div class="input-field col-xs-12 top">
                    <select name="user-id" id="user-id">
                      <option value="" disabled selected>Elige una opción</option>
                      <option value="1">Cristhian David García</option>
                      <option value="2">Luis Alberto Penagos</option>
                    </select>
                    <label for="user-id">Usuario</label>
                  </div>
                  <div class="input-field col-xs-12 top">
                    <select name="vm-plans" id="vm-plans">
                      <option value="" disabled selected>Elige una opción</option>
                      <option value="1">Maquina de prueba</option>
                      <option value="2">Vm Enterpise</option>
                    </select>
                    <label for="vm-plans">Planes</label>
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="expiry-time">Fecha de expiración</label>
                    <input type="date" name="expiry-time" id="expiry-time" class="datepicker">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <button class="btn waves-effect waves-light indigo" type="submit" name="buy">
                      Comprar
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
