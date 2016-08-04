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
    $this->vm = new VM();
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
      $this->vm->set('name', $_POST['name']);
      $this->vm->set('processors', $_POST['processors']);
      $this->vm->set('ram', $_POST['ram']);
      $this->vm->set('hardDisk', $_POST['hard-disk']);
      $this->vm->set('price', $_POST['price']);

      $this->vm->add();
    }
  }

}
