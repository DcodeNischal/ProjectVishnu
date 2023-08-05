<?php

session_start();

if (!isset($_SESSION['rusername'])) {
  header("Location: login-researcher.php");
}

$username = $_SESSION['rusername'];
require_once('../../database/connect.php');
$connection = new Connection();
$result = $connection->Hacktivity();

$reportid = $result['reportid'];
$title = $result['title'];
$target = $result['target'];
$severity = $result['severity'];
$type = $result['type'];
$url = $result['url'];
$description = $result['description'];
$status = $result['status'];
$reporttime = $result['reporttime'];
$reward = $result['reward'];


?>

!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hacktivity</title>
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
        <li><a href="hacktivity.php" class="active-list">Hacktivity</a></li>
        <li><a href="leaderboard.php">Leaderboard</a></li>
        <li><a href="settings.php" >Settings</a></li>
      </ul>
      <div class="logout">
        <a href="logout.php"><button>Logout</button></a>
      </div>
    </nav>

    <div class="inner-body">
      <div class="page-inner">
        <div class="title">
          <h1 class="page-title">Hacktivity</h1>
        </div>

        <div class="hacktivity">
            <!-- <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div>

            <div class="recent">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="main-title">
                    <p>Reported a vulnerability</p>
                </div>
                <div class="bounty-reward">
                    <p>Rs. <span>1000</span></p>
                </div>
            </div> -->

            <?php
            
                foreach($result as $row){
                    
                    echo "<div class='recent'>";
                    echo "<div class='name'>";
                    echo "<p>".$row['reporttime']."</p>";
                    echo "</div>";
                    echo "<div class='main-title'>";
                    echo "<p><a href=reoprt/report.php?id=".$row['reportid']." style='text-decoration:none; color:black;'>".$row['title']."</a></p>";
                    echo "</div>";
                    echo "<div class='bounty-reward'>";
                    echo "<p>Rs. <span>".$row['reward']."</span></p>";
                    echo "</div>";
                    echo "</div>";
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
