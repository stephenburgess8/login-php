<?php 
	session_start();
	$user = json_encode(array('user'=>'0'));
	// If the user session variable is set
	// Grab the user object and pass the information along to the JS.
	if(isset($_SESSION['user'])) {
		$user = json_encode(array('user'=>unserialize($_SESSION['user'])));
	}
	// If the session has started but the user object is not populated
	elseif(isset($_SESSION['id'])) {
		$user = -1;
	} else {
	}
	
	echo $user;
	exit;
 ?>