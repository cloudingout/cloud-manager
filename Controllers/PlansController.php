<?php

namespace Controllers;
use Models\Plan as Plan;
use Models\Auth\Auth as Auth;
use App\Middlesbrough as Middlesbrough;

/**
* Controlador para VirtualMachinePlan, encargado de recibir y enviar datos tanto 
* a la vista como al modelo
*
* @package VirtualMachinePlanController
* @author Cristian David García
*/
class PlansController
{
  /**
  * Almacena la instancia del módelo Plan
  *
  * @var $plan
  */
  private $plan;

  /**
  * Almacena la instancia del módelo Auth
  * @var $auth
  */
  private $auth;

  /**
  * Recibe los datos del módelo y los envía a la vista del usuario
  * 
  * @return array
  */
  public function index()
  {
    if (Auth::isLoggedIn()) {
      $plans = $this->plan->view();
      return $plans;
    } else {
      Middlesbrough::redirect("errors");
    }
  }

  /** 
  * Constructor - Obtiene el módelo VirtualMachinePlan
  * @return void
  */
  public function __construct()
  {
    $this->plan = new Plan();
    $this->auth = new Auth();

  }

  /** 
  * Recibe los datos enviados a través del formulario y envía los mismos 
  * al módelo
  * 
  * @return void
  */
  public function create()
  {
    if (Auth::isLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $this->plan->set('name', $_POST['name']);
        $this->plan->set('processors', $_POST['processors']);
        $this->plan->set('ram', $_POST['ram']);
        $this->plan->set('hardDisk', $_POST['hard-disk']);
        $this->plan->set('price', $_POST['price']);

        $this->plan->add();
        Middlesbrough::redirect('plans');
      }
    } else {
      Middlesbrough::redirect('errors');
    }

  }

  /**
  * Recibe los datos enviados del formulario, los envía al módelo y este hace 
  * la actualización de los datos del plan_plans
  * 
  * @return void
  */
  public function update($id)
  {
    $this->plan->set('id', (int) $id);

    if (!$_POST) {
      return $this->plan->findPlan();
    } else {
      $this->plan->set('name', $_POST['name']);
      $this->plan->set('processors', $_POST['cpu']);
      $this->plan->set('ram', $_POST['ram']);
      $this->plan->set('hardDisk', $_POST['hard-disk']);
      $this->plan->set('price', $_POST['price']);

      $this->plan->update();
      Middlesbrough::redirect('plans');
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
      $this->plan->set('id', (int) $id);
      $result = $this->plan->findPlan();

      if ($result['status'] === '1') {
        $this->plan->set('status', '2');
        $this->plan->activateOrInactivePlan();
      } else {
        $this->plan->set('status', '1');
        $this->plan->activateOrInactivePlan();
      }
      Middlesbrough::redirect('plans');

    } else {
      Middlesbrough::redirect('errors');
    }
  }

}
