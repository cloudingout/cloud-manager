<?php

namespace Controllers;
use Models\User as User;
use Models\Auth\Auth as Auth;
use App\Middlesbrough as Middlesbrough;

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
  * @var $middlesbrough
  */
  private $middlesbrough;

  /**
  * Constructor - Obtiene los módelos User y Auth
  *
  * @return void
  */
  public function __construct()
  {
    $this->user = new User();
    $this->auth = new Auth();
    $this->middlesbrough = new Middlesbrough();
  }

  /**
  * Recibe los datos enviados a través del formulario
  *
  * @return void
  */
  public function index()
  {
    if (Auth::isLoggedIn()) {
      Middlesbrough::redirect("deploymentvm");
    } else {
      if (isset($_POST['login'])) {
        $this->auth->set('email', $this->middlesbrough->validateEmail($_POST['email']));
        $this->auth->set('password', $_POST['password']);

        $authenticate = $this->auth->authenticate();
        
        if ($authenticate) {
          Middlesbrough::redirect("users");
        } else {
          return $this->middlesbrough->isErrors();
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
    Auth::logout();
    Middlesbrough::redirect("auth");
  }
}
