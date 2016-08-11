<?php
namespace Models\Auth;
use Config\Database as Database;
use \Exception;
use \DateTime;
use \PDO;
session_start();

/** 
* Autenticación de usuarios: contiene métodos y lógica necesaria para autenticar 
* usuarios
*
* @package Auth
* @author Cristhian David García
*/
class Auth extends Database implements IAuth 
{
  /**
  * Almacena la instancia de la clase Database
  * @var $database
  */
  private $database;

  /**
  * Almacena el email del usuario, enviado por el form 
  * 
  * @var string $email
  */
  private $email;

  /**
  * Almacena el password del usuario, enviado por el form
  * @var string $password
  */
  private $password;

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
  * Actualiza el token y expiration_token cuando el usuario este autenticado 
  * 
  * @param $user usuario al cual se le actualizará el token y el expiration_token
  * @return void
  */
  public function authenticate()
  {
    try {
      $sql  = "SELECT id, "; 
      $sql .= "       name, ";
      $sql .= "       last_name, ";
      $sql .= "       email, ";
      $sql .= "       password ";
      $sql .= "FROM   users ";
      $sql .= "WHERE  email = :email ";
      $sql .= "AND    password = :password ";

      $values = [
        'email'     => $this->email, 
        'password'  => $this->password
      ];

      $user = $this->database->query($sql, $values);

      if (count($user) > 0) {

        if ($this->checkCredentials($this->email, $user[0]['email'], $this->password, $user[0]['password'])) {
          $_SESSION['user_id'] = $user[0]['id'];
          $_SESSION['user'] = $user[0]['name'];

          return true;
        } else {
          return false;
        }

      }

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  /** 
  * Verifica si las credenciales del usuario que intenta ingresar coinciden 
  * con los datos registrados 
  *
  * @access private
  * @return boolean
  */
  private function checkCredentials($uemail, $dbemail, $upassword, $dbpassword)
  {
    return $uemail == $dbemail && $upassword == $dbpassword;
  }

  /**
  * Verifica si el usuario esta logeado o no
  *
  * @access public
  * @return boolean 
  */
  public function isLoggedIn()
  {
    if (isset($_SESSION['user'])) {
      return true;
    } else {
      return false;
    }
  }

  /** 
  * Redirecciona al usuario a una vista
  * 
  * @access public
  * @return void
  */
  public function redirect($url)
  {
    header("Location: $url");
  }

  /**
  * Cierra la sesión del usuario
  * 
  * @access public
  * @return boolean
  */
  public function logout()
  {
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['user']);
    return true;
  }

}
