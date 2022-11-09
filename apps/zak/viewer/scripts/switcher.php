<?php

session_start();
include('../../model/functions.php');
switch ($_GET['p']) {
    case 1; include('../../controller/uruscawangan.php');break;
    case 2; include('../../viewer/pages/urusstaff.php');break;
    case 3; include('../../viewer/pages/transaksi.php');break;
    case 4; include('../../viewer/pages/rekodtrans.php');break;
    case 5; break;
    case 6;
        include('../../viewer/pages/laporanbulanan.php');
        break;
    case 7;include('../../viewer/pages/daftarcawangan.php');
        break;
    case 8;
        include('../../viewer/pages/daftarahli.php');
        break;
    case 9;
        $rekodcawangan = new transaksi;
        $rekodcawangan->setiapcawangan();
        break;
    case 10: include('../../viewer/pages/home.php');
        break;
    case 11;
        include('../../viewer/pages/buangalirantunai.php');
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
        echo '<div>' . senaraicawangan() . '</div>';
        echo '<div id="stf_list">';
        liststaff(2);
        echo '</div>';
        echo '<div style="margin-bottom:10px"></div>';
        break;
    case 14;
        echo '<h2>Rekod Transaksi Hari Ini - ' . date("j F Y") . '</h2>';
        $rekodharian = new transaksi;
        $today = date("Y-m-d") . "%";
        $rekodharian->harian($today);
        break;
    case 15;
        include('../../viewer/pages/userprofile.php');
        break;
    case '16':
        include('../../viewer/pages/daftarAliranBank.php');
        break;
    case 17:
        include('../../viewer/pages/transaksiBank.php');
        break;
    case '18':
        include('../../viewer/pages/baki-terakhir.php');
        break;
    default:
        break;
}
?>