<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$hostname="localhost";
$user    ="account";
$password="qwerty20";
$db =  mysql_connect($hostname, $user, $password) or mysql_error();
$database="germin"; 
mysql_select_db($database,$db) or die("Database Not Found");
?>

