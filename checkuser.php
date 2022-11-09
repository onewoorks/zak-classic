<?php 
//session_start();
include('includes/functions.php');
echo  $_GET['us_name']." dan ".$_GET['us_pass'];
checkuser($_GET['us_name'],$_GET['us_pass']);

?>