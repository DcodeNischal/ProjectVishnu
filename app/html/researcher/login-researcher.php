<?php
  // user login

  session_start();
  $error = '';

  if (isset($_SESSION['rusername'])) {
    header('location: dashboard.php');
  }

  // check if form is submitted
  if (isset($_POST['submit'])) {

    //   check empty fields for username, password
    if (empty($_POST['rusername']) || empty($_POST['rpassword'])) {
      $error = "All fields are required";
    } else {
      $rusername = $_POST['rusername'];
      $rpassword = $_POST['rpassword'];

      // include database connection
      require_once('../../database/connect.php');
      $connection = new Connection();
      $result = $connection->Ulogin($rusername, $rpassword);

      if ($result) {
        $_SESSION['rusername'] = $rusername;
        header("location: dashboard.php");
      } else {
        $error = "Username or Password is invalid";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../../css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=VT323"
    />
  </head>
  <body>
    <div class="inner-body login">
      <div class="container">
        <div class="title">Login</div>
        <form action="" method="post">
          <div class="user-detail">
            <div class="input-box">
              <span class="details"
                >Username <span class="required">*</span></span
              >
              <input
                type="text"
                placeholder="Enter your username"
                name="rusername"
                required
              />
            </div>
            <div class="input-box">
              <span class="details"
                >Password <span class="required">*</span></span
              >
              <input
                type="password"
                placeholder="Enter your password"
                name="rpassword"
                required
              />
            </div>
          </div>
          <div class="button">
            <input type="submit" value="Login" name="submit"/>
          </div>
        </form>
        <span class="form-swap"
          >Don't have an account ?
          <a href="signup-researcher.php">Register</a></span
        >
      </div>
    </div>
  </body>
</html>
