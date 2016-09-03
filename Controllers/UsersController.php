<?php

namespace Controllers;
use Models\User as user;
use Models\Auth\Auth as auth;
use App\Middlesbrough as middlesbrough;

/**
* Controlador para usuarios
*
* @package UsersController
* @author Cristian David García
*/
class UsersController
{
  /**
  * Almacena la instancia del módelo User
  *
  * @var $user
  */
  private $user;

  /**
  * 
  */
  private $middlesbrough;

  /**
  * Constructor - Obtiene el módelo User
  * @return void
  */
  public function __construct()
  {
    $this->user = new User();
    $this->middlesbrough = new Middlesbrough();
  }

  /**
  * Recibe los datos del módelo y los envía a la vista del usuario
  *
  * @return array
  */
  public function index()
  {
    if (auth::isLoggedIn()) {
      return $this->user->view();
    } else {
      $this->middlesbrough->redirect(URL . "errors");
    }

  }

  /**
  * Recibe los datos enviados a través del formulario y envía los mismos
  * al módelo
  *
  * @return void
  */
  public function signUp()
  {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {
        if ($_POST['confirm-password'] == $_POST['password']) {
          $this->user->set("email", $this->middlesbrough->validateEmail($_POST['email']));
          $this->user->set("password", $this->middlesbrough->validateText($_POST['password'], 1, 12, false, true, true));

          $create = $this->user->signUp();
          
          if ($create === true) {
            $this->middlesbrough->redirect(URL . "auth");
          } else {
            return $this->user->getStatus();
          }
        } else {
          $mensaje[] = "Las contraseñas no coinciden!";
          return $mensaje;
        }
      } else {
        $mensaje[] = "Por favor complete los campos";
        return $mensaje;
      }

    }
  }

  /**
  * Recibe los datos enviados del formulario, los envía al módelo y este hace
  * la actualización de los datos del usuario
  *
  * @return void
  */
  public function update($id)
  {
    if (!$_POST) {
      $this->user->set('id', $id);
      return $this->user->view();
    } else {
      $this->user->set('id', $id);
      $this->user->set('name', $_POST['name']);
      $this->user->set('lastName', $_POST['last-name']);
      $this->user->set('email', $_POST['email']);

      $this->user->update();
      $this->middlesbrough->redirect(URL . "users");
    }
  }

  /**
  * Recibe los datos enviados a través de la URL y se los envía al modelo, el
  * cual se encargará de poner al usuario en estado inactivo o bloqueado.
  *
  * @return void
  */
  public function changeStatus($id)
  {
    $this->user->set('id', $id);
    $result = $this->user->view();

    if ($result[0]['status'] == '1') {
      $this->user->set('status', '2');
      $this->user->changeStatus();
    } else {
      $this->user->set('status', '1');
      $this->user->changeStatus();
    }
      $this->middlesbrough->redirect(URL . 'users');
  }
}
