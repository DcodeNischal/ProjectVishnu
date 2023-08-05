<?php
session_start();
if(!isset($_SESSION['rusername'])){
    header('location: ../login-researcher.php');
}
$error = '';
$company_id = $_GET['id'];

// get all details of company from database
require_once('../../../database/connect.php');
$connection = new Connection();
$result = $connection->getCompanyDetails($company_id);
$id = $result['id'];
$cname = $result['cname'];
$cemail = $result['cemail'];
$ccontact = $result['ccontact'];
$caddress = $result['caddress'];
$cwebsite = $result['cwebsite'];
$cindustry = $result['cindustry'];
$cdescription = $result['cdescription'];
$clogo = $result['clogo'];
$crangeofreward = $result['crangeofreward'];
$capilinks = $result['capilinks'];
$coutofscope = $result['coutofscope'];
$ctandc = $result['ctandc'];
$celigibility = $result['celigibility'];
$clogo = $result['clogo'];


// change out of scope to array seperationg elements with ,
$coutofscope = explode(",", $coutofscope);

// change eligibility to array seperationg elements with ,
$celigibility = explode(",", $celigibility);

//change ctandc to array seperationg elements with ,
$ctandc = explode(",", $ctandc);

// change api links to array seperationg elements with ,
$capilinks = explode(",", $capilinks);
$cwebsite = explode(",", $cwebsite);



// change range of reward to array seperationg elements with -
$crangeofreward = explode("-", $crangeofreward);
$minreward = $crangeofreward[0];
$maxreward = $crangeofreward[1];
$avgreward = ($minreward + $maxreward) / 2;

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $cname; ?></title>
  <link rel="stylesheet" href="../../../css/style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323" />
</head>

<body>
  <nav>
    <div class="logo">
      <img src="../../../assets/logo/Project Vishnu 3.png" alt="Project Vishnu - securing digital himalayas" />
    </div>
    <ul>
      <li><a href="../dashboard.php">Dashboard</a></li>
      <li><a href="../programs.php">Programs</a></li>
      <li><a href="../myreport.php">Reports</a></li>
      <li><a href="../hacktivity.php">Hacktivity</a></li>
      <li><a href="../leaderboard.php">Leaderboard</a></li>
      <li><a href="../settings.php">Settings</a></li>
    </ul>
    <div class="logout">
      <a href="#"><button>Logout</button></a>
    </div>
  </nav>

  <div class="inner-body">
    <div class="page-inner">
      <div class="title">
        <h1 class="page-title"><?php echo $cname; ?></h1>
      </div>

      <div class="company-details">
        <div class="company-logo">
          <img src="<?php echo $clogo ?>" alt="">
        </div>

        <div class="submit-report">
          <a href="submitreport.php?id=<?php echo $id; ?>"><button>Submit Report</button></a>
        </div>

        <div class="company-description">
          <p><?php echo $cdescription; ?></>
        </div>
        <div class="bounty-details">
          <div class="each">
            <div class="severty">
              <p>Low</p>
            </div>
            <div class="bounty">
              <p>Rs. <span><?php echo $minreward; ?></span></p>
            </div>
          </div>

          <div class="each">
            <div class="severty">
              <p>Medium</p>
            </div>
            <div class="bounty">
              <p>Rs. <span><?php echo $avgreward; ?></span></p>
            </div>
          </div>

          <div class="each">
            <div class="severty">
              <p>High</p>
            </div>
            <div class="bounty">
              <p>Rs. <span><?php echo $maxreward; ?></span></p>
            </div>
          </div>
        </div>



        <div class="valid-websites">
          <p>Valid Websites</p>
          <div class="websites">
            <?php

            foreach ($cwebsite as $website) {
              echo ('<div class="each">
                        <p>' . $website . '</p>
                    </div>');
            }


            foreach ($capilinks as $link) {
              echo ('<div class="each">
                        <p>' . $link . '</p>
                    </div>');
            }
            ?>
          </div>
        </div>


        <div class="eligibility">
          <p>Eligibility</p>
          <div class="eligibility-details">
            <ol>
              <?php
              foreach ($celigibility as $eligibility) {
                echo ('<li>' . $eligibility . '</li>');
              }
              ?>
            </ol>
          </div>
        </div>

        <div class="out-of-scope">
          <p>Out of Scope</p>
          <div class="out-of-scope-details">
            <ol>
              <?php
              foreach ($coutofscope as $outofscope) {
                echo ('<li>' . $outofscope . '</li>');
              }
              ?>
            </ol>
          </div>
        </div>

        <div class="out-of-scope">
          <p>Terms and Conditions</p>
          <div class="out-of-scope-details">
            <ol>
              <?php
              foreach ($ctandc as $tandc) {
                echo ('<li>' . $tandc . '</li>');
              }
              ?>
            </ol>
          </div>
        </div>


        <div class="company-contact">
          <span>Contact</span>
          <div class="contact">
            <div class="each">
              <p>Phone</p>
              <p><?php echo $ccontact; ?></p>
            </div>
            <div class="each">
              <p>Email</p>
              <p><?php echo $cemail; ?></p>
            </div>
            <div class="each">
              <p>Address</p>
              <p><?php echo $caddress; ?></p>
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