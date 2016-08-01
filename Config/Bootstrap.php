<?php

namespace Config;

/** 
* Carga las vistas y crea objetos a través de la URL
*
* @package cloud_manager
* @author Cristhian David García
*
*/
class Bootstrap
{

  /** 
  * Obtiene los controladores, métodos y argumentos desde la clase Request y
  * crea un objeto del controlador obtenido
  *
  * @param Request $request
  * @return void
  */
  public static function bootstrap(Request $request)
  {
    $controller = $request->getController() . 'Controller';
    $url = ROOT . '../Controllers' . DS . $controller . '.php';
    $method = $request->getMethod();

    if ($method == 'index.php') {
      $method = 'index';
    }

    $argument = $request->getArgument();

    if (is_readable($url)) {
      require_once $url;
      $getController = 'Controllers\\' . $controller;
      $controller = new $getController;

      if (!isset($argument)) {
        $data = call_user_func([$controller, $method]);
      } else {
        $data = call_user_func_array([$controller, $method], $argument);
      }

    }

    // Cargamos las vistas 
    $url = ROOT . '../Resources/Views' . DS . strtolower($request->getController()) . DS . $request->getMethod() . '.php';

    if (is_readable($url)) {
      require $url;
    } else {
      // Definimos una vista en caso de que no se encuentre la URL
      $notFound = ROOT . '../Resources/Views/errors' . DS . '404.php';
      require $notFound;
    }
  }
}
