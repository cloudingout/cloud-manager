<?php

namespace Config;
use \PDO;

/** 
* Archivo de conexión a la base de datos, se conecta a la base de datos, y realiza 
* y consultas a través del método query
*
* @package database
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
    if (!$settings = include 'config.php') throw new Exception("Error Processing Request");
    
      $driver     = $settings['connections']['mysql']['driver'];
      $host       = $settings['connections']['mysql']['host'];
      $database   = $settings['connections']['mysql']['database'];
      $port       = $settings['connections']['mysql']['port'];
      $password   = $settings['connections']['mysql']['password'];
      $username   = $settings['connections']['mysql']['username'];
      $charset    = $settings['connections']['mysql']['charset'];

      try {
        return $this->connection = new PDO(
                                        "mysql:host$host;
                                        port=$port;
                                        dbname=$database",
                                        $username,
                                        $password, [
                                          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset"
                                        ]);
      } catch (PDOException $e) {
        echo 'Error, no se puede conectar a la base de datos ' . $e->getMessage();
      }
  }

  /**
  * Consultas a la base de datos(INSERT, SELECT, UPDATE & DELETE)
  *
  * @param $queryString - string: almacena el string SQL - requerido
  * @param $values - array - Valores necesarios en caso de ser necesario, puede 
  *        estar vacío o no dependiendo de la condición de $queryString
  *
  * @return $result - array || boolean
  */
  public function query($queryString, $values = [])
  {
    $result = false;
    
    if ($statement = $this->connect()->prepare($queryString)) {

      $preg = preg_match_all("/(:\w+)/", $queryString, $fields);

      if ($preg) {
        $fields = array_pop($fields);

        foreach ($fields as $field) {
          $statement->bindValue($field, $values[substr($field, 1)]);
        }
      }

      try {

        if (!$statement->execute()) {
          print_r($statement->errorInfo());
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

      } catch (PDOException $e) {
        echo 'Error en la ejecución: ' .$e->getMessage();
      }
    }
    
    return $result;
  }

}
