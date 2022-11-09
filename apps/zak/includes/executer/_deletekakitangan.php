<?php
include('../config.php');
include('../functions.php');

function deletekakitangan($x){
	$y = explode('#',$x);
	mysqli_query("DELETE FROM tbl_ahli WHERE stf_id=$y[1]");
}

deletekakitangan($_GET['a']);
showupdatekakitangan($_GET['b']);

?>