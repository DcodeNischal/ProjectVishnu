<?php

// display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

  session_start();
  if(!isset($_SESSION['rusername'])){
    header("Location: login-researcher.php");
  }

  // use database
  require_once('../../database/connect.php');
  $connection = new Connection();

  // get user details
  $rusername = $_SESSION['rusername']; 
  $result = $connection->getUserDetails($rusername);
  $uid = $result['uid'];

  //get reports
  $statement = $connection->pdo->prepare("SELECT * FROM report WHERE uid = :uid");
  $statement->execute(array(':uid' => $uid));
  $reports = $statement->fetchAll(PDO::FETCH_ASSOC);

  // only display 10 words of description
  foreach ($reports as $key => $report) {
    $reports[$key]['description'] = implode(' ', array_slice(explode(' ', $report['description']), 0, 10));
  }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reports</title>
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
        <li><a href="myreport.php" class="active-list">Reports</a></li>
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
          <h1 class="page-title">Reports</h1>
        </div>
        <div class="reports">

          

          <!-- <div class="report">
            <a href="#">
              <div class="logo">
                <img
                  src="../../assets/logo/Project Vishnu 1.png"
                  alt="Company-Name"
                />
              </div>
              <div class="description">
                <span class="report-title"
                  >Lorem ipsum, dolor sit amet consectetur adipis</span
                >
                <span class="report-description"
                  >Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Quisquam, voluptatum.</span
                >
                <span class="report-date">12th May, 2020</span>
              </div>
              <div class="bounty-award">
                <span class="bounty-award-title">Bounty Award</span>
                <span class="bounty-award-amount">Rs.<span>5000</span></span>
              </div>
            </a>
          </div> -->

          <?php
            foreach($reports as $report){
              echo '
              <div class="report">
                <a href="report/report.php?id='.$report['reportid'].'">
                  
                  <div class="description">
                    <span class="report-title">' . $report['title'] . '</span>
                    <span class="report-description">' . $report['description'] . '</span>
                    <span class="report-date">' . $report['reporttime'] . '</span>
                  </div>
                  <div class="bounty-award">
                    <span class="bounty-award-title">Bounty Award</span>
                    <span class="bounty-award-amount">Rs. <span>' . $report['reward']. '</span></span>
                    <div class="bounty-award">
                      <span class="bounty-award-title">Status</span>
                      <span class="bounty-award-amount">'.$report['status'].'</span>
                    </div>
                    </div>
                </a>
              </div>
            ';
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
