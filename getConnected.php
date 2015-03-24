<?php 

require 'credentials.php';

// Connects to your Database 
function getConnected() {

   $sqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

   if($sqli->connect_error) {
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
     exit();
   }

   return $sqli;
}


 ?>