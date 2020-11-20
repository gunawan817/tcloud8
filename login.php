<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: admin.php");
  exit;
}

require 'connect.php';

if (isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = pg_query("SELECT * FROM public.user WHERE username = '$username' AND password = '$password' ");
    $check = pg_num_rows($sql);

    if($check > 0){

      $_SESSION["login"] = true;

      header("Location: admin.php");
      exit;
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>

  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required/>
            </div>
            <?php if (isset($error)) : ?>
              <p style="color:red; font-style=italic;">username / password salah</p>
            <?php endif; ?>
            <input type="submit" value="Login" name="login" class="btn solid" />

        </form>

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Sign in</h3>
            <p>
              Silahkan sign in untuk melanjutkan!
            </p>

          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>

      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
