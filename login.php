<?php
require_once("./head.php");

session_start();

if(!empty($_POST)){

  if(isset($_POST["login"])){
    $userInfo = $user->getUser($_POST["username"]);
    if(!$userInfo) $alert = "La contraseña o el usuario no coinciden";
    else{
      if (password_verify($_POST["password"], $userInfo["password"])) {
        $username = $userInfo["user"];
        $_SESSION["username"] = $username;
        $_SESSION["logged"] = 1;
        if (isset($_POST["remember"]) && $_POST["remember"] == true) setcookie("username", $username, time() + 300);
        header("Location: ./index.php");
      }
    }
  }

  if(isset($_POST["signup"])){
    $ban = $user->insertUser($_POST);
    if($ban === -1) $alert = "El nombre de usuario o el email no están disponibles";
    else if($ban === 0) $alert = "Ocurrió un error al ingresar el usuario";
    else{
      $_SESSION["username"] = $_POST["username"];
      $_SESSION["logged"] = 1;
      header("Location: ./index.php");
    }
  }
}

?>
<header>
  <h1 class="bgsText white ">LOGIN-SESSION-COOKIES-CIFRADO</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="loginContainer" id="formLogin">
    <div class="ilContainerCol loginInput">
      <label for="username" class="smText white">Username or email</label>
      <input type="text" name="username" id="username" class="inputText">
    </div>
    <div class="ilContainerCol loginInput">
      <label for="password" class="smText white">Password</label>
      <input type="password" name="password" id="password" class="inputText">
    </div>
    <div class="ilContainerCol loginInput">
      <label for="remember" class="smText white">Remember me</label>
      <input type="checkbox" name="remember" id="remember" class="inputBox">
    </div>
    <div class="ilContainerCol loginInput">
      <input type="hidden" name="login" value="true">
      <button class="btn btnThird">Log In</button>
    </div>
  </form>
</header>
<main>
  <aside>
    <p class="bgText white bold">Access to all our online services</p>
    <div class="service">
      <img src="./assets/accesible.svg" alt="accesible-icon">
      <p class="mdText white"><span class=" mdText bold">Lorem ipsum dolor sit</span> amet consectetur adipisicing elit.</p>
    </div>
    <div class="service">
      <img src="./assets/armchair.svg" alt="armchair-icon">
      <p class="mdText white"><span class=" mdText bold">Lorem ipsum dolor sit</span> amet consectetur adipisicing elit.</p>
    </div>
    <div class="service">
      <img src="./assets/atom.svg" alt="atom-icon">
      <p class="mdText white"><span class=" mdText bold">Lorem ipsum dolor sit</span> amet consectetur adipisicing elit.</p>
    </div>
  </aside>
  <section>
    <h2 class="bgText white bold">Sign Up</h2>
    <?php if (isset($ban) && $ban <= 0) { ?>
      <div class="alert">
        <?php echo $alert ?>
      </div>
    <?php } ?>
    <form action="" method="post" class="registerContainer">
      <div class="twoInputContainerRow">
        <input type="text" name="username" id="username" placeholder="Type a username" class="inputText">
        <input type="email" name="email" id="email" placeholder="Type a email" class="inputText">
      </div>
      <div>
        <input type="password" name="password" id="password" placeholder="Type a password" class="inputText">
      </div>
      <div>
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm the password" class="inputText">
      </div>
      <div>
        <input type="hidden" name="signup" value="signup">
        <button class="btn btnThird">Create Account</button>
      </div>
    </form>
  </section>
</main>

<?php require_once("./footer.php"); ?>