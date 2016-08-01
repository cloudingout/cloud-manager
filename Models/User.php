<?php 

namespace Models;
use Config\Database as Database;

/**
* Administración de usuarios; creación, eliminación, actualización y lectura 
* de usuarios
*
* @package User
* @author Cristhian David García
*/
class user
{
  /**
  * Campos de la base datos
  */
  private $id; 
  private $usersType;
  private $name;
  private $lastName;
  private $email;
  private $password;
  private $telephone;
  private $balance;
  private $token;
  private $expirationToken;

  /**
  * Almacena la conexión a la base de datos
  * @var database
  */
  private $database;

  /**
  * Crea el objeto database, el cual tiene la conexión a la base de datos
  *
  * @return void
  */
  public function __construct()
  {
    $this->database = new Database();
  }

  /**
  * Asigna valor al atributo de la clase dado por el parámetro $content
  *
  * @param $attribute hace referencia al atributo de la clase
  * @param $content hace referencia al contenido que se le asignará a el atributo 
  *        seleccionado
  *
  * @return void
  */
  public function set($attribute, $content)
  {
    $this->$attribute = $content;
  }

  /**
  * Obtiene el atributo de la clase
  *
  * @param $attribute atributo de la clase
  * @return void
  */
  public function get($attribute)
  {
    return $this->$attribute;
  }

  /** 
  * Autentica al usuario 
  *
  * @return boolean
  */
  public function auth()
  {
    $sql = 'SELECT id, email, password FROM users WHERE email = :email AND password = :password ';
    $values = ['email' => $this->email, 'password' => $this->password];

    $result = $this->database->query($sql, $values);

    if (!$result) {
      return ;
    } else {
      return $result;
    }

  }
}
