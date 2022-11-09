<?php

session_start();

switch ($_GET['a']) {
    case 1;
        include('../modules/transaksi/dungun.php');
        break;
    case 2;
        break;
    case 3;
        break;
    case 4;
        break;
    case 5;
        break;
    case 6;
        break;
    case 7;
        break;
    
    case 11;
        //include('../modules/keahlian/pagination.php');
        include('../../../../pagination.php');
        break;
    default:
        break;
}
?>