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
  * Recibe los datos del módelo y los envía a la vista del usuario
  * 
  * @return array
  */
  public function index()
  {
    return $this->vm->view();
  }

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

  /**
  * Recibe los datos enviados del formulario, los envía al módelo y este hace 
  * la actualización de los datos del vm_plans
  * 
  * @return void
  */
  public function update($id)
  {
    $this->vm->set('id', $id);

    if (!$_POST) {
      return $this->vm->view();
    } else {
      $this->vm->set('name', $_POST['name']);
      $this->vm->set('processors', $_POST['cpu']);
      $this->vm->set('ram', $_POST['ram']);
      $this->vm->set('hardDisk', $_POST['hard-disk']);
      $this->vm->set('price', $_POST['price']);

      $this->vm->update();
      header('Location: ' . URL . 'virtualmachineplan');
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
    $this->vm->set('id', $id);
    $result = $this->vm->view();

    if ($result[0]['status'] === '1') {
      $this->vm->set('status', '2');
      $this->vm->changeStatus();
    } else {
      $this->vm->set('status', '1');
      $this->vm->changeStatus();
    }
      header('Location: ' . URL . 'virtualmachineplan');
  }

}
