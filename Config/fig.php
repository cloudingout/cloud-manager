<?php 

  /** 
  * Definimos separador de directorios, ruta absoluta del archivo y 
  * url http
  *
  */
  define('DS', DIRECTORY_SEPARATOR);
  define('ROOT', realpath(dirname(__FILE__)) . DS);
  define('URL', 'http://app.local/');
  define('ASSETS', 'http://app.local/assets/');
  define('__SECRET_KEY__', 'azdfvbjkluhg@652.*!');
  