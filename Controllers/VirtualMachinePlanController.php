<?php

namespace Controllers;
use Models\VirtualMachinePlan as VM;

/**
* Controlador para VirtualMachinePlan, encargado de recibir y enviar datos tanto 
* a la vista como al modelo
*
* @package VirtualMachinePlanController
* @author Cristian David García
*/
class VirtualMachinePlanController
{
  /**
  * Almacena la instancia del módelo VirtualMachinePlan
  *
  * @var $vm
  */
  private $vm;

  /** 
  * Constructor - Obtiene el módelo VirtualMachinePlan
  * @return void
  */
  public function __construct()
  {
    $this->user = new VirtualMachinePlan();
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
      $this->user->set('name', $_POST['name']);
      $this->user->set('processors', $_POST['processors']);
      $this->user->set('ram', $_POST['ram']);
      $this->user->set('hardDisk', $_POST['hard-disk']);
      $this->user->set('price', $_POST['price']);

      $this->user->add();
    }
  }

}
