<?php
session_start();
$error = '';

if (isset($_SESSION['login_admin'])) {
  header("location:dashboard.php");
} else {

  if (isset($_POST['submit'])) {
    if (empty($_POST['ausername']) || empty($_POST['apassword'])) {
      $error = "Username or Password is required";
    } else {
      $username = $_POST['ausername'];
      $password = $_POST['apassword'];

      require_once('../../database/connect.php');
      $connection = new Connection();
      $password = md5($password);

      $result = $connection->Alogin($username, $password);

      if ($result) {
        $_SESSION['login_admin'] = $username;
        header("location:dashboard.php");
      } else {
        $error = "Username or Password is invalid";
      }
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323" />
</head>

<body>
  <div class="inner-body login">
    <div class="container">
      <div class="title">Login</div>
      <form action="" method="post">
        <div class="user-detail">
          <div class="input-box">
            <span class="details">Username <span class="required">*</span></span>
            <input type="text" placeholder="Enter your username" name="ausername" required />
          </div>
          <div class="input-box">
            <span class="details">Password <span class="required">*</span></span>
            <input type="password" placeholder="Enter your password" name="apassword" required />
          </div>
        </div>
        <div class="error-div">
          <span class="required"><?php echo ($error); ?></span>
        </div>
        <div class="button">
          <input type="submit" value="Login" name="submit" />
        </div>
      </form>
      <span class="form-swap">You can't make your own root account. Please contact <br />
        'Project Vishnu' Team.</span>
    </div>
  </div>
</body>

</html>