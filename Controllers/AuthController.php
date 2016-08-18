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
    if (auth::isLoggedIn()) {
      auth::redirect(URL . "deploymentvm");
    } else {
      if (isset($_POST['login'])) {
        $this->auth->set('email', $_POST['email']);
        $this->auth->set('password', $_POST['password']);

        $authenticate = $this->auth->authenticate();

        if ($authenticate) {
          $this->auth->redirect(URL . "users");
        } else {
          $this->auth->redirect(URL . "errors");
        }
      }
    }
  }

  /**
  * Destruye la sesion del usuario (Cerrar Sesion)
  *
  * @return void
  */
  public function logout()
  {
    auth::logout();
    auth::redirect(URL . "home");
  }
}
