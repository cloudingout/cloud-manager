<?php
namespace Models\Auth;
use Config\Database as Database;
use \Exception;
use \DateInterval;
use \DateTime;

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
  * Agrega una hora a la hora actual, para saber el tiempo de expiración de la 
  * sesión
  *
  * @var $expirationTime
  */
  private $expirationTime = 'PT1H';

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
  * Actualiza el token y expiration_token cuando el usuario este autenticado 
  * 
  * @param $user usuario al cual se le actualizará el token y el expiration_token
  * @return void
  */
  public function authenticate($user)
  {
    $user = $user[0];

    if (empty($user)) {
      return false;
    } elseif (empty($user['id'])) {
      return false;
    }

    $date = new DateTime();
    $date->add(new DateInterval($this->expirationTime));

    try {
      $sql  = 'UPDATE users ';
      $sql .= 'SET    token = :token, ';
      $sql .= '       expiration_token = :expiration_token ';
      $sql .= 'WHERE  id = :id ';

      $token = $this->tokenUser();
      $expirationToken = $date->format('Y-m-d h:i:s');

      $values = ['token' => $token, 'expiration_token' => $expirationToken, 'id' => $user['id']];

      $result = $this->database->query($sql, $values);

      if ($result) {
        return true;
      } else {
        return false;
      }

    } catch (Exception $e) {

      return $e->getMessage();
      die();
    }
  }

  /**
  * Comprueba la autenticación del usuario
  * 
  * @return void
  */
  public function isAuthenticate()
  {
    $sql = 'SELECT * FROM users WHERE token = :token ';
    $values = ['token' => $this->tokenUser()];

    $result = $this->database->query($sql, $values);

    if (!$result) {
      throw new Exception('El usuario no esta autenticado');
    }

    $expirationToken = new DateTime($result['expiration_token']);
    $date = new DateTime();

    if ($expirationToken < $date) {
      $this->destroy();
      throw new Exception('El usuario no esta autenticado');
    }
  }

  /**
  * Actualiza los campos token, expiration_token dejandolos en null
  *
  * @return void
  */
  public function destroy()
  {
    $this->isAuthenticate();

    $sql  = 'UPDATE users ';
    $sql .= 'SET    token = null, ';
    $sql .= '       expiration_token = null ';
    $sql .= 'WHERE  token = :token ';

    $values = ['token'  => $this->tokenUser()];
    $this->pdo->query($sql, $values);
  }

  /**
  * Identifica el usuario logeado, a través del token
  *
  * @return $result array datos correspondiente al usuario logeado
  */
  public function user()
  {
    $this->isAuthenticate();

    $sql = 'SELECT * FROM users WHERE token = :token';
    $values = ['token'  => $this->tokenUser()];
    $result = $this->pdo->query($sql, $values);

    return $result;
  }

  /**
  * Genera el token para el usuario
  * 
  * @return string token generado
  */
  public function tokenUser()
  {
    $token = __SECRET_KEY__;

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $token .= $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $token .= $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $token .= $_SERVER['REMOTE_ADDR'];
    }

    $token .= $_SERVER['HTTP_USER_AGENT'];
    $token .= gethostname();

    return sha1($token);
  }

}
