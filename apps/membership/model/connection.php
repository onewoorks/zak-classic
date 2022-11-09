<?php 
session_start();
$user = "onewscom_kea";$pass = "z_kmpmE0.qD^";$host = 'localhost';
$membership = "onewscom_memship";
mysqli_connect($host,$user,$pass) or die("connection error");
mysqli_select_db($membership);
?>