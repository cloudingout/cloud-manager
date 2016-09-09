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
  * @var array $errors almacena los errores cuando no se cumpla una condición
  *
  */
  private $errors;

  /**
  * @var integer $longitud longitud del salt a generar
  *
  */
  private $longitudSalt = 5;
  
  /**
  * Validación de texto, con espacios o sin ellos, posibilidad de enviar longitud 
  * mínima y máxima del string. Agrega una cadena de texto al array $errors en 
  * caso de que exista un error
  *
  * @param string $string cadena de texto que será evaluada
  * @param boolean || integer $min cantidad de caracteres mínimos permitidos
  * @param boolean || integer $max cantidad de caracteres máximos permitidos
  * @param boolean $spaces define si la cadena de texto puede o no contener espacios
  * @param boolean $required define si un campo de texto es requerido
  * @param boolean $stringNumeric define si la cadena puede contener números y letras 
  * @param string $message mensaje para mostrar al usuario en caso de error
  *
  * @return boolean 
  */
  public function validateText($string, $min, $max, $spaces, $required, $stringNumeric)
  {
    $string = $this->cleaningCharacters($string);
    if (!empty($min)) {
      if (strlen($string) < $min) {
        $this->errors[] = "El campo es obligatorio";
        return false;
      }
    }

    if (!empty($max)) {
      if (strlen($string) > $max) {
        $this->errors[] = "La longitud de caracteres supera la longitud máxima permitida";
        return false;

      }
    }

    if ($spaces) {
      // Solo espacios y letras
      $spaces = preg_match("/^[a-zA-Z ]*$/", $string);
    }

    if ($spaces) {
      return $string;
    } else {
      $this->errors[] = "Error inesperado";
      return false;
    }

    if ($stringNumeric) {
      // Numeros, letras y espacios 
      return $string = preg_match("/^[a-zA-Z0-9 ]*$/", $string);
    } else {
      // Numeros y letras
      return $string = preg_match("/^[a-zA-Z0-9]*$/", $string);
    }
  }

  /**
  * Validación de direcciones email
  *
  * @param string $email direción email que será evaluada
  * @param string $message mensaje para mostrar al usuario en caso de error
  *
  * @return boolean 
  */
  public function validateEmail($email)
  {
    $email = $this->cleaningCharacters($email);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = "Por favor proporcione un correo electrónico válido";
      return false;
    } else {
      return $email;
    }
  }

  /**
  * Validación de números, valor mínimo, valor máximo
  *
  * @param numeric $num numero que será validado
  * @param boolean || $min integer valor mínimo permitido
  * @param boolean || $max integer valor máximo permitido
  * @param string $message mensaje para mostrar al usuario en caso de error
  *
  * @return boolean 
  */
  public function validateNumeric($num, $min, $max, $message)
  {
    if (is_numeric($num)) {

      if ($num < $min || $num > $max) {
        $this->errors[] = $message;
        return false;
      } else {
        return true;
      }
    } else {
      $this->errors[] = $message;
      return false;
    }
  }

  /**
  * Limpia la cadena de texto de caracteres no permitidos
  *
  * @param string $string cadena que será limpiada
  * 
  * @return string $string cadena limpia de caracteres no permitidos
  */
  public function cleaningCharacters($string)
  {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);

    return $string;
  }

  /**
  * Verificamos si existen errores o no en las validaciones
  * 
  * @return array $this->errors
  */
  public function isErrors()
  {
    if (count($this->errors) > 0) {
      return $this->errors;
    } else {
      return ;
    }
  }

  /** 
  * Redirecciona al usuario a una vista
  * 
  * @access public
  * @return void
  */
  public static function redirect($url)
  {
    header("Location: " . URL . $url);
  }
}
