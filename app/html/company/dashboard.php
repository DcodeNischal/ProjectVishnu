<?php

  session_start();
  $error = '';

  // show errors
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);

  if (!isset($_SESSION['company-username'])) {
    header("Location: login-company.php");
  }
  else{

  }
  
  $username = $_SESSION['company-username'];
  require_once('../../database/connect.php');
  $connection = new Connection();
  $result = $connection->CgetCompany($username);
  $cname = $result['cname'];
  $cusername = $result['cusername'];

  $id = $result['id'];

  $result = $connection->CgetReports($id);
  
  $total_reports = $connection->CgetTotalReports($id);
  $total_rewards = $connection->CgetTotalRewards($id);

  $solved = $connection->CgetTotalReportsByStatus("solved",$id);
  $unsolved = $connection->CgetTotalReportsByStatus("unsolved",$id);
  $disclosed = $connection->CgetTotalReportsByStatus("disclose",$id);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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

        <div class="dashboard-company">
          <div class="main">
            <div class="name">
              <span><?php echo $cname?></span>
            </div>
            <div class="username">
              <span><?php echo $cusername?></span>
            </div>
            <div class="total-report">
              <span>Reports Total</span>
              <span><?php echo $total_reports?></span>
            </div>
            <div class="total-reward">
              <span>Given Rewards</span>
              <span><?php echo $total_rewards?></span>
            </div>
          </div>

          <div class="secondary">
            <div class="secondary-first">
              <div class="item">
                <div class="secondary-title">solved</div>
                <div class="secondary-value">
                  <span><?php echo $solved?></span>
                </div>
              </div>
              <div class="item">
                <div class="secondary-title">unsolved</div>
                <div class="secondary-value">
                  <span><?php echo $unsolved?></span>
                </div>
              </div>
              <div class="item">
                <div class="secondary-title">discolsed</div>
                <div class="secondary-value">
                  <span><?php echo $disclosed?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dashboard-company-second">
            <?php 
            
              foreach($result as $row){
                echo '<a href="report.php?id='.$row['reportid'].'">';
                echo '<div class="report">';
                echo '<div class="report-title">';
                echo '<span>'.$row['title'].'</span>';
                echo '</div>';
                echo '<div class="report-description">';
                echo '<span>'.$row['description'].'</span>';
                echo '</div>';
                echo '<div class="wrapper">';
                echo '<div class="date">';
                echo '<span>'.$row['reporttime'].'</span>';
                echo '</div>';
                echo '<div class="status">';
                echo '<span>status :</span>';
                echo '<span>'.$row['status'].'</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
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
