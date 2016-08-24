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
  * Encripta una cadena de texto, dada por el parámetro $string
  * 
  * @param string $string una cadena de texto dada por el usuario
  * @return string cadena de texto encriptada
  */
  public function dcrypt($string)
  {
    // Generamos el salt aleatorio con la longitud definida
    $salt = substr(uniqid(rand(), true), 0, $this->longitudSalt);

    $out = hash('sha1', $string.$salt);
    return $this->longitudSalt.$out.salt;
  }

  /**
  * Encuentra el hash correspondiente a una cadena, lo separa y lo valida
  * Servirá para el logueo del usuario
  *
  * @param string $string cadena de texto a validar 
  * @return string $hash contiene la longitud, el hash y el salt 
  *         de la cadena de texto original
  */
  public function isEqualDcrypt($string)
  {
    $arrHash['longitud']  = substr($string, 0, 1);
    $arrHash['hash']      = substr($string, 1, strlen($string) - ($arrHash['longitud'] + 1));
    $arrHash['salt']      = str_replace($arrHash['hash'], '', substr($string, 1));

    $hash = $arrHash['longitud'].$arrHash['hash'].$arrHash['salt'];
    return $hash;
  }

}
