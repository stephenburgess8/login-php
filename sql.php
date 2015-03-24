<?php 


// Connects to your Database 
function getConnected()
{
	require 'credentials.php';

	$sqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if($sqli->connect_error)
	{
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		exit();
	}

	return $sqli;	
}

// Saves user object to DB
function save()
{
	session_start();

	$sqli = getConnected();
	/* not used
	// Saves serialized user object to MySQL Database
	mysqli_query($sqli, "UPDATE hero SET hero='".$_SESSION['user']."' WHERE id='".$_SESSION['id']."'");

	// Saves serialized inventory array
	mysqli_query($sqli, "UPDATE inventory SET stuff='".$_SESSION['inventory']."' WHERE id='".$_SESSION['id']."'");
	*/
}	

 ?>