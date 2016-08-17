<?php

namespace Config;

/** 
* Obtiene la URL y a través de ella se asignan los controladores, métodos 
* y argumentos (si los hay) 
*
* @package Request
* @author Cristhian David García
*/

class Request 
{
  /**
  * Obtenemos el controlador que será usado
  *
  * @var $controller
  */
  private $controller;

  /** 
  * Obtenemos el method que será usado
  * 
  * @var $method
  */
  private $method;

  /**
  * Obtenemos el argumento (si lo hay) que será usado
  *
  * @var $argument
  */
  private $argument;

  /** 
  * Constructor de la clase - a través de la url definimos los métodos, 
  * controladores y/o argumentos que serán usados. 
  *
  * @return void
  */
  public function __construct()
  {
    if (isset($_GET['url'])) {
      $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
      $url = explode('/', $url); 
      $url = array_filter($url);

      #parte que se agrego al codigo problema index vacio
      if ($_GET['url'] == '/'){
        $url[0] = 'Home';
      }

      if ($url[0] == 'index.php') {
        $this->controller = 'Home';
      } else {
        $this->controller = ucwords(array_shift($url));
      }

      $this->method = strtolower(array_shift($url));

      if (!$this->method) {
        $this->method = 'index';
      }

      $this->argument = $url;
      
    } else {
      $this->controller = 'Home';
      $this->method = 'index';
    }

  }

  /** 
  * Obtiene el controlador 
  *
  * @return string $this->controller 
  */
  public function getController()
  {
    return $this->controller;
  }

  /** 
  * Obtiene el método 
  *
  * @return string $this->method 
  */
  public function getMethod()
  {
    return $this->method;
  }

  /** 
  * Obtiene el argumento 
  *
  * @return string $this->argument 
  */
  public function getArgument()
  {
    return $this->argument;
  }

}
