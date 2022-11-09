<?php 
session_start(); 
include('../functions.php');

switch($_GET['p']){
	case 1;
		include('uruscawangan.php');
		break;
	case 2;
		include('urusstaff.php');
		break;
	case 3;
		include('transaksi.php');
		break;
	case 4;
		include('rekodtrans.php');
		break;
	case 5;
		break;
	case 6;
		include('laporanbulanan.php');
		break;
	case 7;
		include('daftarcawangan.php');
		break;
	case 8;
		include('daftarahli.php');
		break;
	case 9;
		$rekodcawangan = new transaksi;
		$rekodcawangan->setiapcawangan();
		break;
	case 10: include('home.php'); break;
    case 11;
        include('buangalirantunai.php');
        break;
	case 12;
		echo '<h2>Senarai Cawangan</h2>';        
		echo '<div id="caw_list">';
    	listcawangan(2);
		echo '</div>';
		break;
	case 13;
		echo '<h2>Senarai Kakitangan</h2>';
		echo '<div>Kakitangan Cawangan : </div>';
		echo '<div>'.senaraicawangan().'</div>';
		echo '<div id="stf_list">';
		liststaff(2);
		echo '</div>';
		echo '<div style="margin-bottom:10px"></div>';
		break;
	case 14;
		echo '<h2>Rekod Transaksi Hari Ini - '.date("j F Y").'</h2>';
		$rekodharian = new transaksi;
		$today = date("Y-m-d")."%";
		$rekodharian->harian($today);
		break;
case 15;
	include('userprofile.php');
break;
	default:
 		break;
}

?>