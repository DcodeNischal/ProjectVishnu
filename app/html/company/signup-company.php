<?php
// Signup company

session_start();
$error = '';

// error show
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['company-username'])) {
  header("Location: dashboard.php");
}else{
  if (isset($_POST['submit'])) {
    if (empty($_POST['cfullname']) || empty($_POST['cusername']) || empty($_POST['cemail']) || empty($_POST['ccontact']) || empty($_POST['caddress']) || empty($_POST['cpassword']) || empty($_POST['cconfirmpassword']) || empty($_POST['cwebsite']) || empty($_POST['cindustry']) || empty($_POST['cdescription']) || empty($_POST['crangeofreward'])  || empty($_POST['celigibility']) || empty($_POST['coutofscope']) || empty($_POST['ctandc']) || empty($_POST['clogo'])) {
      $error = "All fields are required";
    } else {
      $companyname = $_POST['cfullname'];
      $username = $_POST['cusername'];
      $email = $_POST['cemail'];
      $contact = $_POST['ccontact'];
      $address = $_POST['caddress'];
      $password = $_POST['cpassword'];
      $confirmpassword = $_POST['cconfirmpassword'];
      $website = $_POST['cwebsite'];
      $industry = $_POST['cindustry'];
      $description = $_POST['cdescription'];
      $rangeofreward = $_POST['crangeofreward'];
      $apilinks = $_POST['capilinks'];
      $celigibility = $_POST['celigibility'];
      $coutofscope = $_POST['coutofscope'];
      $ctandc = $_POST['ctandc'];
      $clogo = $_POST['clogo'];

  
      // form validation
  
      if (!preg_match("/^[a-zA-Z ]*$/", $companyname)) {
        $error = "Only letters and white space allowed";
      }
      if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $error = "Only letters and numbers allowed";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
      }
      if (!preg_match("/^[0-9]*$/", $contact)) {
        $error = "Only numbers allowed";
      }
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $address)) {
        $error = "Only letters, numbers and white space allowed";
      }
      if (!preg_match("/^(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $website)) {
        $error = "enter valid website";
      }
      if (!preg_match("/^[a-zA-Z ]*$/", $industry)) {
        $error = "Only letters and white space allowed";
      }
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $description)) {
        $error = "Only letters, numbers and white space allowed";
      }
      if (!preg_match("/^\d+-\d+$/", $rangeofreward)) {
        $error = "Range of reward must be in this format: 1000-2000";
      }
      if (!preg_match("/^(https?:\/\/)?[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(\/\S*)?$/", $apilinks)) {
        $error = "Enter valid api link";
      }
  
  
      require_once('../../database/connect.php');
      $connection = new Connection();
  
      // check password
  
      if ($password == $confirmpassword) {
        $password = md5($password);
        $confirmpassword = md5($confirmpassword);
        // save registration pdf and logo
  
        $connection->checkUsername($username);
        $connection->checkEmail($email);
        if ($connection->checkUsername($username) == 0 && $connection->checkEmail($email) == 0) {
          $result = $connection->Csignup($companyname, $username, $password, $email, $contact, $address, $website, $industry, $description, $clogo, $rangeofreward, $apilinks,$celigibility,$coutofscope,$ctandc);
          header("Location: login-company.php");
        } else {
          $error = "Username or Email already exists";
        }
      } else {
        $error = "Password and Confirm Password do not match";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../../css/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323" />
</head>

<body>
  <div class="inner-body signup company">
    <div class="container">
      <div class="title">Registration</div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="user-detail">
          <div class="input-box">
            <span class="details">Company Name <span class="required">*</span></span>
            <input type="text" placeholder="Enter your name" name="cfullname" required />
          </div>
          <div class="input-box">
            <span class="details">Username <span class="required">*</span></span>
            <input type="text" placeholder="Enter your username" name="cusername" required />
          </div>
          <div class="input-box">
            <span class="details">Email <span class="required">*</span></span>
            <input type="text" placeholder="Enter your email" name="cemail" required />
          </div>
          <div class="input-box">
            <span class="details">Contact <span class="required">*</span></span>
            <input type="text" placeholder="Enter your number" name="ccontact" required />
          </div>
          <div class="input-box">
            <span class="details">Address <span class="required">*</span></span>
            <input type="text" placeholder="Enter your address" name="caddress" required />
          </div>
          <div class="input-box">
            <span class="details">Password <span class="required">*</span></span>
            <input type="password" placeholder="Enter your password" name="cpassword" required />
          </div>
          <div class="input-box">
            <span class="details">Confirm password <span class="required">*</span></span>
            <input type="password" placeholder="Confirm your password" name="cconfirmpassword" required />
          </div>
          <div class="input-box">
            <span class="details">Website <span class="required">*</span></span>
            <input type="text" placeholder="Enter your website" name="cwebsite" required />
          </div>
          <div class="input-box">
            <span class="details">Industry <span class="required">*</span></span>
            <input type="text" placeholder="Enter your industry" name="cindustry" required />
          </div>
          <div class="input-box">
            <span class="details">Description <span class="required">*</span></span>
            <textarea name="cdescription" id="description" cols="30" rows="10" placeholder="Enter your description" required></textarea>
          </div>
          <div class="input-box">
            <span class="details">Logo URL<span class="required">*</span> </span>
            <input type="text" name="clogo" placeholder="Enter the link of your logo" required />
          </div>
          <div class="input-box">
            <span class="details">Range of reward <span class="required">*</span></span>
            <input type="text" placeholder="eg. 0-5000" name="crangeofreward" required />
          </div>
          <div class="input-box">
            <span class="details">API(S) links</span>
            <input type="text" placeholder="Enter your API(S) links" name="capilinks" />
          </div>
          <div class="input-box">
          <span class="details">Eligibility <span class="required">*</span></span>
            <textarea name="celigibility" id="eligibility" cols="30" rows="10" placeholder="Enter Eligibility for Researchers seperated by comma" required></textarea>
          </div>
          <div class="input-box">
          <span class="details">Out of Scope <span class="required">*</span></span>
            <textarea name="coutofscope" id="outofscope" cols="30" rows="10" placeholder="Enter out of scope areas seperated by comma" required></textarea>
          </div>
          <div class="input-box">
          <span class="details">Terms and Conditions <span class="required">*</span></span>
            <textarea name="ctandc" id="tandc" cols="30" rows="10" placeholder="Enter Terms and Conditions for researchers seperated by comma" required></textarea>
          </div>


        </div>

        <div class="error-div">
          <span class="error"><?php echo $error; ?></span>
        </div>

        <div class="button">
          <input type="submit" value="Register" name="submit" />
        </div>
      </form>
      <span class="form-swap">Already have an account ?
        <a href="login-company.php">Login</a> </span>
    </div>
  </div>
</body>

</html>