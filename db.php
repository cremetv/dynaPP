<?php

class DB {
  private $host = "localhost";
  private $db_name = "erapid";
  private $user = "root";
  private $password = "";
  public $conn;

  protected static $con;

  private function __construct() {
    try {
      self::$con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
      self::$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      self::$con->setAttribute( PDO::ATTR_PERSISTENT, false );
    } catch (PDOException $e) {
      echo 'Could not connect to database';
      exit;
    }
  }

  public static function getConnection() {

    if(!self::$con) {
      new DB();
    }

    return self::$con;

  }
}

?>
