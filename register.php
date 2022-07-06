<?php 
require_once("./head.php");

if(!empty($_POST)){
  $ban = $user->insertUser($_POST);
  if($ban === -1) $alert = "El nombre de usuario o el email no están disponibles";
  else if($ban === 0) $alert = "Ocurrió un error al ingresar el usuario";
  else{
    header("Location: ./index.php");
    session_start();
    $_SESSION["username"] = $_POST["username"];
  }
}
?>
<main>
  <div>
    <h2>Registro de usuario</h2>
  </div>
  <section class="form">
    <?php if(isset($ban) && $ban <= 0){?> 
      <div class="alert">
        <?php echo $alert ?>
      </div>
    <?php } ?>
    <form action="" method="post">
      <div><label for="username">Ingresa un usuario</label><input type="text" name="username" id="username"></div>
      <div><label for="email">Ingresa un email</label><input type="email" name="email" id="email"></div>
      <div><label for="password">Password</label><input type="password" name="password" id="password"></div>
      <div><label for="confirmPassword">Confirma tu Password</label><input type="password" name="confirmPassword" id="confirmPassword"></div>
      <div><button>Registrar</button></div>
    </form>
  </section>
</main>


<?php require_once("./footer.php"); ?>