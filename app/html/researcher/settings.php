<?php

session_start();
$error='';

if(!isset($_SESSION['rusername'])){
    header('location: login-researcher.php');
}

if (isset($_POST['submit'])) {

  if (empty($_POST['rpassword']) || empty($_POST['rnewpassword']) || empty($_POST['rconfirmpassword'])) {
    $error = "All fields are required";
  } else {
    $username = $_SESSION['rusername'];
    $password = $_POST['rpassword'];
    $newpassword = $_POST['rnewpassword'];
    $confirmpassword = $_POST['rconfirmpassword'];

    require_once('../../database/connect.php');
    $connection = new Connection();

    $password = md5($password);
    $newpassword = md5($newpassword);
    $confirmpassword = md5($confirmpassword);

    $result = $connection->Clogin($username, $password);
    if ($result) {
      if ($newpassword == $confirmpassword) {
        $connection->UchangePassword($username, $newpassword);
        $error ="Password Changed Successfully";
      } else {
        $error = "New Password and Confirm Password do not match";
      }
    } else {
      $error = "Password is invalid";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=VT323"
    />
  </head>
  <body>
    <nav>
      <div class="logo">
        <img
          src="../../assets/logo/Project Vishnu 3.png"
          alt="Project Vishnu - securing digital himalayas"
        />
      </div>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="programs.php">Programs</a></li>
        <li><a href="myreport.php">Reports</a></li>
        <li><a href="hacktivity.php">Hacktivity</a></li>
        <li><a href="leaderboard.php">Leaderboard</a></li>
        <li><a href="settings.php" class="active-list">Settings</a></li>
      </ul>
      <div class="logout">
        <a href="logout.php"><button>Logout</button></a>
      </div>
    </nav>

    <div class="inner-body">
      <div class="page-inner">
        <div class="title">
          <h1 class="page-title">Settings</h1>
        </div>
        <div class="settings">
          <form action="" method="post">
            <p class="sub-title">Change Password</p>
            <div class="input-box">
              <label for="oldpassword"
                >Old Password <span class="required">*</span></label
              >
              <input
                type="password"
                name="rpassword"
                id="oldpassword"
                placeholder="Old Password"
              />
            </div>
            <div class="input-box">
              <label for="newpassword"
                >New Password <span class="required">*</span></label
              >
              <input
                type="password"
                name="rnewpassword"
                id="newpassword"
                placeholder="New Password"
              />
            </div>
            <div class="input-box">
              <label for="confirmpassword"
                >Confirm Password <span class="required">*</span></label
              >
              <input
                type="password"
                name="rconfirmpassword"
                id="confirmpassword"
                placeholder="Confirm Password"
              />
            </div>

            <div class="error-div">
              <p class="error"><?php echo $error; ?></p>
            </div>

            <div class="button">
                <button type="submit" name="submit">Change Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer>
      <span>Copyright &copy; 2023 Trideva</span>
      <div class="footer-links">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Support</a>
        <a href="#">Contact</a>
      </div>
    </footer>
  </body>
</html>
