{% extends 'index.html' %}

{% block title %}Usuarios{% endblock %}

{% block content %}
  <div class="row center-xs no-margin">
    <div class="col-xs-12 col-md-10">
      <div class="box">
        <div class="card large-padding">
          <div class="row center-xs">
            <div class="col-xs-12 text-left">
              <div class="box">
                <h1 class="title no-margin text-center">Usuarios registrados</h1>
                <div class="top-space"></div>
                <div class="divider"></div>
                <table class="responsive-table centered bordered">
                  <thead>
                    <th>UID</th>
                    <th>Tipo de usuario</th>
                    <th>Nombres</th>
                    <th>Correo Electrónico</th>
                    <th>Contacto</th>
                    <th>Saldo</th>
                    <th colspan="2">Opciones</th>
                  </thead>

                  {% for user in data %}
                    <tr>
                      <td>{{ user.id }}</td>
                      <td>{{ user.user_type }}</td>
                      <td>{{ user.name }} {{ user.last_name}}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.telephone }}</td>
                      <td>$ {{ user.balance }} USD</td>
                      <td>
                        <a href="{{ URL }}users/update/{{ user.id }}" title="Editar"><i class="material-icons">mode_edit</i></a>
                      </td>
                      <td>
                      {% if user.status == 1 %}
                        <a href="{{ URL }}users/changeStatus/{{ user.id }}" title="Desactivar"><i class="material-icons">lock_open</i></a>
                      {% else %}
                        <a href="{{ URL }}users/changeStatus/{{ user.id }}" title="Activar"><i class="material-icons">lock_outline</i></a>
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