<?php

session_start();
include('../functions.php');
checkme();

$db = new Connection();

$uid = (int) $_SESSION['uid'];
switch ($_GET['t']) {
    case 1;
        $a = $_GET['a'];
        $b = $_GET['b'];
        $c = $_GET['c'];
        $d = $_GET['d'];
        if ($d == 1) {
            $e = (float) ($_GET['e']);
            $f = (float) ($_GET['f']);
            $h = $_GET['g'];
        } else {
            $e = (float) $_GET['e'];
            $f = (float) $_GET['f'];
            $h = 0;
        }
        $g = getcawangan($b);
        $db->execute("INSERT INTO tbl_alirantunai 
            (at_timeDate, at_perkara, at_kategori, at_jumlah, at_guna, at_beratEmas, stf_id, caw_id, usr_id, at_zak, ref_ab_id)
            VALUES (now(),'$a','$d','$c',$f,'$e',$b,$g,$uid, $h,NULL)");
        break;
    case 2;
        $berat = $_GET['a'];
        $mutu = $_GET['b'];
        $nilai = $_GET['c'];
        $staf = $_GET['d'];
        $db->execute("INSERT INTO tbl_tmp_emas VALUES ('',now(),'$mutu','$berat','$nilai','$uid','$staf')");
        $a = $db->execute("SELECT * FROM tbl_tmp_emas WHERE usr_id='$uid'");
        echo "<div class='col lbl'>Senarai Emas</div>";
        echo "<div class='col lda'>";
        while ($b = mysqli_fetch_array($a)) {
            echo "<div>" . $b['m_id'] . ' ' . $b['tm_berat'] . ' ' . $b['tm_nilai'] . "</div>";
        }
        echo "</div>";
        break;
    case 3;
        $db->execute("UPDATE tbl_user SET usr_login='0' WHERE usr_id='$uid'");
        include_once('_logout.php');

        //file_get_contents();
        break;
    case 4;
        $a = trim($_GET['a']);
        $b = $_GET['b'];
        $c = $_GET['c'];
        $d = $_GET['d'];
        $f = isset($_GET['f']) ? $_GET['f'] : '';
        $g = isset($_GET['g']) ? $_GET['g'] : '';
        $h = isset($_GET['h']) ? $_GET['h'] : '';
        $i = isset($_GET['i']) ? (int) $_GET['i'] : 0;
        $u_id = (int) $uid;
        $db->execute("INSERT INTO tbl_cawangan 
        (caw_head, caw_nama, caw_alamat, caw_tel, usr_id, caw_stat)
        VALUES('$a','$b','$c','$d',$u_id,0)");
        if ($f == 0) {
            $aq = $db->execute("SELECT caw_id FROM tbl_cawangan WHERE caw_head='$a'");
            while ($bq = mysqli_fetch_array($aq)) {
                $j = (int) $bq['caw_id'];
            }
            $db->execute("INSERT INTO tbl_ahli 
            (stf_nama, stf_tel, bank_id, stf_akaun, caw_id, usr_id, stf_stat)
            VALUES ('$g','$d',$i,'$h',$j,$u_id,0)");
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
        $db->execute("INSERT INTO tbl_ahli 
        (stf_nama, stf_tel, bank_id, stf_akaun, caw_id, usr_id, stf_stat)
        VALUES ('$a','$b','$e','$c',$d,$uid,0)");
        break;
    case 7; //semak cawangan
        $cari = $_GET['a'];
        $semak = new transaksi;
        $semak->resultsemakan($cari);
        break;
    case 8;
        $a = $_GET['a'];
        $db->execute("DELETE FROM tbl_alirantunai WHERE at_id='$a'");
        $db->execute("DELETE FROM aliranbank WHERE ref_at_id='$a'");
        echo $_GET['a'] . "### Maklumat aliran tunai telah dibuang dari sistem.";
        break;
    case 9;
        $mula = $_GET['x'];
        $akhir = $_GET['y'];
        $caw = $_GET['z'];
        $mex = explode('-', $mula);
        $mexa = $mex[2] . '-' . $mex[0] . '-' . $mex[1] . ' 00:00:00';
        $aex = explode('-', $akhir);
        $aexa = $aex[2] . '-' . $aex[0] . '-' . $aex[1] . ' 23:59:59';
        if ($caw != 0) {
            $whereSelect = "caw_id='$caw' and";
        } else {
            $whereSelect = "";
        }
        $a = $db->execute("SELECT * FROM tbl_alirantunai WHERE $whereSelect  at_timeDate BETWEEN '$mexa' AND '$aexa'");
        $h = $db->execute("SELECT at_jumlah FROM tbl_alirantunai WHERE at_timeDate <= '$aexa' AND caw_id='$caw'");
        $tunaiBayar = 0;
        while($j = mysqli_fetch_array($h)):
            $tunaiBayar += $j['at_jumlah'];
        endwhile;
        
        echo "<b><div>";
        echo "<div class='col no1'>No</div>";
        echo "<div class='col no8'>Tarikh dan Masa</div>";
        echo "<div class='col no2'>Perkara</div>";
        echo "<div class='col no2'>Staf</div>";
        echo "<div class='col no7 cen'>Masuk</div>";
        echo "<div class='col no7 cen'>Keluar</div>";
        echo "<div class='col no7 cen'>Berat (g)</div>";
        echo "<div class='col no7 cen'>Nilai</div>";
        echo "<div class='col no4 cen'>Baki</div>";
        echo "<div class='clear line'></div>";
        echo "</div></b>";
        $i = 1;
        $nilaimasuk = 0;
        $nilaikeluar = 0;
        while ($b = mysqli_fetch_array($a)) {
            echo "<div class='data small'>";
            echo "<div class='col no1'>" . $i++ . "</div>";
            echo "<div class='col no8'>" . $b['at_timeDate'] . "</div>";
            echo "<div class='col no2'>" . ptext($b['at_perkara']) . "</div>";
            echo "<div class='col no2'>" . ptext(getahliname($b['stf_id'])) . "</div>";
            if ($b['at_kategori'] == 1) {
                $n = curr($b['at_jumlah']);
                $m = "";
                $baki = "(" . curr((($b['at_guna'] - $b['at_jumlah']) * -1)) . ")";
                $nilai = $nilai + ($b['at_guna'] - $b['at_jumlah']);
                $nilaimasuk = $nilaimasuk + $b['at_jumlah'];
            } else {
                $n = "";
                $m = curr($b['at_jumlah']);
                $baki = curr(($b['at_jumlah'] - $b['at_guna']));
                $nilai = $nilai + ($b['at_guna'] - $b['at_jumlah']);
                $nilaikeluar = $nilaikeluar + $b['at_jumlah'];
            }
            echo "<div class='col no7 tright bleft'>" . $n . "&nbsp;</div>";
            echo "<div class='col no7 tright'>" . $m . "&nbsp;</div>";
            echo "<div class='col no7 tright bleft'>";
            if ($b['at_beratEmas'] > 0) {
                echo $b['at_beratEmas'];
            }
            echo "&nbsp;</div>";
            echo "<div class='col no7 tright'>";
            if ($b['at_guna'] > 0) {
                echo curr($b['at_guna']);
            }
            echo "&nbsp;</div>";
            echo "<div class='col no4 tright bleft'>" . $baki . "&nbsp;</div>";
            if (($i) == $c) {
                echo "<div class='clear dotted'></div>";
            } else {
                echo "<div class='clear line'></div>";
            }
            echo "</div>";
        }
        echo "<b><div class='small'>";
        echo "<div class='col no1'>&nbsp;</div>";
        echo "<div class='col no8'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no7 tright bbleft'>" . curr($tunaiBayar) . "&nbsp;</div>";
        echo "<div class='col no7 tright'>" . curr($nilaikeluar) . "&nbsp;</div>";
        echo "<div class='col no7 tright bbleft'>&nbsp;</div>";
        echo "<div class='col no7 cen'>&nbsp;</div>";
        echo "<div class='col no4 tright bbleft'>&nbsp;</div>";
        echo "<div class='clear'></div>";
        echo "</div></b>";
        echo "<div class='col no3'>Jumlah Masuk</div>";
        echo "<div class='col no4 tright'>" . curr($nilaimasuk) . "</div>";
        echo "<div class='clear'></div>";
        echo "<div class='col no3'>Jumlah Keluar</div>";
        echo "<div class='col no4 tright'>" . curr($nilaikeluar) . "</div>";
        echo "<div class='clear line'></div>";
        echo "<div class='col no3'>Baki</div>";
        echo "<div class='col no4 tright'>" . curr($nilaimasuk - $nilaikeluar) . "</div>";
        echo "<div class='clear'></div>";
        echo "<br />";
        $url = "?cawangan=$caw&start=$mex[2] . '-' . $mex[0] . '-' . $mex[1]&end=$aex[2] . '-' . $aex[0] . '-' . $aex[1]";
        echo "<button onclick='cetakMaklumat(\"$url\");'>Cetak</button>";
        break;
    case 10;
        $a = $_GET['a'];
        $db->execute("UPDATE tbl_cawangan set caw_stat='1' WHERE caw_id='$a' ");
        echo $_GET['a'] . "### Maklumat cawangan telah dikeluarkan dari sistem.";
        break;
    case 11;
        $a = $_GET['a'];
        $db->execute("UPDATE tbl_ahli set stf_stat='1' WHERE stf_id='$a' ");
        echo $_GET['a'] . "### Maklumat ahli dalam cawangan telah dikeluarkan dari sistem.";
        break;
    default:
        break;
}
?>