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
  private $status;
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
    $sql = 'SELECT id, name, last_name, email, password FROM users WHERE email = :email AND password = :password ';
    $values = [
      'email'     => $this->email, 
      'password'  => $this->password
    ];

    $result = $this->database->query($sql, $values);

    if (!empty($result)) {
      $_SESSION['id']         = $result[0]['id'];
      $_SESSION['name']       = $result[0]['name'];
      $_SESSION['last_name']  = $result[0]['last_name'];
      return $result;

    } else {
      return ;
      die();
    }
  }

  /**
  * Selecciona los usuarios de la base de datos
  * 
  * @return array 
  */
  public function view()
  {
    $sql  = 'SELECT     a.id, ';
    $sql .= '           b.name AS user_type, ';
    $sql .= '           a.status, ';
    $sql .= '           a.name, ';
    $sql .= '           a.last_name, ';
    $sql .= '           a.email, ';
    $sql .= '           a.balance ';
    $sql .= 'FROM       users AS a ';
    $sql .= 'LEFT JOIN  users_types as b ON(b.id = a.users_types_id) ';

    if (!empty($this->id)) {
    $sql .= 'WHERE      a.id = :id ';
    }
    $sql .= 'ORDER BY   a.id DESC ';

    $values = ['id' => $this->id];

    $result = $this->database->query($sql, $values);

    return (!empty($result)) ? $result : false;

  }

  /**
  * Agrega usuarios 
  *
  * @return boolean 
  */
  public function signUp()
  {
    $sql  = 'INSERT INTO  users (';
    $sql .= '             id, ';
    $sql .= '             email, ';
    $sql .= '             password ';
    $sql .= ') VALUES (';
    $sql .= '             :id, ';
    $sql .= '             :email, ';
    $sql .= '             :password '; // encriptar password
    $sql .= ')';

    $values = [
      'id'              => null, 
      'email'           => $this->email, 
      'password'        => $this->password
    ];

    $query = $this->database->query($sql, $values);

    return ($query) ? true : false;
  }

  /**
  * Actualización de datos de los usuarios
  * 
  * @return boolean
  */
  public function update()
  {
    $sql  = 'UPDATE users ';
    $sql .= 'SET    name = :name, ';
    $sql .= '       last_name = :last_name, ';
    $sql .= '       email = :email, ';
    $sql .= '       telephone = :telephone, ';
    $sql .= '       update_at = NOW() ';
    $sql .= 'WHERE  id = :id ';

    $values = [
      'name'      => $this->name, 
      'last_name' => $this->lastName, 
      'email'     => $this->email, 
      'telephone' => $this->telephone, 
      'id'        => $this->id, 
      'status'    => $this->status 
    ];

    $result = $this->database->query($sql, $values);

    return $result ? true : false;
  }

  /**
  * Cambiar estado del usuario
  * 
  * @return boolean
  */
  public function changeStatus()
  {
    $sql  = 'UPDATE users ';
    $sql .= 'SET    status = :status, ';
    $sql .= '       update_at = NOW() ';
    $sql .= 'WHERE  id = :id ';

    $values = [
      'status' => $this->status, 
      'id'     => $this->id
    ];

    $result = $this->database->query($sql, $values);

    return $result ? true : false;
  }
}
