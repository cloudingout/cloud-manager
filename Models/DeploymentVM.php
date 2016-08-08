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
  * Asigna valor al atributo de la clase dado por el parámetro $content
  *
  * @param $attribute hace referencia al atributo de la clase
  * @param $content hace referencia al contenido que se le asignará a el atributo 
  *        seleccionado
  *
  * @return void
  */
  public function set($attribute, $content)
  {
    $this->$attribute = $content;
  }

  /**
  * Obtiene el atributo de la clase
  *
  * @param $attribute atributo de la clase
  * @return void
  */
  public function get($attribute)
  {
    return $this->$attribute;
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
    $sql .= '             expiry_time ';
    $sql .= ') VALUES ( ';
    $sql .= '             :id, ';
    $sql .= '             :users_id, ';
    $sql .= '             :vm_plans_id, ';
    $sql .= '             :expiry_time ';
    $sql .= ')';

    $values = [
      'id'          => $this->id, 
      'users_id'    => $this->usersID, 
      'vm_plans_id' => $this->VMPlansID, 
      'expiry_time' => $this->expireTime
    ];

    $result = $this->database->query($sql, $values);

    return ($result) ? true : false;
  }

}