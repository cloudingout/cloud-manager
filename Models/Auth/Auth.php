<?php
namespace Models\Auth;
use Config\Database as Database;
use App\Middlesbrough as Middlesbrough;
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
  protected $database;

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
  * @var object $middlesbrough objeto de la clase Middlesbrough
  */
  protected $middlesbrough;

  /**
  * @var object $user datos correspondientes al usuario
  */
  protected $user;

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
      $sql .= "       email ";
      $sql .= "FROM   users ";
      $sql .= "WHERE  email = '$this->email' ";

      $statement = $this->database->getConnection()
                                  ->query($sql)
                                  ->fetch(PDO::FETCH_ASSOC);

      if (password_verify($this->password, $this->getDBPassword()['password']) ){
        $_SESSION['id'] = $statement['id'];
        $_SESSION['name'] = $statement['name'];
        $_SESSION['last_name'] = $statement['last_name'];
        $_SESSION['email'] = $statement['email'];
        
        return true;
      } else {
        return false;
      }

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  protected function getDBPassword()
  {
    $sql  = "SELECT password FROM users WHERE email = :email ";

    $connect = $this->database->getConnection();
    $statement = $connect->prepare($sql);
    if ($statement->execute([':email' => $this->email])) {
      return $statement->fetch(PDO::FETCH_ASSOC);
    }
  }

  /**
  * Verifica si el usuario esta logeado o no
  *
  * @access public
  * @return boolean 
  */
  public function isLoggedIn()
  {
    if (isset($_SESSION['id'])) {
      return true;
    } else {
      return false;
    }
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
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['email']);
  }

}
