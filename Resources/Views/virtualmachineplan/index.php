{% extends 'index.html' %}

{% block title %} Virtual machine {% endblock %}

{% block content %}
    
  <h2>Maquinas virtuales</h2>
  <table border="1">
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
        <a href="{{ URL }}virtualmachineplan/update/{{ vm.id }}">Editar</a>
      </td>
      <td>
      {% if vm.status == 1 %}
        <a href="{{ URL }}virtualmachineplan/changeStatus/{{ vm.id }}">Desactivar</a>
      {% else %}
        <a href="{{ URL }}virtualmachineplan/changeStatus/{{ vm.id }}">Activar</a>
      {% endif %}
      </td>
    </tr>
    {% endfor %}
  </table>
{% endblock %}