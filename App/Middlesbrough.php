<?php

namespace App;

/**
* Clase helper, sirvirá para proteger cadenas de texto, validar formularios
* 
* @package cloud_manager
* @author Cristhian David García
*/

class Middlesbrough
{

  /**
  * @var integer $longitud longitud del salt a generar
  *
  */
  private $longitudSalt = 5;

  /**
  * @var string salt
  */
  private $salt = "!@*.5233";
  /**
  * Encripta una cadena de texto, dada por el parámetro $string
  * 
  * @param string $string una cadena de texto dada por el usuario
  * @return string cadena de texto encriptada
  */
  public function encrypt($string)
  {
    $out = hash('sha1', $string.$this->salt);
    return $this->salt.$this->longitudSalt.$out.$this->salt;
  }
}
