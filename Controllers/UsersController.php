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
  public function add()
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
}