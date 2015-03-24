<?php

// Connects to your Database 
function getConnected() {

  include 'credentials.php';

   $sqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

   if($sqli->connect_error) 
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

   return $sqli;
}

function createUser($sqli) {

    $id = 0;

     // FETCH DATA FROM INPUT FIELD
    $email = mysqli_real_escape_string($sqli, $_POST['emailInput']);
    $tempPass = mysqli_real_escape_string($sqli, $_POST['passwordInput']);

    // Check if all required fields are filled out.
    $validEntry = FALSE;
    if (isset($email, $tempPass))
    {
      // SHA512 with salt prevents against password cracking with rainbow tables
      // Change this to your own unique salt
      $salt = $email . 'FbjRQ#s+[@-~,!SaJ[`%51^$E{zZ>S}=?`Gq';
      $pass = hash('sha512', $salt.$tempPass, false);

      // Query from database
      $query = mysqli_query($sqli, "SELECT * FROM users WHERE email='".$email."'");

       // Check if email already exists.
      $checkUser= mysqli_num_rows($query);
      if($checkUser > 0)
      {
      	$error = "Sorry, that email has already been registered.";
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
	     mysqli_query($sqli, "INSERT INTO users (email, password) VALUES ('".$email."', '".$pass."')");

       // Fetching ID for new row.
       $query = mysqli_query($sqli, "SELECT * FROM users WHERE email='".$email."'");
	     while ($row = mysqli_fetch_array($query, MYSQLI_NUM))
	     {
		    $id = $row[0];
       }
		}

  return $id ;

}

	$sql = getConnected();
	$id = createUser($sql);

	header("Location: index.html");
	exit();

?>