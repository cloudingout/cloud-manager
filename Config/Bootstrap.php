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
    $fileSystem = strtolower($request->getController()) . DS . $request->getMethod() . '.php';

    if (is_readable($url)) {
      self::loadTwig($fileSystem, $data, $request->getMethod());
      // require $url;
    } else {
      // Definimos una vista en caso de que no se encuentre la URL
      $notFound = ROOT . '../Resources/Views/errors' . DS . '404.php';
      require $notFound;
    }
  }

  /**
  * Carga de motor de plantillas Twig
  */
  public function loadTwig($fileSystem, $data, $method)
  {
    require_once ROOT . '..' . DS . 'vendor' . DS . 'lib' . DS . 'Twig' . DS . 'Autoloader.php';
    \Twig_Autoloader::register();

    $urlTemplate = ROOT . '..' . DS . 'Resources' . DS . 'Views';

    $loader = new \Twig_Loader_Filesystem($urlTemplate);
    $twig = new \Twig_Environment($loader);

    echo $twig->render($fileSystem, array(
      'data'    => $data,
      'method'  => $method,
      'assets'  => ASSETS
    ));
  }
}
