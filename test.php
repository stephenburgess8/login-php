<?php
$email = 'hi@hi.com';
$tempPass = "1234";
$salt = $email . 'FbjRQ#s+[@-~,!SaJ[`%51^$E{zZ>S}=?`Gq';

echo hash('sha512', $salt.$tempPass, false);
echo "\n\t\r . ";
echo hash('sha512', $salt.$tempPass, false);