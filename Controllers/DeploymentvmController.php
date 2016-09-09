<?php

namespace Controllers;
use Models\DeploymentVM as Deploy;

/**
* Controlador para DeploymentVM
*
* @package DeploymentvmController
* @author Cristhian David García
*/
class DeploymentvmController
{
  /**
  * Almacena el objeto DeploymentVM
  * @var $deploy
  */
  private $deploy;

  /**
  * Constructor - Instancia la clase DeploymentVM
  * 
  * @return void
  */
  public function __construct()
  {
    $this->deploy = new Deploy();
  }

  public function index(){}

  public function create()
  {
    if ($_POST) {
      $this->deploy->set('usersID', $_POST['user-id']);
      $this->deploy->set('VMPlansID', $_POST['vm-plans']);
      $this->deploy->set('expireTime', $_POST['expiry-time']);

      $this->deploy->add();
    }
  }
}