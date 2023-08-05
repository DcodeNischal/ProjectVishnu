<?php
// get company id from url
$company_id = $_GET['id'];
session_start();

if (!isset($_SESSION['rusername'])) {
    header('location: ../login-researcher.php');
}
$error = '';
$rusername = $_SESSION['rusername'];

require_once('../../../database/connect.php');
$connection = new Connection();
$result = $connection->getCompanyDetails($company_id);
$id = $result['id'];
$website = $result['cwebsite'];
$capilinks = $result['capilinks'];

// change api links to array seperationg elements with ,
$capilinks = explode(",", $capilinks);
$website = explode(",", $website);

// get all elements of apilinks and website in one array
$target = array_merge($capilinks, $website);
// remove empty elements from array
$target = array_filter($target);


//get uid of username of user
$result = $connection->getUserDetails($rusername);
$uid = $result['uid'];





if (isset($_POST['submit'])) {

    //   check empty fields for title, target, severty,type, url, description,file

    if (empty($_POST['title']) || empty($_POST['target']) || empty($_POST['severity']) || empty($_POST['type']) || empty($_POST['url']) || empty($_POST['description']) || empty($_POST['file'])) {
        $error = "All fields are required";
    } else {
        $title = $_POST['title'];
        $target = $_POST['target'];
        $severity = $_POST['severity'];
        $type = $_POST['type'];
        $url = $_POST['url'];
        $description = $_POST['description'];
        $file = $_POST['file'];


        require_once '../../../database/connect.php';
        $connection = new Connection();


        // // save file to ../../../assets/report/images/
        // $target_dir = "../../../assets/report/images/";
        // $target_file = $target_dir . basename($_FILES["file"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        





        $result = $connection->RsubmitReport($uid, $company_id, $title, $target, $severity, $type, $url, $description, $file);
        if ($result) {
            $error = "Report Submitted Successfully";
        } else {
            $error = "Report Submission Failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submit Report</title>
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
            <a href="../logout.php"><button>Logout</button></a>
        </div>
    </nav>

    <div class="inner-body">
        <div class="page-inner">
            <div class="title">
                <h1 class="page-title">Submit Report</h1>
            </div>

            <div class="company-details">
                <!-- <div class="company-logo">
                <img src="../../../assets/company/logo/{<?php $company_id ?>}.jpg" alt="">
            </div> -->

                <form action="" class="report-submit-form" method="post">

                    <div class="form" method="post" enctype="multipart/form-data">
                        <div class="field">
                            <div class="field-title">
                                <p>Info</p>
                            </div>
                            <div class="text">
                                <p>Write a title so we know what this vulnerability is about</p>
                            </div>
                            <div class="input">
                                <input type="text" placeholder="Heading of report" name="title" required>
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
                                <!-- options -->
                                <select name="target" id="target" required>
                                    <option value="-1" selected disabled hidden>Select Target</option>
                                    <?php
                                    foreach ($target as $value) {
                                        echo "<option value='$value'>$value</option>";
                                    }
                                    ?>
                                </select>
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
                                <!-- options -->
                                <select name="severity" id="severity" required>
                                    <option value="" selected disabled hidden>Select Severity</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
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
                                <input type="text" name="type" placeholder="Type of Vulnerability" required>
                            </div>
                            <div class="text">
                                <p>URL of vulnerability</p>
                            </div>
                            <div class="input">
                                <input type="text" name="url" placeholder="URL of Vulnerability" required>
                            </div>
                            <div class="text">
                                <p>Description</p>
                            </div>
                            <div class="input">
                                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description of Vulnerability"></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-title">
                                <p>Attachments</p>
                            </div>
                            <div class="text">
                                <p>Upload screenshots, or any other files that can help us understand the vulnerability better (under 5 MB)</p>
                            </div>
                            <div class="input">
                                <p>Attachments will be availabe soon</p>
                                <input type="text" name="file" hidden value="null">
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-title">
                                <p>Terms and Conditions</p>
                            </div>
                            <div class="text">
                                <p>Terms and Conditions apply</p>
                            </div>
                            <div class="checkbox">
                                <div class="same-line">
                                    <input type="checkbox" name="terms" id="terms" required checked>
                                    <label for="terms">I agree to the <a href="#">terms and conditions</a>.</label>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-title">
                                <p>Submit</p>
                            </div>
                            <div class="text">
                                <p>Submit your report</p>
                            </div>
                            <div class="input">
                                <input type="submit" value="Submit" name="submit">
                            </div>
                        </div>
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