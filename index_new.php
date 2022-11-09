<?php 
session_start();
//include('obs.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="scripts/appsDesign.css" rel="stylesheet" type="text/css" />
<link href="scripts/design.css" rel="stylesheet" type="text/css" />
<link href="scripts/cal.css" rel="stylesheet" type="text/css" />
<script src="jx.php?js=ajax_fm.js" type="text/javascript" language="javascript"></script>
<script src="jx.php?js=javascript.js" type="text/javascript" language="javascript"></script>
<script src='jx.php?js=cal.js' type="text/javascript" language="javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAK Online System v1</title>
</head>

<body>
<?php 

if ($_SESSION['uid']==''){
	session_name();
	include('login.php');
	} else {
	include('includes/config.php');
	include('includes/functions.php');
 	//include('mainmenu.php');
	 
	//include('includes/menu.php');
	} 


if($_SESSION['uid']!=''){
	echo "<div class='topbar'>";
	echo "<div class='texl activeApp' onclick='apps(1)'>Zak</div>";
	echo "<div class='texl normalApp'>Sistem Pengurusan Emas</div>";
	echo "<div class='texl normalApp'>Membership Program</div>";
	echo "<div class='texl normalApp' onclick='apps(4)'>Harga Emas</div>";
	echo "<div class='tex lk' onclick=\"logout()\">Daftar Keluar</div>";
	echo "<div class='tex nopad'>|</div>";
	//echo "<div class='tex lk' >Tetapan Sistem Ini</div>";
	//echo "<div class='tex'>|</div>";
	echo "<div class='tex lk' onclick='pagemenu(15)' >Profile</div>";
	//echo "<div class='tex'>|</div>";
	//echo "<div class='tex lk' >Laporan Kerosakan</div>";
	//echo "<div class='tex'>|</div>";
	echo "<div class='tex'><b>".username($_SESSION['uid'])."</b></div>";
	echo "<div class='clear'></div>";
	echo "</div>";
	echo "<input type='hidden' id='useridname' value=".$_SESSION['uid']." />";
	}
?>

<div id='user'></div>
</body>
</html>
