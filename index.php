<?php 
require_once("./head.php");

session_start();

if (isset($_GET["logout"]) && $_GET["logout"] == true) {
  $_SESSION = null;
  $_COOKIE["username"] = null;
  setcookie("username", "", time() - 300);
}

$username = (isset($_SESSION)) ? $_SESSION["username"] : ((isset($_COOKIE["username"])) ? $_COOKIE["username"] : "");

// if($username == "") header("Location: ./login.php");

?>
<section class="logged">
  <h1 class="bgText white bold">¡Hola <?php echo $username; ?> !</h1>
  <a href="./index.php?logout=true" class="btn btnThird">Cerrar sesión</a>
</section>

<?php require_once("./footer.php"); ?>