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
    $user = ($this->verifyUsername($username) || $this->verifyEmail($username)) ? true : false;
    $banExecute = false;
    if($user){
      $query = $this->conexion->prepare("SELECT user,password FROM $this->table WHERE user = ? OR email = ?");
      $banExecute = $query->execute(array($username,$username));
    }
    return ($user && $banExecute) ? $query->fetch(PDO::FETCH_ASSOC) : $user;
  }

  private function verifyUsername($username){
    $query = $this->conexion->prepare("SELECT count(*) FROM $this->table WHERE user = ?");
    $banExecute = $query->execute(array($username));
    return ($query->fetchColumn() > 0 || !$banExecute) ? false : true;
  }
  
  private function verifyEmail($email){
    $query = $this->conexion->prepare("SELECT count(*) FROM $this->table WHERE email = ?");
    $banExecute = $query->execute(array($email));
    return ($query->fetchColumn() > 0 || !$banExecute) ? false : true;
  }
}
?>