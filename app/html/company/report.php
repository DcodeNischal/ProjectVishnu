<?php

session_start();
$error = '';

//error report


if(!isset($_SESSION['company-username'])) {
  header("Location: login-company.php");
}


$username = $_SESSION['company-username'];
$reportid = $_GET['id'];
require_once('../../database/connect.php');
$connection = new Connection();
$result = $connection->CgetReport($reportid);

$uid = $result['uid'];
$title = $result['title'];
$target = $result['target'];
$severity = $result['severity'];
$type = $result['type'];
$url = $result['url'];
$description = $result['description'];
$status = $result['status'];
$reporttime = $result['reporttime'];
$reward = $result['reward'];


if (isset($_POST['reward-button'])) {
  $status = $_POST['status'];
  $reward = $_POST['reward'];
  $connection->CupdateReport($reportid, $status, $reward);
  header("Location: dashboard.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report</title>
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
      <li><a href="settings.php">Settings</a></li>
    </ul>
    <div class="logout">
      <a href="logout.php"><button>Logout</button></a>
    </div>
  </nav>

  <div class="inner-body">
    <div class="page-inner">
      <div class="title">
        <h1 class="page-title">Report Summary</h1>
      </div>

      <div class="company-details">
        <div class="company-logo">
          <img src="../../assets/logo/Project Vishnu 3.png" alt="">
        </div>

        <div class="report-submit-form">

          <div class="form">
            <div class="field">
              <div class="field-title">
                <p>Info</p>
              </div>
              <div class="text">
                <p>Write a title so we know what this vulnerability is about</p>
              </div>
              <div class="input">
                <p><?php echo $title; ?></p>
              </div>
            </div>

            <div class="field">
              <div class="field-title">
                <p>Target</p>
              </div>
              <div class="text">
                <p>What is the target of this vulnerability?</p>
              </div>
              <div class="input">
                <p><?php echo $target; ?></p>
              </div>
            </div>

            <div class="field">
              <div class="field-title">
                <p>Severity</p>
              </div>
              <div class="text">
                <p>How severe is this vulnerability?</p>
              </div>
              <div class="input">
                <p><?php echo $severity; ?></p>
              </div>
            </div>

            <div class="field">
              <div class="field-title">
                <p>Proof of Concept</p>
              </div>
              <div class="text">
                <p>Type of vulnerability</p>
              </div>
              <div class="input">
                <p><?php echo $type; ?></p>
              </div>
              <div class="text">
                <p>URL of vulnerability</p>
              </div>
              <div class="input">
                <p><?php echo $url; ?></p>
              </div>
              <div class="text">
                <p>Description</p>
              </div>
              <div class="input">
                <p><?php echo $description; ?></p>
              </div>
            </div>

            <div class="field">
              <div class="field-title">
                <p>Attachments</p>
              </div>
              <div class="text">
                <p>Upload screenshots, or any other files that can help us understand the vulnerability better (under 5 MB)</p>
              </div>
              <div class="input attachments">
                <p>Attachments comming soon</p>
              </div>
            </div>

            <!-- reward -->
            <div class="field">
              <div class="field-title">
                <p>Reward</p>
              </div>
              <div class="text">
                <p>How much reward this took?</p>
              </div>
              <div class="input">
                <p><?php echo $reward; ?></p>
              </div>
            </div>

            <!-- Give rewards -->

            <div class="field">
              <div class="field-title">
                <p>Give rewards</p>
              </div>
              <div class="text">
                <p>Give rewards to the reporter</p>
              </div>
              <div class="input reward-input">
                <form action="" method="post">
                  <input type="number" placeholder="Enter amount" name="reward" value="0">
                  <div class="buttons-report">
                    <select name="status" id="status">
                      <option value="-1" >Select Status</option>
                      <option value="pending">Pending</option>
                      <option value="solved">Solved</option>
                      <option value="unsolved">Unsolved</option>
                      <option value="disclose">Disclose</option>
                    </select>
                  </div>
                  <button class="reward-button" name="reward-button">Submit</button>
                </form>
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
</body>

</html>