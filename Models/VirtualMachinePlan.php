<?php 

namespace Models;
use Config\Database as Database;

/** 
* Administra los planes para las maquinas virtuales, esta clase se encargará de 
* crear, actualizar, eliminar y listar todos los planes para los clientes 
* 
* @package VirtualMachinePlan
* @author Cristhian David García 
*/
class VirtualMachinePlan
{
  /** 
  * Campos de la tabla en la base de datos
  */
  private $id;
  private $name;
  private $processors;
  private $ram;
  private $hardDisk;
  private $price;

  /**
  * Almacena la conexión a la base de datos
  * @var database
  */
  private $database;

  /**
  * Crea el objeto database, el cual tiene la conexión a la base de datos
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
  * Selecciona los vm_plans de la base de datos
  * 
  * @return array 
  */
  public function view()
  {
    $sql  = 'SELECT     a.id, ';
    $sql .= '           a.status, ';
    $sql .= '           a.name, ';
    $sql .= '           a.processors, ';
    $sql .= '           a.ram, ';
    $sql .= '           a.hard_disk, ';
    $sql .= '           a.price ';
    $sql .= 'FROM       vm_plans AS a ';

    if (!empty($this->id)) {
    $sql .= 'WHERE      a.id = :id ';
    }
    $sql .= 'ORDER BY   a.id DESC ';

    $values = ['id' => $this->id];

    $result = $this->database->query($sql, $values);

    return (!empty($result)) ? $result : false;

  }

  /**
  * Agrega VirtualMachinePlans o planes para ofrecer a los usuarios 
  *
  * @return boolean 
  */
  public function add()
  {
    $sql  = 'INSERT INTO  vm_plans (';
    $sql .= '             id, ';
    $sql .= '             name, ';
    $sql .= '             processors, ';
    $sql .= '             ram, ';
    $sql .= '             hard_disk, ';
    $sql .= '             price ';
    $sql .= ') VALUES (';
    $sql .= '             :id, ';
    $sql .= '             :name, ';
    $sql .= '             :processors, ';
    $sql .= '             :ram, ';
    $sql .= '             :hard_disk, ';
    $sql .= '             :price ';
    $sql .= ')';

    $values = [
      'id'              => null, 
      'name'            => $this->name,
      'processors'      => $this->processors, 
      'ram'             => $this->ram, 
      'hard_disk'       => $this->hardDisk, 
      'price'           => $this->price
    ];

    $query = $this->database->query($sql, $values);

    return ($query) ? true : false;
  }
}