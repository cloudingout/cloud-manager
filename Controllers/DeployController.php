<?php

namespace Controllers;
use Models\User as user;
use Models\Plan as Plan;
use Models\Deploy as Deploy;
use Models\Auth\Auth as Auth;
use App\Middlesbrough as Middlesbrough;
use Config\CreateBash as CreateBash;

/**
* Controlador para DeploymentVM
*
* @package DeploymentvmController
* @author Cristhian David García
*/
class DeployController
{
  /**
  * Almacena el objeto Deploy
  * @var $deploy
  */
  private $deploy;

  /**
  * Almacena el objeto User
  * @var $user
  */
  private $user;

  /**
  * Almacena el objeto Plan
  * @var $plan
  */
  private $plan;

  /**
  * Almacena el objeto CreateBash
  * @var $plan
  */
  private $bash;

  /**
  * Constructor - Instancia la clase DeploymentVM
  * 
  * @return void
  */
  public function __construct()
  {
    $this->deploy = new Deploy();
    $this->user = new User();
    $this->plan = new Plan();
    $this->bash = new CreateBash;
  }

  public function index()
  {
    if (Auth::isLoggedIn()) {
      return $this->deploy->view();
    } else {
      Middlesbrough::redirect('errors');
    }

  }

  public function create()
  {
    if (Auth::isLoggedIn()) {

      if (!$_POST) {
        return $this->plan->view();
      } else {
        $this->deploy->set('usersID', $_SESSION['id']);
        $this->deploy->set('name', $_POST['name']);
        $this->deploy->set('VMPlansID', $_POST['vm-plans']);
        $this->deploy->set('expireTime', $_POST['expiry-time']);

        $this->plan->set('id', $_POST['vm-plans']);
        $plan = $this->plan->findPlan();

        $this->bash->start_bash('launch',$this->deploy->get('name'),'ubuntu:16.04', strtolower($plan['name']));

        $this->deploy->add();

        Middlesbrough::redirect('deploy');
      }
    } else {
      Middlesbrough::redirect('errors');
    }

  }
}