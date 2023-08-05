<?php
session_start();
if (!isset($_SESSION['login_admin'])) {
  header("location: login-root.php");
} else {
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings</title>
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323" />
</head>

<body>
  <nav>
    <div class="logo">
      <img src="../../assets/logo/Project Vishnu 3.png" alt="Project Vishnu - securing digital himalayas" />
    </div>
    <ul>
      <li><a href="dashboard.php" class="active-list">Dashboard</a></li>
      <li><a href="settings.php">Settings</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><button>Logout</button></a>
    </div>
  </nav>

  <div class="inner-body">
    <div class="page-inner">
      <div class="title">
        <h1 class="page-title">Dashboard</h1>
      </div>
      <div class="dashboard" style="text-align: center;">
        <h1>ADMIN DASHBOARD<br />COMMING SOON</h1>
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