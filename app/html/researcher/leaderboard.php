<?php

session_start();

// error reporting view
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['rusername'])) {
  header("Location: login.php");
}


include_once '../../database/connect.php';
$connection = new Connection();
$result = $connection->getLeaderboard();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Leaderboard</title>
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
      <li><a href="programs.php">Programs</a></li>
      <li><a href="myreport.php">Reports</a></li>
      <li><a href="hacktivity.php">Hacktivity</a></li>
      <li><a href="leaderboard.php" class="active-list">Leaderboard</a></li>
      <li><a href="settings.php">Settings</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><button>Logout</button></a>
    </div>
  </nav>

  <div class="inner-body">
    <div class="page-inner">
      <div class="title">
        <h1 class="page-title">Leaderboard</h1>
      </div>
      <div class="leaderboard">
        

        <div class="top-others">
          <!-- <div class="top-others-item">
              <div class="top-others-name">
                <p>4</p>
                <p>John Doe</p>
              </div>
              <div class="top-others-points">
                <p><span>1000</span> <span>pts.</span></p>
              </div>
            </div>

            <div class="top-others-item">
                <div class="top-others-name">
                    <p>5</p>
                  <p>John Doe</p>
                </div>
                <div class="top-others-points">
                  <p><span>1000</span> <span>pts.</span></p>
                </div>
              </div>

              <div class="top-others-item">
                <div class="top-others-name">
                    <p>6</p>
                  <p>John Doe</p>
                </div>
                <div class="top-others-points">
                  <p><span>1000</span> <span>pts.</span></p>
                </div>
              </div>

              <div class="top-others-item">
                <div class="top-others-name">
                    <p>7</p>
                  <p>John Doe</p>
                </div>
                <div class="top-others-points">
                  <p><span>1000</span> <span>pts.</span></p>
                </div>
              </div>

              <div class="top-others-item">
                <div class="top-others-name">
                    <p>8</p>
                  <p>John Doe</p>
                </div>
                <div class="top-others-points">
                  <p><span>1000</span> <span>pts.</span></p>
                </div>
              </div>

              <div class="top-others-item">
                <div class="top-others-name">
                    <p>9</p>
                  <p>John Doe</p>
                </div>
                <div class="top-others-points">
                  <p><span>1000</span> <span>pts.</span></p>
                </div>
              </div>

              <div class="top-others-item">
                <div class="top-others-name">
                    <p>10</p>
                  <p>John Doe</p>
                </div>
                <div class="top-others-points">
                  <p><span>1000</span> <span>pts.</span></p>
                </div>
              </div> -->

          <?php
          foreach($result as $key => $value){
            echo '<div class="top-others-item">
            <div class="top-others-name">
              <p>'.($key + 1).'</p>
              <p>'.$value['user'].'</p>
            </div>
            <div class="top-others-points">
              <p><span>'.$value['total_reward'].'</span> <span>pts.</span></p>
            </div>
          </div>';
          }
          ?>
        </div>
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