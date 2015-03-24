<?php 

	$user = json_encode(array('user'=>'0'));
	session_start();

	if(isset($_SESSION['user'])){
		$user = json_encode(array('user'=>unserialize($_SESSION['user']), 'inventory'=>unserialize($_SESSION['inventory'])));

	}
	elseif(isset($_SESSION['id']))
	{
	    $user = -1;
	} 
	else
	{
		
	}

	echo $user;
	exit;
 ?>