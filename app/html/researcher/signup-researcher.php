<?php
  // signup researcher
  session_start();
  $error = '';

  if(isset($_SESSION['rusername'])){
    header('location: dashboard.php');
  }

  // check if form is submitted
  if (isset($_POST['submit'])) {

    //   check empty fields for fullname, username, password, email, phone, address, city, state, country, pincode
    if (empty($_POST['rfullname']) || empty($_POST['rusername']) || empty($_POST['rpassword']) || empty($_POST['remail']) || empty($_POST['rcontact']) || empty($_POST['rgender'])) {
      $error = "All fields are required";
    } else {
      $rfullname = $_POST['rfullname'];
      $rusername = $_POST['rusername'];
      $rpassword = $_POST['rpassword'];
      $remail = $_POST['remail'];
      $rcontact = $_POST['rcontact'];
      $rgender = $_POST['rgender'];

      // check if username already exists
      // include database connection
      require_once('../../database/connect.php');
      $connection = new Connection();
      $result = $connection->checkUsernameUser($rusername);

      if ($result) {
        $error = "Username already exists";
      } else {
        // check if email already exists
        $result = $connection->checkEmailUser($remail);
        if ($result) {
          $error = "Email already exists";
        } else {
          // insert into database
          $result = $connection->Usignup($rfullname, $rusername, $rpassword, $remail, $rcontact, $rgender);
          if ($result) {
            header("location: login-researcher.php");
          } else {
            $error = "Something went wrong";
          }
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
    <title>Registration</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=VT323"
    />
  </head>
  <body>
    <div class="inner-body signup">
      <div class="container">
        <div class="title">Registration</div>
        <form action="" method="post">
          <div class="user-detail">
            <div class="input-box">
              <span class="details"
                >Full Name <span class="required">*</span></span
              >
              <input
                type="text"
                placeholder="Enter your name"
                name="rfullname"
                required
              />
            </div>
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
              <span class="details">Email <span class="required">*</span></span>
              <input
                type="text"
                placeholder="Enter your email"
                name="remail"
                required
              />
            </div>
            <div class="input-box">
              <span class="details">Contact</span>
              <input
                type="text"
                placeholder="Enter your number"
                name="rcontact"
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
            <div class="input-box">
              <span class="details"
                >Confirm password <span class="required">*</span></span
              >
              <input
                type="password"
                placeholder="Confirm your password"
                name="rconfirmpassword"
                required
              />
            </div>
          </div>
          <div class="gender-detail">
            <input type="radio" value="male" name="rgender" id="dot-1" />
            <input type="radio" value="female" name="rgender" id="dot-2" />
            <input type="radio" value="other" name="rgender" id="dot-3" />
            <span class="gender-title"
              >Gender <span class="required">*</span> </span
            ><br />
            <div class="category">
              <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">male</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">female</span>
              </label>
              <label for="dot-3">
                <span class="dot three"></span>
                <span class="gender">other</span>
              </label>
            </div>
          </div>
          <div class="error-div">
            <div class="error">
              <?php echo $error; ?>
            </div>
          </div>
          <div class="button">
            <input type="submit" value="Register" name="submit" />
          </div>
        </form>
        <span class="form-swap"
          >Already have an account ?
          <a href="login-researcher.php">Login</a></span
        >
      </div>
    </div>
  </body>
</html>
