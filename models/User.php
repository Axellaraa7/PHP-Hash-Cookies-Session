<?php 
class User{
  private $conexion,$table;

  public function __construct($conexion){
    $this->conexion = $conexion;
    $this->table = "users";
  }

  public function insertUser($datos){
    $arr = explode("-",$datos["dial"]);
    $datos["country"] = $arr[0];
    $datos["dial"] = $arr[1];

    if($this->existPhone($datos["phone"]) || $this->existEmail($datos["email"])) return -1;

    $query = $this->conexion->prepare("INSERT INTO $this->table (user,email,country,dial,phone,password) VALUES (?,?,?,?,?,?);");
    $banExecute = $query->execute(array($datos["username"],$datos["email"],$datos["country"],$datos["dial"],$datos["phone"],password_hash($datos["password"],PASSWORD_DEFAULT)));
    
    if(!$banExecute) return 0;
    return 1;
  }

  public function getUser($username){
    if(!$this->existPhone($username) && !$this->existEmail($username)) return false;

    $query = $this->conexion->prepare("SELECT user,password FROM $this->table WHERE phone = ? OR email = ?");
    return ($query->execute(array($username,$username))) ? $query->fetch(PDO::FETCH_ASSOC) : false;
  }

  private function existPhone($phone){
    $query = $this->conexion->prepare("SELECT count(*) FROM $this->table WHERE phone = ?");
    $banExecute = $query->execute(array($phone));
    return ($query->fetchColumn() > 0 && $banExecute) ? true : false;
  }
  
  private function existEmail($email){
    $query = $this->conexion->prepare("SELECT count(*) FROM $this->table WHERE email = ?");
    $banExecute = $query->execute(array($email));
    return ($query->fetchColumn() > 0 && $banExecute) ? true : false;
  }
}
?>