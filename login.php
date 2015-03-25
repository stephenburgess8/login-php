<?php 

function validateUser($sqli)
{
  $error = '';
  $id = 0;
  $new = TRUE;

  // Fetch data
  $email = mysqli_real_escape_string($sqli, $_POST['emailInput']);
  $tempPass = mysqli_real_escape_string($sqli, $_POST['passwordInput']);
  // Check if all required fields are filled out.
  if (isset($email, $tempPass)) {
    // SHA512 with salt prevents against password cracking with rainbow tables
    // Change this to your own unique salt
    $salt = 'ko@ko.com' . 'FbjRQ#s+[@-~,!SaJ[`%51^$E{zZ>S}=?`Gq';
    $pass = hash('sha512', $salt.$tempPass, false);

    // Query from database
    $query = mysqli_query($sqli, "SELECT * FROM users WHERE email='".$email."' LIMIT 1");
    $checkUser= mysqli_num_rows($query);

    if($checkUser > 0) {  // Check if email is found in db
      // Fetching user password hash in database for comparison.

      while ($row = mysqli_fetch_array($query, MYSQLI_BOTH)) {
        // NB remove strict coupling of password to row[2]
        $checkpass = $row[2];

        // Compare password hashes.
        if ($pass === $checkpass) {
          $id = $row[0];

          $timeStamp = $row[3];
          $verified = $row[4];
        } else {
          $error = "Passwords do not match";
        }
      }
    } else { // If email is not found
      $error = "Email doesn't exist in our database!";
      $id = -1;
    }
  }
  return array('id' => $id, 'email' => $email, 'new' => $new, 'timeStamp'=> $timeStamp, 'verified'=>$verified, 'error' => $error);
}

function sessionSet($array) {
  // Starts Session
  session_start();
  $_SESSION['id'] = $array['id'];
  
  //Calculate 10 days in the future
  //seconds * minutes * hours * days + current time
  $inTenDays = 60 * 60 * 24 * 10 + time(); 

  //User info
  $salt = $array['email'] . '239h9vn9U#@)jv0*@ng)*3j(1.t42n0)';
  $userInfo = hash('sha512', $salt1.$array['id'], false);

  setcookie("user", $userInfo, $inTenDays);
}

// Main
if(isset($_POST['emailInput'], $_POST['passwordInput'])){
  require 'sql.php';
  // Starts SQL connection
  $sql = getConnected();
  $userArray = validateUser($sql);
  if ( $userArray['id'] > 0 ) {
    sessionSet($userArray);
    echo json_encode($userArray);
    exit();
  }
  else
  {
    echo 'Username does not exist';
  }
}
else 
{
  echo "Please enter a username and password.";
}
