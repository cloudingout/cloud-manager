<?php 

namespace Models;
use Config\Database as Database;

class User 
{
  private $id;
  private $usersType;
  private $name;
  private $lastName;
  private $email;
  private $password;
  private $telephone;
  private $balance;
  private $token;
  private $expirationToken;
  private $database;

  public function __construct()
  {
    $this->database = new Database();
  }

  public function set($attribute, $content)
  {
    $this->$attribute = $content;
  }

  public function get($attribute)
  {
    return $this->$attribute;
  }

  public function auth()
  {
    try {
     $sql = 'SELECT id, email, password FROM users WHERE email = :email AND password = :password ';
      $values = ['email' => $this->email, 'password' => $this->password];

      $result = $this->database->query($sql, $values);

      if (!empty($result)) {
        return $result;
      }

      return false;
      
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function add()
  {
    $sql  = "INSERT INTO  users ( ";
    $sql .= "             id, ";
    $sql .= "             users_types_id, ";
    $sql .= "             name, ";
    $sql .= "             last_name, ";
    $sql .= "             email, ";
    $sql .= "             password, ";
    $sql .= "             telephone ";
    $sql .= ") VALUES( ";
    $sql .= "             null, ";
    $sql .= "             $this->usersType, ";
    $sql .= "             '{$this->name}', ";
    $sql .= "             '{$this->lastName}', ";
    $sql .= "             '{$this->email}', ";
    $sql .= "             '{$this->password}', "; // Encriptar password
    $sql .= "             '{$this->telephone}' ";
    $sql .= ") ";

    $db = $this->database->query($sql, $values = []);

    if (!$db) {
      return false;
    }

    return true;
  }
}
