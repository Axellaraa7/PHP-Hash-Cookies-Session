<?php 
class DBConnection{
  private static $instance;
  private $connection,$dbInfo;

  private function __construct(){
    try{
      $this->dbInfo = require_once(__DIR__."/../config.php");
      $this->conexion = new PDO(
        "mysql:host=".$this->dbInfo["host"].
        ";dbname=".$this->dbInfo["dbname"].
        ";charset=".$this->dbInfo["charset"],
        $this->dbInfo["user"],
        $this->dbInfo["psw"]);
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $err){
      echo "Error: ".$err->getMessage();
    }
  }

  public function getConexion(){ return $this->conexion; }

  public static function getInstance(){
    if(!isset(self::$instance)){
      self::$instance = new DBConnection();
    }
    return self::$instance;
  }

  public function __clone(){
    trigger_error("No se permite clonar este objeto ".E_USER_ERROR);
  }
}
?>