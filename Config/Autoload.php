<?php 

/** 
* Carga automática de clases 
* 
* @param string $class Nombre completo de la clase
* @return void
*/
spl_autoload_register(function ($class) {

  /**
  * Nombre del archivo reemplazando \ por / y agregando la extesión .php
  * el nombre de la clase ingresa aquí así: 
  * 
  * NamespaceName\ClassName;
  * 
  * Esta línea lo organiza así: 
  * 
  * NamespaceName/ClassName
  */
  $file = '../' . str_replace("\\", "/", $class) . '.php';

  // ¿Existe el archivo?
  if (file_exists($file)) {
    // Requiero el archivo
    require $file;
  }
});
