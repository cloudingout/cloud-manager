<?php

namespace Controllers;
use Models\User as user;

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
    return $this->user->view();
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
      $this->user->set('usersType', $_POST['user-type']);
      $this->user->set('name', $_POST['name']);
      $this->user->set('lastName', $_POST['last-name']);
      $this->user->set('email', $_POST['email']);
      $this->user->set('password', $_POST['password']);
      $this->user->set('telephone', $_POST['telephone']);

      $this->user->add();
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
