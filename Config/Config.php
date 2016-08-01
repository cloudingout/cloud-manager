<?php

/**
* Archivo de configuración
* definimos drivers, host, puertos, etc...
*
*/

return [
  
  'connections' => [

    'mysql' => [
      'driver'    => 'mysql', 
      'host'      => 'www.metin2renacer.com', 
      'port'      => 3306, 
      'database'  => 'cloud_manager', 
      'username'  => 'admin', 
      'password'  => 'Penagos258', 
      'charset'   => 'utf8', 
      'collation' => 'utf8_unicode_ci', 
      'prefix'    => '', 
      'static'    => false, 
      'engine'    => null
    ],

    'pgsql' => [

    ],

  ],

];
