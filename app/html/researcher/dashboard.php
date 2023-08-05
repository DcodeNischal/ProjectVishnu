<?php

    session_start();
    if(!isset($_SESSION['rusername'])){
        header('location: login-researcher.php');
    }
    $rusername = $_SESSION['rusername'];

    // include database connection
    require_once('../../database/connect.php');
    $connection = new Connection();
    $result = $connection->getUserDetails($rusername);
    $rfullname = $result['ufullname'];
    $rusername = $result['uusername'];
    $uid = $result['uid'];


    $points = $connection->getPoints($uid);

    $totalsubmissions = $connection->getTotalSubmissionUser($uid);
    $totalreward = $connection->getPoints($uid);

    $solvedreports =  $connection->getReportStatusUser($uid,'solved');
    $unsolvedreports =  $connection->getReportStatusUser($uid,'unsolved');
    $pendingreports =  $connection->getReportStatusUser($uid,'Pending');
    $disclosedreports =  $connection->getReportStatusUser($uid,'disclose');

    



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Programs</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=VT323"/>
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
        <li><a href="dashboard.php" class="active-list">Dashboard</a></li>
        <li><a href="programs.php">Programs</a></li>
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
          <h1 class="page-title">Dashboard</h1>
        </div>
        
            <div class="dashboard">
                <div class="main">
                    <div class="name">
                        <span><?php echo $result['ufullname']?></span>
                    </div>
                    <div class="username">
                        <span><?php echo $result['uusername']?></span>
                    </div>
                    <div class="wrapper">
                        <div class="item">
                            <span><span>Current Rank</span> 1<span><?php echo $rank;?></span></span>
                        </div>
                        <div class="item">
                            <span><span>Points</span><span><?php echo $points?></span></span>
                        </div>
                    </div>
                    <div class="verify">
                        <span>Verify yourself </span>
                        <a href="#"><button>Verify</button></a>
                    </div>
                </div>
        
                <div class="secondary">
                    <div class="secondary-first">
                        <div class="item">
                            <div class="secondary-title">
                                Total Submissions
                            </div>
                            <div class="secondary-value">
                                <span><?php echo $totalsubmissions?></span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="secondary-title">
                                Recieved Reward
                            </div>
                            <div class="secondary-value">
                                <span>Rs. <span><?php echo $points?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="secondary-second">
        
                        <div class="secondary-main-title">
                            <p>Submission Stats</p>
                        </div>
                        <div class="contents">
                            <div class="content">
                                <div class="content-title">
                                    <span>Solved Submission</span>
                                </div>
                                <div class="content-value">
                                    <span><?php echo $solvedreports?></span>
                                </div>
                            </div>
                            <div class="content">
                                <div class="content-title">
                                    <span>Unsolved Submission</span>
                                </div>
                                <div class="content-value">
                                    <span><?php echo $unsolvedreports ?></span>
                                </div>
                            </div>
        
                            <div class="content">
                                <div class="content-title">
                                    <span>Pending Submission</span>
                                </div>
                                <div class="content-value">
                                    <span><?php echo $pendingreports?></span>
                                </div>
                            </div>
        
        
                            <div class="content">
                                <div class="content-title">
                                    <span>Disclosed Submission</span>
                                </div>
                                <div class="content-value">
                                    <span><?php echo $disclosedreports?></span>
                                </div>
                            </div>
                        </div>
                    </div>
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
    
    <div>
    </div>
  </body>
</html>
