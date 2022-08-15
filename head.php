<?php 
require_once("./db/Conexion.php");
require_once("./models/User.php");

$conexion = Conexion::getInstance("pruebasconexion")->getConexion();
$user = new User($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://api.fontshare.com/v2/css?f[]=cabinet-grotesk@1&display=swap" rel="stylesheet"> 
  <?php 
    $scriptName = explode("/",$_SERVER["SCRIPT_NAME"]); 
    $fileName = substr(array_pop($scriptName),0,-4);
  ?>
  <link rel="stylesheet" href="<?php echo "./css/$fileName.css"; ?>">
  <title>LCSC</title>
</head>
<body>
