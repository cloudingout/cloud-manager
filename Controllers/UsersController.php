<?php

namespace Controllers;
use Models\User as User;
use Models\Auth\Auth as Auth;
use App\Middlesbrough as Middlesbrough;
use App\Supermail as Supermail;


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
  * Almacena la instancia del módelo Supermail
  * @var $supermail
  */
  private $supermail;

  /**
  * Constructor - Obtiene el módelo User
  * @return void
  */
  public function __construct()
  {
    $this->user = new User();
    $this->middlesbrough = new Middlesbrough();
    $this->supermail = new Supermail();
  }

  /**
  * Recibe los datos del módelo y los envía a la vista del usuario
  *
  * @return array
  */
  public function index()
  {
    if (Auth::isLoggedIn()) {
      return $this->user->view();
    } else {
      $this->middlesbrough->redirect("errors");
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
          $this->user->set("password", $_POST['password']);

          $create = $this->user->signUp();

          if (empty($this->middlesbrough->isErrors())) {

            if ($create === true) {
              $this->supermail->trust_email($this->user->get('email'),'Registro Exitoso',null,'registro');
              Middlesbrough::redirect("auth");
            } else {

              return $this->user->getStatus();

            }
            
          } else {
            return $this->middlesbrough->isErrors();
          }


        } else {
          $mensaje['no_match_passwords'] = "Las contraseñas no coinciden!";
          return $mensaje;
        }

      } else {
        $mensaje['empty_fields'] = "Por favor complete los campos!";
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
    if (Auth::isLoggedIn()) {
      $this->user->set('id', (int)$id);
      if (!$_POST) {
        return $this->user->findUser();
      } else {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

          if (!empty($_POST['name']) && !empty($_POST['last-name']) && !empty($_POST['email'])) {
            $this->user->set('name', $_POST['name']);
            $this->user->set('lastName', $_POST['last-name']);
            $this->user->set('email', $this->middlesbrough->validateEmail($_POST['email']));

            $errors = $this->middlesbrough->isErrors();

            if (count($errors) > 0) {
              return $errors;
            } else {
              $this->user->update();
              Middlesbrough::redirect('users');
            }
          } else {
            $mensaje[] = 'Por favor complete los campos!';
            return $mensaje;
          }
        }
      }
    } else {
      Middlesbrough::redirect('errors');
    }
  }

  /**
  * Recibe los datos enviados a través de la URL y se los envía al modelo, el
  * cual se encargará de poner al usuario en estado inactivo o bloqueado.
  *
  * @return void
  */
  public function edit($id)
  {
    if (Auth::isLoggedIn()) {

      $this->user->set('id', (int) $id);
      $result = $this->user->findUser();

      if ($result['status'] == '1') {
        $this->user->set('status', '2');
        $this->user->ActivateOrInactivate();
      } else {
        $this->user->set('status', '1');
        $this->user->ActivateOrInactivate();
      }
      Middlesbrough::redirect('users');

    } else {
      Middlesbrough::redirect('errors');
    }
  }
}
