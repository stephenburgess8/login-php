<?php

	require 'sql.php';

	save();

	unset($_SESSION["user"]);
	unset($_SESSION["id"]);
	unset($_SESSION['name']);
	unset($_SESSION['inventory']);
	
	header("Location: index.html")
?>