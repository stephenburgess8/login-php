<?php

	require 'hero.php';

	session_start();
	$user = unserialize($_SESSION['user']);
	$user->setLastState($user->getState());
	$user->setState($_POST['target']);
	$user->timeTick();
	$_SESSION['user'] = serialize($user);

?>