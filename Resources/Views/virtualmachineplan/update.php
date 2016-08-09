{% extends 'index.html' %}

{% block title %}Planes disponibles{% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-sm-11 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 col-md-8 text-left">
              <div class="box">
                <form action="" method="POST">
                  <h1 class="title no-margin">Actualizar plan {{ data[0]['name'] }}</h1>
                    <div class="input-field col-xs-12 top">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" id="name" value="{{ data[0]['name']}}" class="validate">
                    </div>
                    <div class="input-field col-xs-12">
                      <label for="cpu">CPU</label>
                      <input type="number" name="cpu" id="cpu" value="{{ data[0]['processors']}}" class="validate">
                    </div>
                    <div class="input-field col-xs-12 top">
                      <label for="ram">RAM</label>
                      <input type="number" name="ram" id="ram" value="{{ data[0]['ram']}}" class="validate">
                    </div>
                    <div class="input-field col-xs-12">
                      <label for="hard-disk">Disco Duro</label>
                      <input type="number" name="hard-disk" id="hard-disk" value="{{ data[0]['hard_disk']}}" class="validate">
                    </div>
                    <div class="input-field col-xs-12 top">
                      <label for="price">Precio: </label>
                      <input type="number" name="price" id="price" value="{{ data[0]['price']}}" class="validate">
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