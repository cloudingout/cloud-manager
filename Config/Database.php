<?php

namespace Config;
use \PDO;

class Database
{
  /**
  * Almacena la conexión a la base de datos
  */
  protected $connection;

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
