<?
include('../config.php');
include('../functions.php');

function banklength($x){
	$a = mysqli_query("SELECT bank_length FROM tbl_banklist WHERE bank_id=$x");
	while($b=mysqli_fetch_array($a)){
		return $b['bank_length'];
	}
}

echo banklength($_GET['a']);

?>