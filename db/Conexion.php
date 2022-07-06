<?php 
class Conexion{
  private static $instance;
  private $conexion;

  private function __construct($dbname){
    try{
      $this->conexion = new PDO("mysql:host=localhost;dbname=$dbname;charset=UTF8","root","");
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $err){
      echo "Error: ".$err->getMessage();
    }
  }

  public function getConexion(){ return $this->conexion; }

  public static function getInstance($dbname){
    if(!isset(self::$instance)){
      self::$instance = new Conexion($dbname);
    }
    return self::$instance;
  }

  public function __clone(){
    trigger_error("No se permite clonar este objeto ".E_USER_ERROR);
  }
}
?>