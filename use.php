<?php

	require 'hero.php';
	require 'classes.php';

	session_start();

	// Grab user object from secure session variable
	$user = unserialize($_SESSION['user']);
	$inventory = unserialize($_SESSION['inventory']);

	echo(json_encode($inventory));

	

	//$user->setState($_POST['type']);
	
	
	// Update user object in secure session variable
	// $_SESSION['user'] = serialize($user);

?>