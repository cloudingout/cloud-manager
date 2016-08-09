{% extends 'index.html' %}

{% block title %} Virtual machine {% endblock %}

{% block content %}
  
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 text-left">
              <div class="box">
                <h1 class="title no-margin text-center">Planes disponibles</h1>
                <div class="top-space"></div>
                <div class="divider"></div>
                <table class="responsive-table centered bordered">
                  <thead>
                    <th>UID</th>
                    <th>Nombres</th>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>Disco Duro</th>
                    <th>Precio</th>
                    <th colspan="2">Opciones</th>
                  </thead>

                  {% for vm in data %}
                  <tr>
                    <td>{{ vm.id }}</td>
                    <td>{{ vm.name }}</td>
                    <td>{{ vm.processors }}</td>
                    <td>{{ vm.ram }}</td>
                    <td>{{ vm.hard_disk }}</td>
                    <td>{{ vm.price }}</td>
                    <td>
                      <a href="{{ URL }}virtualmachineplan/update/{{ vm.id }}" title="Editar">
                        <i class="material-icons">mode_edit</i>
                      </a>
                    </td>
                    <td>
                    {% if vm.status == 1 %}
                      <a href="{{ URL }}virtualmachineplan/changeStatus/{{ vm.id }}" title="Desactivar"><i class="material-icons">lock_open</i></a>
                    {% else %}
                      <a href="{{ URL }}virtualmachineplan/changeStatus/{{ vm.id }}" title="Activar"><i class="material-icons">lock_outline</i></a>
                    {% endif %}
                    </td>
                  </tr>
                  {% endfor %}
                </table>
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