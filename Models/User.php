<?php 

namespace Models;
use Config\Database as Database;
use App\Middlesbrough as Middlesbrough;
use \PDO;

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
  public $name;
  public $lastName;
  public $email;
  protected $password;
  private $balance;
  private $token;
  private $expirationToken;

  /**
  * @var array $errors 
  */
  private $errors;

  /**
  * Almacena la conexión a la base de datos
  * @var database
  */
  protected $database;

  /**
  * @var object $middlesbroug almacena la clase helper
  */
  protected $middlesbrough;

  /**
  * Crea el objeto database, el cual tiene la conexión a la base de datos
  *
  * @return void
  */
  public function __construct()
  {
    $this->database = new Database();
    $this->middlesbrough = new Middlesbrough();
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
    $sql  = 'SELECT id, ';
    $sql .= '       name, ';
    $sql .= '       last_name, ';
    $sql .= '       email, ';
    $sql .= '       password ';
    $sql .= 'FROM   users ';
    $sql .= 'WHERE  email = :email ';
    $sql .= 'AND    password = :password ';

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
      return;
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

    $result = $this->database->query($sql, $values)->fetchAll(PDO::FETCH_ASSOC);

    return (!empty($result)) ? $result : false;
  }

  /**
  * Comprueba la existencia de un usuario 
  * 
  * @return boolean
  */
  public function isThereaUser()
  {
    $sql  = 'SELECT id, ';
    $sql .= '       name, ';
    $sql .= '       email ';
    $sql .= 'FROM   users ';
    $sql .= 'WHERE  email = :email ';

    $values = ['email' => $this->email];

    $isThereaUser = $this->database->query($sql, $values);

    if ($isThereaUser->rowCount() > 0) {
      return true;
    } else {
      return false;
    }

  }

  /**
  * Agrega usuarios 
  *
  * @return boolean 
  */
  public function signUp()
  {
    if (!$this->isThereaUser()) {
      $sql  = 'INSERT INTO  users (';
      $sql .= '             id, ';
      $sql .= '             email, ';
      $sql .= '             password ';
      $sql .= ') VALUES (';
      $sql .= '             :id, ';
      $sql .= '             :email, ';
      $sql .= '             :password '; 
      $sql .= ')';

      $values = [
        'id'              => null, 
        'email'           => $this->email, 
        'password'        => $this->middlesbrough->encrypt($this->password)
      ];

      $query = $this->database->query($sql, $values);

      if (is_object($query)) {
        return true;
      } else {
        return false;
      }

    } else {
      $this->errors[] = "El correo ya esta en uso!";
      return false;
    }
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
    $sql .= '       update_at = NOW() ';
    $sql .= 'WHERE  id = :id ';

    $values = [
      'name'      => $this->name, 
      'last_name' => $this->lastName, 
      'email'     => $this->email,  
      'id'        => $this->id
    ];

    $result = $this->database->query($sql, $values);

    if (is_object($result)) {
      return true;
    } else {
      return false;
    }
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

    $result = $this->database->query($sql, $values)->execute();
    return $result ? true : false;
  }

  /**
  * Obtiene el estado de los errores 
  * 
  * @return array || boolean 
  */
  public function getStatus()
  {
    if (count($this->errors) > 0) {
      return $this->errors;
    } else {
      return ;
    }
  }
}
