<?php 

namespace Controllers;
use Models\User as user;
use Models\Auth\Auth as auth;
use \Exception;

/**
* Controlador para el modelo Auth, se encarga de recibir los datos que serán 
* enviados al modelo
*
* @package Controllers
* @author Cristhian David García
*/
class AuthController
{
  /**
  * Almacena la instancia del módelo User
  * @var $user
  */
  private $user;
  /**
  * Almacena la instancia del módelo Auth
  * @var $auth
  */
  private $auth;

  /**
  * Constructor - Obtiene los módelos User y Auth
  *
  * @return void
  */
  public function __construct()
  {
    $this->user = new User();
    $this->auth = new Auth();
  }

  /**
  * Recibe los datos enviados a través del formulario
  * 
  * @return void
  */
  public function index()
  {
    if ($_POST) {
      $this->user->set('email', $_POST['email']);
      $this->user->set('password', $_POST['password']);

      $result = $this->auth->authenticate($this->user->auth());
      
      if (!empty($result)) {
        echo 'Falso';
      } else {
        echo 'Autentico';
      }
    }
  }
}