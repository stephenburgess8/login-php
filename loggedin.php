<?php

// Connects to your Database 
function getConnected() {

  include 'credentials.php';

   $sqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

   if($sqli->connect_error) 
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

   return $sqli;
}

function addInfo($sqli) {

    $id = 0;

     // FETCH DATA FROM INPUT FIELD
    $user = mysqli_real_escape_string($sqli, $_POST['usernameRequest']);

        // Two-fold password encryption hashing algorithm (hashing, hashed salt)
    $tempPass = mysqli_real_escape_string($sqli, $_POST['passwordRequest']);
    $salt = '1k7R!@bRUS}DW%Zy-tj{.o70WVm' . $user . 'FbjRQ#s+[@-~,!SaJ[`%51^$E{zZ>S}=?`Gq';
    $pass = md5($tempPass.$salt);
    $pass = sha1($pass);

    $email = mysqli_real_escape_string($sqli, $_POST['emailInput']);


    // Check if all required fields are filled out.
    $validEntry = FALSE;
    if (isset($user, $tempPass))
    {
      // Query from database
      $query = mysqli_query($sqli, "SELECT * FROM users WHERE handle='".$user."'");

       // Check if username already exists.
      $checkUser= mysqli_num_rows($query);
      if($checkUser > 0)
      {
      	$error = "Sorry, username already exists.";
      	echo $error;
      } 
      else
      {
      	$validEntry = TRUE;
      }
    }

    // Inserts new user info into new table row.
		if($validEntry)
		{
	     mysqli_query($sqli, "INSERT INTO users (handle, pw, email) VALUES ('".$user."', '".$pass."', '".$email."')");

       // Fetching ID for new row.
       $query = mysqli_query($sqli, "SELECT * FROM users WHERE handle='".$user."'");
	     while ($row = mysqli_fetch_array($query, MYSQLI_NUM))
	     {
		    $id = $row[0];
       }

		}

  return $id ;

}

	echo('');

	

	exit();

?>