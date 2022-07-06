<?php 
require_once("./head.php");

$logged = false; 

session_start();
$username = (!empty($_SESSION)) ? $_SESSION["username"] : (!empty($_COOKIE) ? $_COOKIE["username"] : "");

if(isset($_GET["logout"]) && $_GET["logout"] == true){
  $_SESSION["username"] = null;
  setcookie("username","",time()-300);
  $logged = false;
}

if(!empty($_POST)){
  $userInfo = $user->getUser($_POST["username"]);
  print_r($_POST);
  if(password_verify($_POST["password"],$userInfo["password"])){
    $username = $userInfo["user"];
    $_SESSION["username"] = $username;
    $logged = true;
    if(isset($_POST["remember"]) && $_POST["remember"] == true) setcookie("username",$username,time()+300);
  }
}


?>
<main>
  <?php if(isset($_SESSION["username"]) || isset($_COOKIE["username"]) || $logged){ ?>
  <section class="logged">
    <div>
      <h1>¡Hola <?php echo $username; ?> !</h1>
    </div>
    <a href="./index.php?logout=true">Cerrar sesión</a>
  </section>
  <?php }else{ ?>
  <section class="form">
    <div>
      <h1>LOGIN-SESSION-COOKIES-CIFRADO</h1>
    </div>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <div>
        <label for="username">Username or email</label>
        <input type="text" name="username" id="username">
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
      </div>
      <div>
        <label for="remember">Recordarme</label>
        <input type="checkbox" name="remember" id="remember" value="true">
      </div>
      <div>
        <button>Iniciar sesión</button>
      </div>
    </form>
    <hr>
    <div>¿No tienes cuenta? <a href="register.php">Registrate</a></div>
  </section>
  <?php } ?>
</main>

<?php require_once("./footer.php"); ?>
