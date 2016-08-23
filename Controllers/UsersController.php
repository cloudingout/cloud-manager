<?php

namespace Controllers;
use Models\User as user;
use Models\Auth\Auth as auth;

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
  * Constructor - Obtiene el módelo User
  * @return void
  */
  public function __construct()
  {
    $this->user = new User();
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
      auth::redirect(URL . "errors");
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
    if ($_POST) {
      $this->user->set('email', $_POST['email']);
      $this->user->set('password', $_POST['password']);

      if ($_POST['confirm-password'] == $_POST['password']) {
        $to = $_POST['email'];
        $subject = 'Confirmar registro';
        $message = "Usted se ha registrado satisfactoriamente";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: www@server3.metin2renacer.com' . \r\n";

        $mail = mail($to, $subject, $message, $headers);

        if ($mail) {
          echo 'exito';
        } else {
          echo 'ni fuck';
        }
        $this->user->signUp();
      } else {
        echo 'Las contraseñas no son iguales';
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
      $this->user->set('telephone', $_POST['telephone']);

      $this->user->update();
      header('Location: ' . URL . 'users');
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

    if ($result[0]['status'] === '1') {
      $this->user->set('status', '2');
      $this->user->changeStatus();
    } else {
      $this->user->set('status', '1');
      $this->user->changeStatus();
    }
      header('Location: ' . URL . 'users');
  }
}
