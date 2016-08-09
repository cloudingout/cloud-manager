{% extends 'index.html' %}
{% block title %} Creación plan{% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 col-md-8 text-left">
              <div class="box">
                <form action="" method="POST">
                  <h1 class="title no-margin text-center">Crear Plan</h1>
                  <div class="input-field col-xs-12 top">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" clas="validate">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="processors">CPUS</label>
                    <input type="number" name="processors" id="processors" class="validate">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="ram">RAM</label>
                    <input type="number" name="ram" id="ram" class="validate">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="hard-disk">Disco duro</label>
                    <input type="number" name="hard-disk" id="hard-disk" class="validate">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <label for="price">Precio</label>
                    <input type="number" name="price" id="price" class="validate">
                  </div>
                  <div class="input-field col-xs-12 top">
                    <button class="btn waves-effect waves-light indigo" type="submit" name="crear_plan">
                      Crear Plan
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