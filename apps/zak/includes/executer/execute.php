<?php

session_start();
include_once('../../model/functions.php');
checkme();
$uid = $_SESSION['uid'];
switch ($_GET['t']) {
    case 1;
        $a = $_GET['a'];
        $b = $_GET['b'];
        $c = $_GET['c'];
        $d = $_GET['d'];
        if ($d == 1) {
            $e = (0 - $_GET['e']);
            $f = (0 - $_GET['f']);
            $h = $_GET['g'];
        } else {
            $e = $_GET['e'];
            $f = $_GET['f'];
            $h = 0;
        }
        $g = getcawangan($b);
        mysqli_query("INSERT INTO tbl_alirantunai VALUES ('',now(),'$a','$d','$c','$f','$e','$b','$g','$uid', '$h')");
        //mysqli_query("INSERT INTO tbl_emas (tm_id, tm_timestamp, m_id, tm_berat, tm_nilai, usr_id, stf_id) SELECT tm_id, tm_timestamp, m_id, tm_berat, tm_nilai, usr_id, stf_id FROM tbl_tmp_emas WHERE usr_id = '$uid'");
        //mysqli_query("DELETE FROM tbl_tmp_emas WHERE usr_id='$uid'");
        break;
    case 2;
        $berat = $_GET['a'];
        $mutu = $_GET['b'];
        $nilai = $_GET['c'];
        $staf = $_GET['d'];
        mysqli_query("INSERT INTO tbl_tmp_emas VALUES ('',now(),'$mutu','$berat','$nilai','$uid','$staf')");
        $a = mysqli_query("SELECT * FROM tbl_tmp_emas WHERE usr_id='$uid'");
        echo "<div class='col lbl'>Senarai Emas</div>";
        echo "<div class='col lda'>";
        while ($b = mysqli_fetch_array($a)) {
            echo "<div>" . $b['m_id'] . ' ' . $b['tm_berat'] . ' ' . $b['tm_nilai'] . "</div>";
        }
        echo "</div>";
        break;
    case 3;
        mysqli_query("UPDATE tbl_user SET usr_login='0' WHERE usr_id='$uid'");
        include('_logout.php');
        break;
    case 4;
        $a = trim($_GET['a']);
        $b = $_GET['b'];
        $c = $_GET['c'];
        $d = $_GET['d'];
        $f = $_GET['f'];
        $g = $_GET['g'];
        $h = $_GET['h'];
        $i = $_GET['i'];
        mysqli_query("INSERT INTO tbl_cawangan VALUES('','$a','$b','$c','$d','$uid','0')");
        if ($f == 0) {
            $aq = mysqli_query("SELECT caw_id FROM tbl_cawangan WHERE caw_head='$a'");
            while ($bq = mysqli_fetch_array($aq)) {
                $j = $bq['caw_id'];
            }
            mysqli_query("INSERT INTO tbl_ahli VALUES ('','$g','$d','$i','$h','$j','$uid','0')");
        }
        echo "Pendaftaran Selesai";
        break;
    case 5;
        showupdatekakitangan($_GET['a']);
        break;
    case 6;
        $a = $_GET['sn'];
        $b = $_GET['st'];
        $c = $_GET['sa'];
        $d = $_GET['ci'];
        $e = $_GET['bi'];
        mysqli_query("INSERT INTO tbl_ahli VALUES ('','$a','$b','$e','$c','$d','$uid','0')");
        break;
    case 7; //semak cawangan
        $cari = $_GET['a'];
        $semak = new transaksi;
        $semak->resultsemakan($cari);
        break;
    case 8;
        $a = $_GET['a'];
        mysqli_query("DELETE FROM tbl_alirantunai WHERE at_id='$a'");
        echo $_GET['a'] . "### Maklumat aliran tunai telah dibuang dari sistem.";
        break;
    case 9;
        $mula = $_GET['x'];
        $akhir = $_GET['y'];
        $caw = $_GET['z'];
        $mex = explode('-', $mula);
        $aex = explode('-', $akhir);

        $start = $mex[2] . '-' . $mex[0] . '-' . $mex[1] . ' 00:00:00';
        $end = $aex[2] . '-' . $aex[0] . '-' . $aex[1] . ' 23:59:59';
        if ($caw != 0) {
            $whereSelect = "caw_id='$caw' and";
        } else {
            $whereSelect = "";
        }

        $sql = "SELECT * FROM tbl_alirantunai WHERE $whereSelect at_timeDate BETWEEN '$start' AND '$end' AND caw_id='$caw' ORDER BY at_timeDate ASC";
        $v = mysqli_query("SELECT at_kategori, at_jumlah, at_guna FROM tbl_alirantunai WHERE at_timeDate < '$start' AND caw_id='$caw' ");
        $balDariAwal = 0;
        $keluarDariAwal = 0;
        $emasAwal = 0;
        $emasNilaiAwal = 0;
        while ($h = mysqli_fetch_array($v)):
            if ($h['at_kategori'] == 1):
                $balDariAwal += $h['at_jumlah'] + $h['at_guna'];
            else:
                $keluarDariAwal += $h['at_jumlah'] + $h['at_guna'];
            endif;
            $emasAwal += $h['at_beratEmas'];
            $emasNilaiAwal += $h['at_guna'];
        endwhile;

        $resultTerdahulu = array('1', $start, 'Baki Terdahulu', $balDariAwal, $keluarDariAwal);
        $masukBaru = 0 + $resultTerdahulu[3];
        $keluarBaru = 0 + $resultTerdahulu[4];

        $a = mysqli_query($sql);
        $result = array();
        $baki = 0;
        $totBaki = 0;
        $i = 1;
        $emasBeratPilih = 0;
        $emasNilaiPilih = 0;

        $duitMasukIkutPilih = 0;
        $duitKeluarIkutPilih = 0;

        while ($b = mysqli_fetch_array($a)) :
            $result[] = $b;
        endwhile;
        echo "<table id='table-data' style='width:100%; border-collapse: collapse;' class='small'>";
        echo "<thead>";
        echo "<tr style='border-bottom:1px solid #ccc;'>";
        echo "<th class='no1'>No</th>";
        echo "<th class='no8 bbleft'>Tarikh Dan Masa</th>";
        echo "<th class='no2 bbleft'>Perkara</th>";
        echo "<th class='no2 bbleft'>Staf</th>";
        echo "<th class='bbleft no7'>Masuk</th>";
        echo "<th class='bbleft no7'>Keluar</th>";
        echo "<th class='bbleft no7'>Berat</th>";
        echo "<th class='bbleft no7'>Nilai Emas</th>";
        echo "<th class='bbleft no4'>Baki</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($result as $r):
            echo "<tr style='border-bottom:1px solid #ccc;'>";
            echo "<td>" . $i++ . "</td>";
            echo "<td class='bbleft'>" . $r['at_timeDate'] . "</td>";
            echo "<td class='bbleft'>" . $r['at_perkara'] . "</td>";
            echo "<td class='bbleft'>" . getahliname($r['stf_id']) . "</td>";

            switch ($r['at_kategori']):
                case '1':
                    $baki = curr($r['at_guna'] + $r['at_jumlah']);
                    $totBaki = $totBaki + (($r['at_guna'] + $r['at_jumlah']));
                    $masukBaru += $r['at_jumlah'] + $r['at_guna'];
                    $nilaimasuk = $nilaimasuk + $r['at_jumlah'] + $r['at_guna'];
                    $duitMasukIkutPilih += $r['at_jumlah'];
                    echo "<td class='tright bbleft'>" . number_format($r['at_jumlah'], 2, '.', ',') . '</td>';
                    echo '<td></td>';
                    break;
                case '2':
                    $baki = "(" . curr($r['at_jumlah'] + $r['at_guna']) . ")";
                    $totBaki = $totBaki - ($r['at_jumlah'] + $r['at_guna']);
                    $keluarBaru += $r['at_jumlah'];
                    $nilaikeluar = $nilaikeluar + $r['at_jumlah'] + $r['at_guna'];
                    $duitKeluarIkutPilih += $r['at_jumlah'];
                    echo '<td class="bbleft"></td>';
                    echo "<td class='tright'>" . number_format($r['at_jumlah'], 2, '.', ',') . '</td>';
                    break;
            endswitch;
            echo "<td class='bbleft tright'>";
            if ($r['at_beratEmas'] > 0):
                echo curr($r['at_beratEmas']);
                $emasBeratPilih += $r['at_beratEmas'];
            endif;
            echo "</td>";
            echo "<td class='tright border-right'>";
            if ($r['at_guna'] > 0) {
                echo curr($r['at_guna']);
                $emasNilaiPilih += $r['at_guna'];
            }
            echo "</td>";
            echo "<td class='tright bbleft'>" . $baki . "</td>";
            echo "</tr>";
        endforeach;
        echo "<tr style='font-weight:bold;'>";
        echo "<td colspan='4'  class='border-right'></td>";
        echo "<td class='tright bbleft'>" . curr($duitMasukIkutPilih) . "</td>";
        echo "<td class='tright'>" . curr($duitKeluarIkutPilih) . "</td>";
        echo "<td class='bbleft tright'>" . curr($emasBeratPilih) . "</td>";
        echo "<td class='border-right tright'>" . curr($emasNilaiPilih) . "</td>";
        echo "<td class='tright bbleft'>" . curr($masukBaru - $keluarBaru) . "</td>";
        echo "</tr>";


        echo "</tbody>";
        echo "</table>";

        echo "<br />";
        echo "<table style='border:1px solid #ccc; width:60%; border-collapse: collapse; '>";
        echo "<thead>";
        echo "<tr style='border:1px solid #ccc;'>";
        echo "<th colspan='3'>Maklumat Keseluruhan</th>";
        echo "<th colspan='3' class='bbleft'>Maklumat Mengikut Tarikh Pilihan</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tr>";
        echo "<td style=''>Jumlah Masuk Sehingga Tarikh Akhir</td>";
        echo "<td>:</td>";
        echo "<td class='tright'>" . curr($masukBaru) . "</td>";
        echo "<td class='bbleft'>Jumlah Masuk</td>";

        if ($caw == 37):
            echo "<td>:</td>";
            echo "<td class='tright'>" . curr($nilaimasuk) . "</td>";
        else:
            echo "<td>:</td>";
            echo "<td class='tright'>" . curr($emasNilaiPilih) . "</td>";
        endif;

        echo "</tr>";
        echo "<tr style='border-bottom:1px solid #ccc;'>";
        echo "<td>Jumlah Keluar Sehingga Tarikh Akhir</td>";
        echo "<td>:</td>";
        echo "<td class='tright'>" . curr($keluarBaru) . "</td>";
        echo "<td class='bbleft'>Jumlah Keluar</td>";
        echo "<td>:</td>";
        echo "<td class='tright'>" . curr($nilaikeluar) . "</td>";
        echo "</tr>";
        echo "<tr style='border-bottom:1px solid #ccc; font-weight:bold;'>";
        echo "<td>Baki</td>";
        echo "<td>:</td>";
        echo "<td class='tright'>" . curr($masukBaru - $keluarBaru) . "</td>";
        echo "<td class='bbleft'></td>";
        echo "<td></td>";
        echo "<td class='tright'></td>";
        echo "</tr>";
        echo "</table>";

        $start = $mex[2] . '-' . $mex[0] . '-' . $mex[1];
        $end = $aex[2] . '-' . $aex[0] . '-' . $aex[1];
        $url = "cetak?rekod=transaksi&cawangan=$caw&start=$start&end=$end";
        echo "<button onclick='cetakMaklumat(\"$url\");'>Cetak</button>";
        break;
    case 10;
        $a = $_GET['a'];
        mysqli_query("UPDATE tbl_cawangan set caw_stat='1' WHERE caw_id='$a' ");
        echo $_GET['a'] . "### Maklumat cawangan telah dikeluarkan dari sistem.";
        break;
    case 11;
        $a = $_GET['a'];
        mysqli_query("UPDATE tbl_ahli set stf_stat='1' WHERE stf_id='$a' ");
        echo $_GET['a'] . "### Maklumat ahli dalam cawangan telah dikeluarkan dari sistem.";
        break;

    case 18;
        $mula = $_REQUEST['stardate'];
        $akhir = $_GET['y'];
        $caw = $_GET['z'];
        $mex = explode('-', $mula);
        $aex = explode('-', $akhir);

        $start = $mex[2] . '-' . $mex[0] . '-' . $mex[1];
        $end = $aex[2] . '-' . $aex[0] . '-' . $aex[1];
        if ($caw != 0) {
            $whereSelect = "caw_id='$caw' and";
        } else {
            $whereSelect = "";
        }

        $sql = "SELECT * FROM tbl_alirantunai WHERE $whereSelect (DATE(at_timeDate) BETWEEN '$start' AND '$end') AND caw_id='$caw' ORDER BY at_timeDate ASC";
        $sql2 = "SELECT at_kategori, at_jumlah, at_guna FROM tbl_alirantunai WHERE (DATE(at_timeDate) BETWEEN '$start' AND '$end') AND caw_id='$caw' ";
        $v = mysqli_query($sql2);
        $balDariAwal = 0;
        $keluarDariAwal = 0;
        $emasAwal = 0;
        $emasNilaiAwal = 0;
        while ($h = mysqli_fetch_array($v)):
            if ($h['at_kategori'] == 1):
                $balDariAwal += $h['at_jumlah'] + $h['at_guna'];
            else:
                $keluarDariAwal += $h['at_jumlah'] + $h['at_guna'];
            endif;
            $emasAwal += $h['at_beratEmas'];
            $emasNilaiAwal += $h['at_guna'];
        endwhile;

        $resultTerdahulu = array('1', $start, 'Baki Terdahulu', $balDariAwal, $keluarDariAwal);
        $masukBaru = 0 + $resultTerdahulu[3];
        $keluarBaru = 0 + $resultTerdahulu[4];

        $a = mysqli_query($sql);
        $result = array();
        $baki = 0;
        $totBaki = 0;
        $i = 1;
        $emasBeratPilih = 0;
        $emasNilaiPilih = 0;

        $duitMasukIkutPilih = 0;
        $duitKeluarIkutPilih = 0;

        while ($b = mysqli_fetch_array($a)) :
            $result[] = $b;
        endwhile;
        echo "<table id='table-data' style='width:100%; border-collapse: collapse;' class='small'>";
        echo "<thead>";
        echo "<tr style='border:1px solid #ccc;'>";
        echo "<th class='no1'>No</th>";
        echo "<th class='no8 bbleft'>Tarikh Dan Masa</th>";
        echo "<th class='no2 bbleft'>Perkara</th>";
        echo "<th class='no2 bbleft'>Staf</th>";
        echo "<th class='bbleft no7'>Masuk</th>";
        echo "<th class='bbleft no7'>Keluar</th>";
        echo "<th class='bbleft no7'>Berat</th>";
        echo "<th class='bbleft no7'>Nilai Emas</th>";
        echo "<th class='bbleft no4'>Baki</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($result as $r):
            echo "<tr style='border-bottom:1px solid #ccc;'>";
            echo "<td class='bbleft'>" . $i++ . "</td>";
            echo "<td class='bbleft'>" . $r['at_timeDate'] . "</td>";
            echo "<td class='bbleft'>" . $r['at_perkara'] . "</td>";
            echo "<td class='bbleft'>" . getahliname($r['stf_id']) . "</td>";

            switch ($r['at_kategori']):
                case '1':
                    $baki = curr($r['at_guna'] + $r['at_jumlah']);
                    $totBaki = $totBaki + (($r['at_guna'] + $r['at_jumlah']));
                    $masukBaru += $r['at_jumlah'] + $r['at_guna'];
                    $nilaimasuk = $nilaimasuk + $r['at_jumlah'] + $r['at_guna'];
                    $duitMasukIkutPilih += $r['at_jumlah'];
                    echo "<td class='tright bbleft'>" . number_format($r['at_jumlah'], 2, '.', ',') . '</td>';
                    echo '<td></td>';
                    break;
                case '2':
                    $baki = "(" . curr($r['at_jumlah'] + $r['at_guna']) . ")";
                    $totBaki = $totBaki - ($r['at_jumlah'] + $r['at_guna']);
                    $keluarBaru += $r['at_jumlah'];
                    $nilaikeluar = $nilaikeluar + $r['at_jumlah'] + $r['at_guna'];
                    $duitKeluarIkutPilih += $r['at_jumlah'];
                    echo '<td class="bbleft"></td>';
                    echo "<td class='tright'>" . number_format($r['at_jumlah'], 2, '.', ',') . '</td>';
                    break;
            endswitch;
            echo "<td class='bbleft tright'>";
            if ($r['at_beratEmas'] > 0):
                echo curr($r['at_beratEmas']);
                $emasBeratPilih += $r['at_beratEmas'];
            endif;
            echo "</td>";
            echo "<td class='tright border-right'>";
            if ($r['at_guna'] > 0) {
                echo curr($r['at_guna']);
                $emasNilaiPilih += $r['at_guna'];
            }
            echo "</td>";
            echo "<td class='tright bbleft'>" . $baki . "</td>";
            echo "</tr>";
        endforeach;
        echo "<tfoot>";
        echo "<tr style='border:1px solid #ccc;font-weight:bold;'>";
        echo "<td colspan='4'  class='border-right'></td>";
        echo "<td class='tright bbleft'>" . curr($duitMasukIkutPilih) . "</td>";
        echo "<td class='tright'>" . curr($duitKeluarIkutPilih) . "</td>";
        echo "<td class='bbleft tright'>" . curr($emasBeratPilih) . "</td>";
        echo "<td class='border-right tright'>" . curr($emasNilaiPilih) . "</td>";
        echo "<td class='tright bbleft'>" . curr($totBaki) . "</td>";
        echo "</tr>";
        echo "</tfoot>";


        echo "</tbody>";
        echo "</table>";

        echo "<br />";
        echo "<table style='border:1px solid #ccc; width:40%; border-collapse: collapse; '>";
        echo "<thead>";
        echo "<tr style='border:1px solid #ccc;'>";
        // echo "<th colspan='3'>Maklumat Keseluruhan</th>";
        echo "<th colspan='3' class='bbleft'>Maklumat Mengikut Tarikh Pilihan</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tr>";
        //  echo "<td style=''>Jumlah Masuk Sehingga Tarikh Akhir</td>";
        //  echo "<td>:</td>";
        //  echo "<td class='tright'>" . curr($masukBaru) . "</td>";
        echo "<td class='bbleft'>Jumlah Masuk</td>";

        if ($caw == 37):
            echo "<td>:</td>";
            echo "<td class='tright'>" . curr($nilaimasuk) . "</td>";
        else:
            echo "<td>:</td>";
            echo "<td class='tright'>" . curr($emasNilaiPilih) . "</td>";
        endif;

        echo "</tr>";
        echo "<tr style='border-bottom:1px solid #ccc;'>";
        //echo "<td>Jumlah Keluar Sehingga Tarikh Akhir</td>";
        //echo "<td>:</td>";
        //echo "<td class='tright'>" . curr($keluarBaru) . "</td>";
        echo "<td class='bbleft'>Jumlah Keluar</td>";
        echo "<td>:</td>";
        echo "<td class='tright'>" . curr($nilaikeluar) . "</td>";
        echo "</tr>";
        echo "<tr style='border-bottom:1px solid #ccc; font-weight:bold;'>";
        // echo "<td>Baki</td>";
        // echo "<td>:</td>";
        //echo "<td class='tright'>" . curr($masukBaru - $keluarBaru) . "</td>";
        echo "<td class='bbleft'></td>";
        echo "<td></td>";
        echo "<td class='tright'>" . curr($totBaki) . "</td>";
        echo "</tr>";
        echo "</table>";

        echo '<br>';
        $start = $mex[2] . '-' . $mex[0] . '-' . $mex[1];
        $end = $aex[2] . '-' . $aex[0] . '-' . $aex[1];
        $url = "cetak?rekod=transaksi&cawangan=$caw&start=$start&end=$end";
        echo "<button onclick='cetakMaklumat(\"$url\");'>Cetak</button>";
        break;

    case 19:
        $datestart = $_GET['datestart'];
        $dateend = $_GET['dateend'];
        
        $sqlStarDate = RearrangeDate($datestart);
        $sqlEndDate = RearrangeDate($dateend);
        
        $laporan = new transaksi;
        $laporan->tarikhStart = $sqlStarDate;
        $laporan->tarikhAkhir =  $sqlEndDate;
        $laporan->bulanan('pilihan');
        break;
    default:
        break;
}
?>