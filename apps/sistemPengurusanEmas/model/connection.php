<?php 
session_start();
$user = "iwang1";$pass = "1234";$host = 'localhost';

$dungun = "onewscom_s_dungun";
$keratong = "onewscom_s_kerato";
$kemaman = "onewscom_s_kemama";
$muadzam = "onewscom_s_muadza";

$membership = "onewscom_memship";

$spe_dungun = mysqli_connect($host,$user,$pass, true);
$spe_kemaman = mysqli_connect($host,$user,$pass, true);
$spe_keratong = mysqli_connect($host,$user,$pass, true);
$spe_muadzam = mysqli_connect($host,$user,$pass, true);
$membership_db = mysqli_connect($host,$user,$pass, true);

mysqli_select_db($dungun, $spe_dungun);
mysqli_select_db($membership, $membership_db);

echo mysqli_query("SELECT count(*) FROM tbl_log");


?>