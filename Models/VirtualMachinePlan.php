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
  * Agrega VirtualMachinePlans o planes para ofrecer a los usuarios 
  *
  * @return boolean 
  */
  public function add()
  {
    $sql  = 'INSERT INTO  users (';
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
      'users_types_id'  => $this->name,
      'last_name'       => $this->processors, 
      'email'           => $this->ram, 
      'password'        => $this->hard_disk, 
      'telephone'       => $this->price
    ];

    $query = $this->database->query($sql, $values);

    if ($query) {
      return true;
    } else {
      return false;
    }
  }
}