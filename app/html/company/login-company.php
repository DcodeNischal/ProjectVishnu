<?php
  // Login company

  session_start();
  $error = '';

  if (isset($_SESSION['company-username'])) {
    header("Location: dashboard.php");
  }

  if (isset($_POST['submit'])) {
    if (empty($_POST['cusername']) || empty($_POST['cpassword'])) {
      $error = "All fields are required";
    } else {
      $username = $_POST['cusername'];
      $password = $_POST['cpassword'];
      $password = md5($password);

      require_once('../../database/connect.php');
      $connection = new Connection();

      $result = $connection->Clogin($username, $password);
      if ($result) {
        $_SESSION['company-username'] = $username;
        header("Location: dashboard.php");
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
                name="cusername"
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
                name="cpassword"
                required
              />
            </div>
          </div>

          <div class="error-div">
            <span class="error"><?php echo $error; ?></span>
          </div>
          <div class="button">
            <input type="submit" value="Login" name="submit" />
          </div>
        </form>
        <span class="form-swap"
          >Don't have an account ?
          <a href="signup-company.php">Register</a></span
        >
      </div>
    </div>
  </body>
</html>
