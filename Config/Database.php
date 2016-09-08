<?php

namespace Config;
use \PDO;

/** 
* Archivo de conexión a la base de datos, se conecta a la base de datos, y realiza 
* y consultas a través del método query
*
* @package Database
* @author Cristhian David García
*/
class Database
{
  /**
  * Almacena la conexión a la base de datos
  * @var $connection
  */
  protected $connection;

  /** 
  * Conexión a la base de datos
  * 
  * @return pdoObject: Conexión a la base de datos
  */
  protected function connect()
  {
    if (!$settings = include 'Config.php') throw new Exception("Error Processing Request");
    
      $driver     = $settings['connections']['mysql']['driver'];
      $host       = $settings['connections']['mysql']['host'];
      $database   = $settings['connections']['mysql']['database'];
      $port       = $settings['connections']['mysql']['port'];
      $password   = $settings['connections']['mysql']['password'];
      $username   = $settings['connections']['mysql']['username'];
      $charset    = $settings['connections']['mysql']['charset'];

      try {
        return $this->connection = new PDO(
                                        "$driver:host=$host;
                                        port=$port;
                                        dbname=$database",
                                        $username,
                                        $password,
                                        array(
                                          PDO::MYSQL_ATTR_INIT_COMMAND  => "SET NAMES $charset"
                                          )
                                        );
      } catch (PDOException $e) {
        die('Error, no se puede conectar a la base de datos ' . $e->getMessage());
      }
  }

  /**
  * Obtiene la conexión a la base de datos
  *
  */
  public function getConnection()
  {
    return $this->connect();
  }
}
