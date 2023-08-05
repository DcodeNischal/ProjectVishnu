<?php
//programs display from database

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['rusername'])) {
  header("Location:login-researcher.php");
}

require_once('../../database/connect.php');
$connection = new Connection();

// get programs from database

$statement = $connection->pdo->prepare("SELECT * FROM company");
$statement->execute();
$programs = $statement->fetchAll(PDO::FETCH_ASSOC);

// only display 10 words of cdescription
foreach ($programs as $key => $program) {
  $programs[$key]['cdescription'] = implode(' ', array_slice(explode(' ', $program['cdescription']), 0, 10));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Programs</title>
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323" />
</head>

<body>
  <nav>
    <div class="logo">
      <img src="../../assets/logo/Project Vishnu 3.png" alt="Project Vishnu - securing digital himalayas" />
    </div>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="programs.php" class="active-list">Programs</a></li>
      <li><a href="myreport.php">Reports</a></li>
      <li><a href="hacktivity.php">Hacktivity</a></li>
      <li><a href="leaderboard.php">Leaderboard</a></li>
      <li><a href="settings.php">Settings</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><button>Logout</button></a>
    </div>
  </nav>

  <div class="inner-body">
    <div class="page-inner">
      <div class="title">
        <h1 class="page-title">Programs</h1>
      </div>
      <div class="programs">
        <?php


        foreach ($programs as $program) {
          echo "<a href='program/program.php?id={$program['id']}'>
          <div class='program'>
            <div class='image'>
              <img src='{$program['clogo']}' alt='test image' />
            </div>
            <div class='description'>
              <span class='program-name'>{$program['cname']}</span>
              <span class='program-description'>{$program['cdescription']}</span>
              <span class='bounty-reward'>Rs. {$program['crangeofreward']} per Vulnerability</span>
            </div>
          </div>
        </a>";
        }





        ?>
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