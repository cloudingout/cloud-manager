<?php 

/** 
* Registro - Autocargador 
*
* Generamos nuestro autocargador de clases para nuestra aplicación en la 
* carpeta Config, aquí simplemente lo requerimos y tendremos que preocuparnos 
* por hacer una larga lista de requires o includes en nuestra aplicación
*
*/
require_once __DIR__ . '../../Config/Autoload.php';

/**
* Requerimos las constantes de configuración
*
* DS - URL - ROOT
*/
require_once __DIR__ . '../../Config/fig.php';

/** 
* Cargamos los archivos y limpiamos las url's
*
*
*/

Config\Bootstrap::bootstrap(new Config\Request());
