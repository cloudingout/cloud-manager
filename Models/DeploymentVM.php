<?php

namespace Models;
use Config\Database as Database;
/**
* Clase encargada de realizar el despliegue de las maquinas virtuales
*
* @package DeploymentVM
* @author Cristhian David García
*/

class DeploymentVM
{
  /**
  * Campos de la tabla deployment_vm
  */
  private $id;
  private $usersID;
  private $VMPlansID;
  private $name;
  private $processors;
  private $ram;
  private $hardDisk;
  private $expireTime;

  /**
  * Almacena la conexión a la base de datos
  * 
  * @var $database
  */
  private $database;

  /**
  * Constructor - Instancía la clase Database
  *
  * @return void
  */
  public function __construct()
  {
    $this->database = new Database();
  }

  /**
  * Creación o despliegue de una maquina virtual en la base de datos
  *
  *
  * @return boolean
  */
  public function add()
  {
    $sql  = 'INSERT INTO  deployment_vm( ';
    $sql .= '             id, ';
    $sql .= '             users_id, ';
    $sql .= '             vm_plans_id, ';
    $sql .= '             name, ';
    $sql .= '             processors, ';
    $sql .= '             ram, ';
    $sql .= '             hard_disk, ';
    $sql .= '             expiry_time ';
    $sql .= ') VALUES ( ';
    $sql .= '             :id, ';
    $sql .= '             :users_id, ';
    $sql .= '             :vm_plans_id, ';
    $sql .= '             :name, ';
    $sql .= '             :processors, ';
    $sql .= '             :ram, ';
    $sql .= '             :hard_disk, ';
    $sql .= '             :expiry_time ';
    $sql .= ')';

    $values = [
      'id'          => $this->id, 
      'users_id'    => $this->usersID, 
      'vm_plans_id' => $this->VMPlansID, 
      'name'        => $this->name, 
      'processors'  => $this->processors, 
      'ram'         => $this->ram, 
      'hard_disk'   => $this->hardDisk, 
      'expiry_time' => $this->expireTime
    ];

    $result = $this->database->query($sql, $values);

    return (!empty($result)) ? $result : false;
  }

}