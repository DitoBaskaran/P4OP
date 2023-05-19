<?php  
ob_start(); 
date_default_timezone_set("Asia/Jakarta");
error_reporting(0);

$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "db_p4op";

// Mendapatkan tanggal saat ini
$date = date("Y-m-d");

$baseUrl = "http://localhost/P4OP/";

$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname) or die("Failed connect to MYSQL");

?>