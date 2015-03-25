<?php
function createUser($sqli) {
  $id = 0;
  $result = "";
  // FETCH DATA FROM INPUT FIELD
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

    if($checkUser < 1) { // Check if email is found in db
      // Inserts new user info into new table row.
      mysqli_query($sqli, "INSERT INTO users (email, password) VALUES ('".$email."', '".$pass."')");

      // Fetching ID for new row.
      $query = mysqli_query($sqli, "SELECT * FROM users WHERE email='".$email."'");
      while ($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
        $id = $row[0];
        $result = "Success! You've been registered";
      }    	
    } else {
    	$result = "Sorry, that email has already been registered.";
    }
  } else {
    $result = "Sorry, I don't have your email or password.";
  }

  return array('id' => $id, 'result' => $result, 'pass' => $pass);
}

require 'sql.php';
$sql = getConnected();
$registrationResult = createUser($sql);

if ($registrationResult['id'] !== 0) {
  echo $registrationResult['result'];
  header("Location: index.html");
} else {
  echo $registrationResult['result'];
}
exit();