<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Errors</title>
</head>
<body>
  {% if errors is not empty %}
    {% for error in errors %}
        {{ error }}
    {% endfor %}
  {% else %}
      <li>Holaaa</li>
  {% endif %}
</body>
</html>