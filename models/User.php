<?php 
class User{
  private $conexion,$table,$user,$email,$password;

  public function __construct($conexion){
    $this->conexion = $conexion;
    $this->table = "loginphp";
  }

  public function insertUser($datos){
    if(!$this->verifyUsername($datos["username"]) || !$this->verifyEmail($datos["email"])) return -1;

    $query = $this->conexion->prepare("INSERT INTO $this->table (user,email,password) VALUES (?,?,?);");
    $banExecute = $query->execute(array($datos["username"],$datos["email"],password_hash($datos["password"],PASSWORD_DEFAULT)));
    if(!$banExecute) return 0;
    return 1;
  }

  public function getUser($username){
    $query = $this->conexion->prepare("SELECT user,password FROM $this->table WHERE user = ? OR email = ?");
    $banExecute = $query->execute(array($username,$username));
    if(!$banExecute) return false;
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  private function verifyUsername($username){
    $query = $this->conexion->prepare("SELECT count(*) FROM $this->table WHERE user = ?");
    $banExecute = $query->execute(array($username));
    if($query->fetchColumn() > 0 || !$banExecute) return false;
    return true;
  }
  
  private function verifyEmail($email){
    $query = $this->conexion->prepare("SELECT count(*) FROM $this->table WHERE email = ?");
    $banExecute = $query->execute(array($email));
    if($query->fetchColumn() > 0 || !$banExecute) return false;
    return true;
  }
}
?>