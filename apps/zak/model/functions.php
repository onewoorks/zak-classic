<?php

//session_start();
include_once 'config.php';
// include_once 'includes/config.php';

$db = new Connection();
function textlen($x, $y) {
    $a = strlen($x);
    if ($a > $y) {
        $bb = '';
        $ba = str_split($x);
        for ($i = 0; $i <= $y; $i++) {
            $bb = $bb . $ba[$i];
        }
        $b = $bb . "...";
    } else {
        $b = $x;
    }
    return $b;
}

function checkme() {
    $uid = $_SESSION['uid'];
    if (strlen($uid) < 2) {
        $sname = $_SERVER['REQUEST_URI'];
        $sip = $_SERVER['REMOTE_ADDR'];
        if (strlen($sname) > 5) {
            //echo "Nice Try...";
            global $db;
            $db->execute("INSERT INTO track_ip VALUES ('',now(),'$sip','$sname',2)");
        }
    }
}

function ptext($x) {
    return ucwords(strtolower($x));
}

function curr($x) {
    return number_format((float) $x, 2, '.', ',');
}

function zeronum($x) {
    $a = strlen($x);
    switch ($a) {
        case 1;
            return "000" . $x;
            break;
        case 2;
            return "00" . $x;
            break;
        case 3;
            return "00" . $x;
            break;
        default: return $x;
    }
}

//function checkuser($x,$y){
//	$z = $y;
//	$a = $db->execute("SELECT usr_id FROM tbl_user WHERE usr_name='$x' and usr_password='$z'");
global $db;
//	$b = mysqli_num_rows($a);
//	if($b == 1){
//		while($c=mysqli_fetch_array($a)){
//			$_SESSION['uid'] = $c['usr_id'];
//			$uid = $_SESSION['uid'];
//			//echo $_SESSION['uid'];
global $db;
//			$db->execute("UPDATE tbl_user SET usr_login='1' WHERE usr_id='$uid'");
//		}
//	} else {
//			echo include('pages/relogin.php');
//		}
//}
function namacawangan($x) {
    global $db;
    $a = $db->execute("SELECT caw_head FROM tbl_cawangan WHERE caw_id=$x");
    while ($b = mysqli_fetch_array($a)) {
        return $b['caw_head'];
    }
}

function searchcaw() {
    $a = $_GET['a'] . "%";
    global $db;
    $b = $db->execute("SELECT caw_head FROM tbl_cawangan WHERE caw_head LIKE '$a' and caw_stat=0");
    $c = mysqli_num_rows($b);
    if ($c > 0) {
        while ($c = mysqli_fetch_array($b)) {
            echo "<div onClick='selectresult(this.innerHTML)' id='searchvalue' >" . ucwords(strtolower($c['caw_head'])) . "</div>";
        }
    } else {
        echo $c;
    }
}

function listcawangan($x) {
    echo "<b><div class='col no1'>No</div>";
    echo "<div class='col no4'>Id Cawangan</div>";
    echo "<div class='col no3'>Cawangan</div>";
    echo "<div class='col no3'>Ketua Cawangan</div>";
    echo "<div class='col no3'>Alamat Cawangan</div>";
    echo "<div class='col no7'>Telefon</div>";
    if ($x == 2) {
        echo "<div class='col no1'>Tindakan</div>";
    }
    echo "</b><div class='clear line'></div>";
    $i = 1;
    global $db;
    $a = $db->execute("SELECT * FROM tbl_cawangan WHERE caw_stat=0");
    
    $c = mysqli_num_rows($a);
    while ($b = mysqli_fetch_array($a)) {
        echo "<div id='caw" . $b['caw_id'] . "'>";
        echo "<div class='data small'>";
        echo "<div class='col no1'>" . $i++ . "</div>";
        echo "<div class='col no4'>C " . zeronum($b['caw_id']) . "</div>";
        echo "<div class='col no3'>" . ucwords(strtolower($b['caw_nama'])) . "&nbsp;</div>";
        echo "<div class='col no3'>" . ucwords(strtolower($b['caw_head'])) . "&nbsp;</div>";
        echo "<div class='col no3'>" . ucwords(strtolower($b['caw_alamat'])) . "&nbsp;</div>";
        echo "<div class='col no7'>" . $b['caw_tel'] . "&nbsp;</div>";
        if ($x == 2) {
            echo "<div class='col no1'><span class='buang link' onclick='buangcaw(" . $b['caw_id'] . ");' >buang</span></div>";
        }
        if ($i - 1 == $c) {
            echo "<div class='clear line'></div>";
        } else {
            echo "<div class='clear dotted'></div>";
        }
        echo "</div>";
        echo "</div>";
    }
}

function liststaff($x) {
    echo "<br />";
    echo "<b><div class='col no1'>No</div>";
    echo "<div class='col no3'>Cawangan</div>";
    echo "<div class='col no5'>Staff Id</div>";
    echo "<div class='col no3'>Nama Staff</div>";
    echo "<div class='col no4'>No Telefon</div>";
    echo "<div class='col no3'>No Akaun</div>";
    if ($x == 2) {
        echo "<div class='col no4'>Tindakan</div>";
    }
    echo "<div class='clear line'></div></b>";
    $i = 1;
    global $db;
    $z = $db->execute("SELECT stf_id FROM tbl_ahli");
    
    $k = mysqli_num_rows($z);
    $m = $db->execute("SELECT caw_id FROM tbl_ahli GROUP BY caw_id");
    while ($n = mysqli_fetch_array($m)) {
        $caw = $n['caw_id'];
        $a = $db->execute("SELECT * FROM tbl_ahli WHERE caw_id='$caw' and stf_stat=0");
        $c = mysqli_num_rows($a);
        while ($b = mysqli_fetch_array($a)) {
            echo "<div id='ahli" . $b['stf_id'] . "'>";
            echo "<div class='data small'>";
            echo "<div class='col no1'>" . $i++ . "</div>";
            echo "<div class='col no3'>" . ucwords(strtolower(namacawangan($b['caw_id']))) . "&nbsp;</div>";
            echo "<div class='col no5'>S " . zeronum($b['stf_id']) . "</div>";
            echo "<div class='col no3'>" . ucwords(strtolower($b['stf_nama'])) . "&nbsp;</div>";
            echo "<div class='col no4'>" . ucwords(strtolower($b['stf_tel'])) . "&nbsp;</div>";
            echo "<div class='col no3'>" . getBankName($b['bank_id']) . "  [ " . $b['stf_akaun'] . " ]&nbsp;</div>";
            if ($x == 2) {
                echo "<div class='col no4'><span class='buang link' onclick='buangahli(" . $b['stf_id'] . ")' >Buang</span></div>";
            }
            if ($i - 1 == $k) {
                echo "<div class='clear line'></div>";
            } else {
                echo "<div class='clear dotted'></div>";
            }
            echo "</div>";
            echo "</div>";
        }
    }
}

function senaraicawangan() {
    echo "<select id='caw_id' onchange='changeKakitanganList()' onkeypress='changeKakitanganList()' onkeyup='changeKakitanganList()'  >";
    echo "<option value=0>Sila buat pilihan...</option>";
    global $db;
    $a = $db->execute("SELECT * FROM tbl_cawangan WHERE caw_stat=0");
    while ($b = mysqli_fetch_array($a)) {
        echo "<option value=" . $b['caw_id'] . " >" . ucwords(strtolower($b['caw_head'])) . "</option>";
    }
    echo "</select>";
}

function senaraikakitangan() {
    echo "<select id='stf_id'>";
    echo "<option value=0>Sila buat pilihan...</option>";
    global $db;
    $a = $db->execute("SELECT * FROM tbl_ahli WHERE stf_stat=0");
    while ($b = mysqli_fetch_array($a)) {
        echo "<option value=" . $b['stf_id'] . ">" . $b['stf_nama'] . "</option>";
    }
    echo "</select>";
}

function senaraibank($x) {
    echo "<select id='" . $x . "' onchange='updatebank()'>";
    echo "<option value='0'> Pilih Bank Pilihan... </option>";
    global $db;
    $a = $db->execute("SELECT * FROM tbl_banklist");
    while ($b = mysqli_fetch_array($a)) {
        echo "<option value='" . $b['bank_id'] . "'>" . strtoupper($b['bank_name']) . "</option>";
    }
    echo "</select>";
}

function getBankName($x) {
    global $db;
    $a = $db->execute("SELECT bank_name FROM tbl_banklist WHERE bank_id=$x");
    while ($b = mysqli_fetch_array($a)) {
        return $b['bank_name'];
    }
}

function listmutu($x) {
    echo "<select id='" . $x . "'>";
    echo "<option value='0'>Pilih Mutu Emas</option>";
    global $db;
    $a = $db->execute("SELECT * FROM tbl_mutu");
    while ($b = mysqli_fetch_array($a)) {
        echo "<option value='" . $b['m_mutu'] . "'>" . strtoupper($b['m_mutu']) . "</option>";
    }
    echo "</select>";
}

function showupdatekakitangan($x) {
    echo "<b><div class='col no1'>No</div>";
    echo "<div class='col no2'>Cawangan</div>";
    echo "<div class='col no4'>Staff Id</div>";
    echo "<div class='col no3'>Nama Staff</div>";
    echo "<div class='col no4'>No Telefon</div>";
    echo "<div class='col no3'>No Akaun</div></b>";
    echo "<div class='clear line'></div>";
    $i = 1;
    $a = $db->execute("SELECT * FROM tbl_ahli WHERE caw_id=$x");
    global $db;
    $c = mysqli_num_rows($a);
    while ($b = mysqli_fetch_array($a)) {
        echo "<div class='data small'>";
        echo "<div class='col no1'>" . $i++ . "&nbsp;</div>";
        echo "<div class='col no2'>" . ucwords(strtolower(namacawangan($b['caw_id']))) . "&nbsp;</div>";
        echo "<div class='col no4'>S " . zeronum($b['stf_id']) . "&nbsp;</div>";
        echo "<div class='col no3'>" . ptext($b['stf_nama']) . "&nbsp;</div>";
        echo "<div class='col no4'>" . $b['stf_tel'] . "&nbsp;</div>";
        echo "<div class='col no3'>" . getBankName($b['bank_id']) . " &nbsp; [ " . $b['stf_akaun'] . " ]&nbsp;</div>";
        //echo "<span onclick=\"ubahkakitangan('a#".$b['stf_id']."')\" >ubah</span>&nbsp; | &nbsp;" ;
        //echo "<span onclick=\"deletekakitangan('a#".$b['stf_id']."')\" >buang</span>";
        if ($i - 1 == $c) {
            echo "<div class='clear line'></div>";
        } else {
            echo "<div class='clear dotted'></div>";
        }
        echo "</div>";
    }
}

function getcawangan($x) {
    global $db;
    $a = $db->execute("SELECT caw_id FROM tbl_ahli WHERE stf_id='$x'");
    while ($b = mysqli_fetch_array($a)) {
        return $b['caw_id'];
    }
}

function getahliname($x) {
    global $db;
    $a = $db->execute("SELECT stf_nama FROM tbl_ahli WHERE stf_id='$x'");
    while ($b = mysqli_fetch_array($a)) {
        return $b['stf_nama'];
    }
}

function getnamacawangan($x) {
    global $db;
    $a = $db->execute("SELECT caw_nama FROM tbl_cawangan WHERE caw_id='$x'");
    while ($b = mysqli_fetch_array($a)) {
        return $b['caw_nama'];
    }
}

function kategori($x) {
    switch ($x) {
        case 1;
            return "Masuk";
            break;
        case 2;
            return "Keluar";
            break;
        default:
            break;
    }
}

function dateexplode($x, $date) {
    $a = explode(" ", $date);
    $b = explode('-', $a[0]);
    switch ($x) {
        case 1;
            break;
        case 2;
            break;
        case 3;
            break;
        default:
            break;
    }
    return $c;
}

function username($x) {
    global $db;
    $a = $db->execute("SELECT usr_fname FROM tbl_user WHERE usr_id='$x'");
    while ($b = mysqli_fetch_array($a)) {
        return ucwords(strtolower($b['usr_fname']));
    }
}

function updateselectcaw() {
    echo "<select id='scaw' onchange='semakcawangan(this.value)' onkeyup='semakcawangan(this.value)' >";
    //echo "<select id='scaw' >";
    echo "<option value='0'>Papar Semua Cawangan</option>";
    global $db;
    $a = $db->execute("SELECT caw_id, caw_head FROM tbl_cawangan WHERE caw_stat = 0 ORDER BY caw_nama ASC");
    while ($b = mysqli_fetch_array($a)) {
        echo "<option value='" . $b['caw_id'] . "' >" . $b['caw_head'] . "</option>";
    }
    echo "</select>";
}

class transaksi {

    var $bulankeluar;
    var $bulanmasuk;
    var $mon = array('Januari', 'Februari', 'Mac', 'April', 'May', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember');
    var $bawabaki = 0;
    var $emasguna;
    var $emasberat;
    var $tarikhStart;
    var $tarikhAkhir;

    private function sortDate($date) {
        $a = explode('-', $date);
        return $a[2] . '-' . $a[0] . '-' . $a[1];
    }

    public function jumlahAw($x) { // 1 untuk masuk 2 untuk keluar;
        $total = 0;
        global $db;
        $a = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$x'");
        
        while ($c = $b = mysqli_fetch_array($a)) {
            $total = $total + $c['sum(at_jumlah)'];
        }
        return $total;
    }

    public function jumlahBeratEmas($x) { // 1 untuk masuk 2 untuk keluar;
        $total = 0;
        global $db;
        $a = $db->execute("SELECT sum(at_beratEmas) FROM tbl_alirantunai");
        
        while ($c = $b = mysqli_fetch_array($a)) {
            $total = $total + $c['sum(at_beratEmas)'];
        }
        return $total;
    }

    public function jumlahNilaiEmas($x) { // 1 untuk masuk 2 untuk keluar;
        $total = 0;
        global $db;
        $a = $db->execute("SELECT sum(at_guna) FROM tbl_alirantunai");
        while ($c = $b = mysqli_fetch_array($a)) {
            $total = $total + $c['sum(at_guna)'];
        }
        return $total;
    }

    public function transaksiIkutTarikh() {
        $x = 1;
        $start = $this->sortDate($this->tarikhStart);
        $akhir = $this->sortDate($this->tarikhAkhir);
        $i = 1;
        $jm = 0;
        $jk = 0;
        $beratEmas = 0;
        $nilaiEmas = 0;
        echo "<b><div>";
        echo "<div class='col no1'>No</div>";
        echo "<div class='col no8'>Tarikh dan Masa</div>";
        echo "<div class='col no3'>Perkara</div>";
        echo "<div class='col no4 bbleft bbright'>Staf</div>";
        //echo "<div class='col no4'>Cawangan</div>";
        echo "<div class='col no5 tright'>Masuk</div>";
        echo "<div class='col no5 tright'>Keluar</div>";
        echo "<div class='col no5 tright bbleft'>Berat(g)</div>";
        echo "<div class='col no4 tright'>Nilai Emas</div>";
        if ($x == 2) {
            echo "<div class='col no1'>Buang</div>";
        }
        echo "<div class='clear line'></div>";
        echo "</div></b>";
        global $db;
        $a = $db->execute("SELECT * FROM tbl_alirantunai WHERE date(at_timeDate)>= '$start' AND date(at_timeDate)<='$akhir'");
        $c = mysqli_num_rows($a);
        while ($b = mysqli_fetch_array($a)) {
            echo "<div class='data small' id='at" . $b['at_id'] . "' >";
            if ($b['at_kategori'] == 1) {
                echo "<div class='in'>";
            } else {
                echo "<div class='out'>";
            }
            echo "<div class='col no1'>" . $i++ . "&nbsp;</div>";
            echo "<div class='col no8'>" . $b['at_timeDate'] . "&nbsp;</div>";

            echo "<div class='col no3'>" . textlen($b['at_perkara'], 26) . "&nbsp;</div>";
            echo "<div class='col no4 bbleft bbright'>" . textlen(getahliname($b['stf_id']), 8) . "&nbsp;</div>";
            // echo "<div class='col no4'>" . textlen(getnamacawangan($b['caw_id']), 8) . "&nbsp;</div>";
            if ($b['at_kategori'] == 1) {
                if ($b['at_jumlah'] > 0):
                    echo "<div class='col no5 tright'>" . number_format($b['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                else:
                    echo "<div class='col no5 tright'>&nbsp;</div>";
                endif;
                echo "<div class='col no5 tright'>&nbsp;</div>";
                $jm = $jm + $b['at_jumlah'];
            } else {
                echo "<div class='col no5 tright'>&nbsp;</div>";
                echo "<div class='col no5 tright'>" . number_format($b['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                $jk = $jk + $b['at_jumlah'];
            }
            if ($b['at_beratEmas'] > 0):
                echo "<div class='col no5 tright bbleft'>" . curr($b['at_beratEmas']) . "</div>";
                $beratEmas += $b['at_beratEmas'];
            else:
                echo "<div class='col no5 tright bbleft'>&nbsp;</div>";
            endif;
            if ($b['at_guna']):
                echo "<div class='col no4 tright'>" . curr($b['at_guna']) . "</div>";
                $nilaiEmas += $b['at_guna'];
            else:
                echo "<div class='col no4 tright'>&nbsp;</div>";
            endif;

            if ($x == 2) {
                echo "<div class='col no1 link buang' onclick='buangatini(" . $b['at_id'] . ")' >buang</div>";
            }
            if ($i - 1 == $c) {
                echo "<div class='clear line'></div>";
            } else {
                echo "<div class='clear dotted'></div>";
            }
            echo "</div>";
            echo "</div>";
        }

        echo "<b><div>";
        echo "<div class='col no1'>&nbsp;</div>";
        echo "<div class='col no8'>&nbsp;</div>";
        echo "<div class='col no3'>Jumlah Besar (" . ($i - 1) . " transaksi)</div>";
        echo "<div class='col no4 tright' style='display:none;'>&nbsp;" . number_format($jm, 2) . "</div>";
        echo "<div class='col no4 tright' style='display:none;'>&nbsp;", number_format($jk, 2), "</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='clear'></div></b><br />";
        echo "<b>Maklumat Semua Transaksi</b><br />";
        echo "<div class='col no3'>Jumlah Masuk </div>";
        echo "<div class='col no4 tright'>" . number_format($this->jumlahAw(1), 2) . "</div>";
        echo "<div class='clear'></div>";
        echo "<div class='col no3'>Jumlah Keluar </div>";
        echo "<div class='col no4 tright'>" . number_format($this->jumlahAw(2), 2) . "</div>";
        echo "<div class='clear line'></div>";
        echo "<div class='col no3'>Baki</div>";
        $baki = $this->jumlahAw(1) - $this->jumlahAw(2);
        echo "<div class='col no4 tright'>" . number_format($baki, 2) . "</div>";
        echo "<div class='clear'></div>";
        echo "<br /><br />";
        echo "<b>Maklumat Semua Transaksi Mengikut Tarikh</b><br />";
        echo "<div>";
        echo "<div class='col no3'>Jumlah Masuk </div>";
        echo "<div class='col no4 tright'>" . number_format($jm, 2) . "</div>";
        echo "<div class='col no3'>Jumlah Berat Emas </div>";
        echo "<div class='col no4 tright'>" . number_format($beratEmas, 2) . "</div>";
        echo "<div class='clear'></div>";

        echo "<div class='col no3'>Jumlah Keluar </div>";
        echo "<div class='col no4 tright'>" . number_format($jk, 2) . "</div>";
        echo "<div class='col no3'>Jumlah Nilai Emas</div>";
        echo "<div class='col no4 tright'>" . number_format($nilaiEmas, 2) . "</div>";
        echo "<div class='clear line'></div>";

        echo "<b><div class='col no3'>Baki</div>";
        echo "<div class='col no4 tright'>" . number_format($jm - $jk, 2) . "</div>";
        echo "<div class='clear'></div></b>";
    }

    public function harian($today) {
        echo "<b><div class='data small' >";
        echo "<div class='col no1'>No</div>";
        echo "<div class='col no8'>Tarikh</div>";
        echo "<div class='col no3'>Perkara</div>";
        echo "<div class='col no4 tright'>Masuk</div>";
        echo "<div class='col no4 tright'>Keluar</div>";
        echo "<div class='col no2'>Nama Ahli</div>";
        echo "<div class='col no2'>Cawangan</div>";
        echo "<div class='clear line'></div>";
        echo "</div></b>";
        $i = 1;
        $masuk = 0;
        $keluar = 0;
        global $db;
        $a = $db->execute("SELECT * FROM tbl_alirantunai WHERE at_kategori=1 and at_timeDate LIKE '$today' ORDER BY at_kategori ASC");
        $b = mysqli_num_rows($a);
        if ($b > 0) {
            while ($c = mysqli_fetch_array($a)) {
                $masuk = $masuk + $c['at_jumlah'];
                echo "<div class='data small' id='at" . $c['at_id'] . "' >";
                echo "<div class='col no1'>" . $i++ . "&nbsp;</div>";
                echo "<div class='col no8'>" . $c['at_timeDate'] . "&nbsp;</div>";
                echo "<div class='col no3'>" . textlen($c['at_perkara'], 26) . "&nbsp;</div>";
                echo "<div class='col no4 tright'>" . number_format($c['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                echo "<div class='col no4'>&nbsp;</div>";
                echo "<div class='col no2'>" . textlen(getahliname($c['stf_id']), 17) . "&nbsp;</div>";
                echo "<div class='col no2'>" . textlen(getnamacawangan($c['caw_id']), 17) . "&nbsp;</div>";
                echo "<div class='clear dotted'></div>";
                echo "</div>";
            }
        }
        global $db;
        $d = $db->execute("SELECT * FROM tbl_alirantunai WHERE at_kategori=2 and at_timeDate LIKE '$today' ORDER BY at_kategori ASC");
        $e = mysqli_num_rows($d);
        if ($e > 0) {
            while ($f = mysqli_fetch_array($d)) {
                $keluar = $keluar + $f['at_jumlah'];
                echo "<div class='data small' id='at" . $f['at_id'] . "' >";
                echo "<div class='col no1'>" . $i++ . "&nbsp;</div>";
                echo "<div class='col no8'>" . $f['at_timeDate'] . "&nbsp;</div>";
                echo "<div class='col no3'>" . textlen($f['at_perkara'], 26) . "&nbsp;</div>";
                echo "<div class='col no4'>&nbsp;</div>";
                echo "<div class='col no4 tright'>" . number_format($f['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                echo "<div class='col no2'>" . textlen(getahliname($f['stf_id']), 17) . "&nbsp;</div>";
                echo "<div class='col no2'>" . textlen(getnamacawangan($f['caw_id']), 17) . "&nbsp;</div>";
                echo "<div class='clear dotted'></div>";
                echo "</div>";
            }
        }
        echo "<br />";
        echo "<div class='line'></div>";
        echo "<b><div class='data small' >";
        echo "<div class='col no1'>&nbsp;</div>";
        echo "<div class='col no8'>&nbsp;</div>";
        echo "<div class='col no3'>&nbsp;</div>";
        echo "<div class='col no4 tright'>" . number_format($masuk, 2) . "</div>";
        echo "<div class='col no4 tright'>" . number_format($keluar, 2) . "</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='clear></div>";
        echo "</div></b>";
    }

    public function allrekod($x) {
        $i = 1;
        $jm = 0;
        $jk = 0;

        echo "<b><div>";
        echo "<div class='col no1'>No</div>";
        echo "<div class='col no8'>Tarikh dan Masa</div>";
        //echo "<div class='col no4 hidden'>Cawangan</div>";
        echo "<div class='col no3'>Perkara</div>";
        echo "<div class='col no4 bbleft'>Staf</div>";
        echo "<div class='col no4 tright bbleft'>Masuk</div>";
        echo "<div class='col no4 tright'>Keluar</div>";
        echo "<div class='col no5 tright bbleft'>Berat(g)</div>";
        echo "<div class='col no4 tright'>Nilai Emas</div>";

        if ($x == 2) {
            echo "<div class='col no1'>Buang</div>";
        }
        echo "<div class='clear line'></div>";
        echo "</div></b>";
        global $db;
        $a = $db->execute("SELECT * FROM tbl_alirantunai ORDER BY at_timeDate DESC LIMIT 100");
        $c = mysqli_num_rows($a);
        while ($b = mysqli_fetch_array($a)) {
            echo "<div class='data small' id='at" . $b['at_id'] . "' >";
            if ($b['at_kategori'] == 1) {
                echo "<div class='in'>";
            } else {
                echo "<div class='out'>";
            }
            echo "<div class='col no1'>" . $i++ . "&nbsp;</div>";
            echo "<div class='col no8'>" . $b['at_timeDate'] . "&nbsp;</div>";
            echo "<div class='col no3'>" . textlen($b['at_perkara'], 26) . "&nbsp;</div>";
            echo "<div class='col no4 bbleft'>" . textlen(getahliname($b['stf_id']), 6) . "&nbsp;</div>";
            //echo "<div class='col no4 hidden' >" . textlen(getnamacawangan($b['caw_id']), 6) . "&nbsp;</div>";

            if ($b['at_kategori'] == 1) {
                if ($b['at_jumlah']):
                    echo "<div class='col no4 tright bbleft'>" . number_format($b['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                    echo "<div class='col no4 tright'>&nbsp;</div>";
                else:
                    echo "<div class='col no4 tright bbleft'>&nbsp;</div>";
                    echo "<div class='col no4 tright'>&nbsp;</div>";
                endif;
                $jm = $jm + $b['at_jumlah'];
            } else {
                echo "<div class='col no4 tright bbleft'>&nbsp;</div>";
                echo "<div class='col no4 tright'>" . number_format($b['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                $jk = $jk + $b['at_jumlah'];
            }
            if ($b['at_beratEmas'] > 0):
                echo "<div class='col no5 tright bbleft'>" . curr($b['at_beratEmas']) . "</div>";
            else:
                echo "<div class='col no5 tright bbleft'>&nbsp;</div>";
            endif;
            if ($b['at_guna'] > 0):
                echo "<div class='col no4 tright'>" . curr($b['at_guna']) . "</div>";
            else:
                echo "<div class='col no4 tright'>&nbsp;</div>";
            endif;

            if ($x == 2) {
                echo "<div class='col no1 link buang' onclick='buangatini(" . $b['at_id'] . ")' >buang</div>";
            }
            if ($i - 1 == $c) {
                echo "<div class='clear line'></div>";
            } else {
                echo "<div class='clear dotted'></div>";
            }
            echo "</div>";
            echo "</div>";
        }
        echo "<b><div>";
        echo "<div class='col no1'>&nbsp;</div>";
        echo "<div class='col no8'>&nbsp;</div>";
        echo "<div class='col no3'>(" . ($i - 1) . " transaksi)</div>";
        echo "<div class='col no5 tright' style='display:none;'>&nbsp;" . number_format($jm, 2) . "</div>";
        echo "<div class='col no5 tright' style='display:none;'>&nbsp;", number_format($jk, 2), "</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='clear'></div></b><br />";
        echo "<div class='col no3'>Jumlah Masuk </div>";
        echo "<div class='col no4 tright'>" . number_format($this->jumlahAw(1), 2) . "</div>";

        echo "<div class='col no3'>Jumlah Berat Emas</div>";
        echo "<div class='col no4 tright'>" . number_format($this->jumlahBeratEmas(2), 2) . "</div>";

        echo "<div class='clear'></div>";

        echo "<div class='col no3'>Jumlah Keluar </div>";
        echo "<div class='col no4 tright'>" . number_format($this->jumlahAw(2), 2) . "</div>";

        echo "<div class='col no3'>Jumlah Nilai Emas</div>";
        echo "<div class='col no4 tright'>" . number_format($this->jumlahNilaiEmas(2), 2) . "</div>";

        echo "<div class='clear line'></div>";
        echo "<div class='col no3'>Baki</div>";
        $baki = $this->jumlahAw(1) - $this->jumlahAw(2);
        echo "<div class='col no4 tright'>" . number_format($baki, 2) . "</div>";
        echo "<div class='clear'></div>";
    }

    public function bakilepas($x) {
        $e = explode('-', $x);
        $lastmonth = $e[1] - 1;
        if (strlen($lastmonth) == 1) {
            $lastmonth = '0' . $lastmonth;
        }
        $exp = $e[0] . '-' . $lastmonth . '-%';
        $date = $e[0] . '-' . $lastmonth . '-01 00:00:00';
        global $db;
        $a = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori = 1 and at_timeDate LIKE '$exp'");
        
        while ($b = mysqli_fetch_array($a)) {
            $masuk = $b['sum(at_jumlah)'];
        }
        $k = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori = 2 and at_timeDate LIKE '$exp'");
        while ($l = mysqli_fetch_array($k)) {
            $keluar = $l['sum(at_jumlah)'];
        }

        $a = $db->execute("SELECT sum(at_guna), sum(at_beratEmas) FROM tbl_alirantunai WHERE at_timeDate LIKE '$exp'");
        while ($b = mysqli_fetch_array($a)) {
            $emasguna = $b['sum(at_guna)'];
            $emasberat = $b['sum(at_beratEmas)'];
        }

        $result = $masuk - $keluar;
        $this->bawabaki = $result;
        $this->emasguna = $emasguna;
        $this->emasberat = $emasberat;

        echo "<div class='data small'>";
        echo "<div class='col no1'>1</div>";
        echo "<div class='col no8'>" . $date . "</div>";
        echo "<div class='col no2'>Baki Bulan " . $this->mon[(date('n') - 2)] . "</div>";
        //echo "<div class='col no4'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no7 tright bleft'>" . number_format((float)$result, 2, '.', ',') . "&nbsp;</div>";
        echo "<div class='col no7 tright'>&nbsp;</div>";
        echo "<div class='col no7 tright bleft'>" . number_format((float)$emasberat, 1, '.', ',') . "&nbsp;</div>";
        echo "<div class='col no7 tright'>" . number_format((float)$emasguna, 2, '.', ',') . "&nbsp;</div>";
        echo "<div class='col no4 bleft'>&nbsp;</div>";
        echo "<div class='clear dotted'></div>";
        echo "</div>";
    }

    public function bulanan($pilihan = 'none') {
        if ($pilihan=='none'):
            echo 'default';
            $thismonth = date('Y-m') . '%';
            $whereSql = "at_timeDate LIKE '".$thismonth."' ";
        else:
            echo 'by pilihan';
            $whereSql = "DATE(at_timeDate) >= '$this->tarikhStart' AND DATE(at_timeDate) <= '$this->tarikhAkhir'";
        endif;       
        $i = 2;
        $keluar = 0;
        $emasguna = '';
        echo $emasguna;
        echo "<b><div>";
        echo "<div class='col no1'>No a</div>";
        echo "<div class='col no8'>Tarikh dan Masa</div>";
        echo "<div class='col no2'>Perkara</div>";
        echo "<div class='col no2'>Cawangan</div>";
        echo "<div class='col no7 cen'>Masuk</div>";
        echo "<div class='col no7 cen'>Keluar</div>";
        echo "<div class='col no7 cen'>Berat (g)</div>";
        echo "<div class='col no7 cen'>Nilai</div>";
        echo "<div class='col no4 cen'>Hutang</div>";
        echo "<div class='clear line'></div>";
        echo "</div></b>";
        echo $this->bakilepas(date("Y-m-d"));
        $masuk = $this->bawabaki;
        $beratemas = $this->emasberat;
        $emasguna = $this->emasguna;
        global $db;
        $a = $db->execute("SELECT * FROM tbl_alirantunai WHERE $whereSql ORDER BY at_timeDate ASC ");
        $c = mysqli_num_rows($a);
        while ($b = mysqli_fetch_array($a)) {
            echo "<div class='data small'>";
            echo "<div class='col no1'>" . $i++ . "</div>";
            echo "<div class='col no8'>" . $b['at_timeDate'] . "&nbsp;</div>";
            echo "<div class='col no2'>" . textlen(ucwords(strtolower($b['at_perkara'])), 20) . "&nbsp;</div>";
            echo "<div class='col no2'>" . textlen(getnamacawangan($b['caw_id']), 17) . "&nbsp;</div>";
            if ($b['at_kategori'] == 1) {
                echo "<div class='col no7 tright bleft'>" . number_format($b['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                echo "<div class='col no7 tright'>&nbsp;</div>";
                $masuk = $masuk + $b['at_jumlah'];
            } else {
                echo "<div class='col no7 tright bleft'>&nbsp;</div>";
                echo "<div class='col no7 tright'>" . number_format($b['at_jumlah'], 2, '.', ',') . "&nbsp;</div>";
                $keluar = $keluar + $b['at_jumlah'];
            }
            if ($b['at_beratEmas'] == 0) {
                $be = "&nbsp;";
            } else {
                $be = number_format($b['at_beratEmas'], 1, '.', ',');
            }
            if ($b['at_guna'] == 0) {
                $bg = "&nbsp;";
            } else {
                $bg = number_format($b['at_guna'], 2, '.', ',');
            }
            echo "<div class='col no7 tright bleft'>" . $be . "&nbsp;</div>";
            echo "<div class='col no7 tright'>" . $bg . "&nbsp;</div>";
            $beratemas = $beratemas + $b['at_beratEmas'];
            $emasguna = $emasguna + $b['at_guna'];
            echo "<div class='col no4 bleft tright'>";
            if ($b['at_kategori'] == 1 and $b['at_guna'] >= 0) {
                echo "(" . curr(($b['at_jumlah'] - $b['at_guna'])) . ")";
            } else {
                echo curr(($b['at_jumlah'] - $b['at_guna']));
            }
            echo "</div>";
            if ($i - 2 == $c) {
                echo "<div class='clear line'></div>";
            } else {
                echo "<div class='clear dotted'></div>";
            }
            echo "</div>";
        }
        echo "<b><div class='small'>";
        echo "<div class='col no1'>&nbsp;</div>";
        echo "<div class='col no8'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no2'>&nbsp;</div>";
        echo "<div class='col no7 tright bbleft'>" . number_format((float)$masuk, 2, '.', ',') . "</div>";
        echo "<div class='col no7 tright'>" . number_format((float)$keluar, 2, '.', ',') . "</div>";
        echo "<div class='col no7 tright bbleft'>" . number_format((float)$beratemas, 1, '.', ',') . "</div>";
        echo "<div class='col no7 tright'>" . number_format((float)$emasguna, 2, '.', ',') . "</div>";
        echo "<div class='clear'></div>";
        echo "</div></b>";
        $this->bulankeluar = $keluar;
        $this->bulanmasuk = $masuk;
        echo "<br />";
        echo "<div class='col lab'>MASUK</div>";
        echo "<div class='col lda tright'>" . number_format((float)$masuk, 2, '.', ',') . "</div><div class='clear'></div>";
        echo "<div class='col lab'>KELUAR</div>";
        echo "<div class='col lda tright'>" . number_format((float)$keluar, 2, '.', ',') . "</div><div class='clear'></div>";
        echo "<div class='col lab'>BAKI BULAN INI</div>";
        echo "<div class='col lda tright'>" . number_format(((float)$masuk - (float)$keluar), 2, '.', ',') . "</div><div class='clear'></div>";
        echo "<br /><br />";
    }

    public function setiapcawangan() {
        echo "<h2>Maklumat dan Rekod Transaksi Setiap Cawangan</h2>";
        echo "<div class='infobox'>";
        echo "<div class='col lbl'>Cawangan </div>";
        echo "<div class='col lda'>" . updateselectcaw() . "</div>";
        echo "<div class='clear'></div>";
        echo "<div class='col lbl'>Tarikh Mula</div>";
        echo "<div class='col lda'><input type='text' id='sdate' onfocus='showCalendarControl(this)' /></div>";
        echo "<div class='clear'></div>";
        echo "<div class='col lbl'>Tarikh Akhir</div>";
        echo "<div class='col lda'><input type='text' id='edate' onfocus='showCalendarControl(this)'/></div>";
        echo "<div class='clear'></div>";
        echo "<div class='col lbl'>&nbsp;</div>";
        echo "<div class='col lda'><button onclick='semakancawangan()' >Kemaskini Semakan</button></div>";
        echo "<div class='clear'></div>";
        echo "</div>";
        echo "<div id='keputusansemakan'>Ruang Paparan Hasil Carian </div>";
    }

}

class widget {

    var $nilaiemas;
    var $beratemas;
    var $totalhutang = 0;
    var $totalhutang2 = 0;

    public function akaunbulanini($x) {
        $d = date('Y-m') . '%';
        global $db;
        $a = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$x' and at_timeDate LIKE '$d'");
        while ($b = mysqli_fetch_array($a)) {
            return $b['sum(at_jumlah)'];
        }
    }

    public function dalambankbulanini() {
        $d = date('Y-m') . '%';
        global $db;
        $a = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$x' and at_timeDate LIKE '$d'");
        while ($b = mysqli_fetch_array($a)) {
            return $b['sum(at_jumlah)'];
        }
    }

    public function akaunsemua($x) {
        global $db;
        $a = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$x'");
        while ($b = mysqli_fetch_array($a)) {
            return $b['sum(at_jumlah)'];
        }
    }

    public function bankBulanIni($x) {
        $d = date('Y-m') . '%';
        global $db;
        $a = $db->execute("SELECT sum(jumlah) FROM aliranbank WHERE kategori='$x' and timestamp LIKE '$d'");
        while ($b = mysqli_fetch_array($a)) {
            return $b['sum(jumlah)'];
        }
    }

    public function bankSemua($x) {
        global $db;
        $a = $db->execute("SELECT sum(jumlah) FROM aliranbank WHERE kategori='$x'");
        while ($b = mysqli_fetch_array($a)) {
            return $b['sum(jumlah)'];
        }
    }

    public function emas($x, $y) {
        $d = date('Y-m') . '%';
        global $db;
        $a = $db->execute("SELECT sum(at_beratEmas), sum(at_guna) FROM tbl_alirantunai WHERE at_kategori='$x' and at_timeDate LIKE '$d'");
        while ($b = mysqli_fetch_array($a)) {
            if ($y == 1) {
                return $b['sum(at_beratEmas)'];
            } else {
                return $b['sum(at_guna)'];
            }
        }
    }

    public function hutang($x, $y) {
        global $db;
        $a = $db->execute("SELECT sum(at_jumlah), sum(at_guna) FROM tbl_alirantunai WHERE caw_id='$x' and at_kategori='$y'");
        while ($b = mysqli_fetch_array($a)) {
            if ($y == 1) {
                $masuk = ($b['sum(at_guna)'] + $b['sum(at_jumlah)']);
            } else {
                $masuk = ($b['sum(at_jumlah)'] + $b['sum(at_guna)']);
            }
        }
        if ($masuk <= 0) {
            return ($masuk * -1);
        } else {
            return $masuk;
        }
    }

    public function checkcawhutang($x) {
        global $db;
        $qry = $db->execute("SELECT caw_id FROM tbl_cawangan WHERE caw_stat=0");
        $a = mysqli_num_rows($qry);
        if ($a > 0) {
            while ($k = mysqli_fetch_array($qry)) {
                $result = $this->hutang($k['caw_id'], 1);
                if ($x == 1) {
                    if ($this->hutang($k['caw_id'], 1) > $this->hutang($k['caw_id'], 2)) {
                        $result = ($this->hutang($k['caw_id'], 1) - $this->hutang($k['caw_id'], 2));
                        if ($result != 0) {
                            echo "<div class='col no2'>" . textlen(namacawangan($k['caw_id']), 16) . "&nbsp;</div>";
                            echo "<div class='col no2 tright bleft'>" . curr($result) . "&nbsp;</div>";
                            echo "<div class='col no2 bleft'>&nbsp;</div>";
                            echo "<div class='clear dotted'></div>";
                            $this->totalhutang = $this->totalhutang + $result;
                        }
                    }
                } else {
                    $result = ($this->hutang($k['caw_id'], 2) - $this->hutang($k['caw_id'], 1));
                    if ($result > 0) {
                        echo "<div class='col no2'>" . textlen(namacawangan($k['caw_id']), 16) . "&nbsp;</div>";
                        echo "<div class='col no2 bleft'>&nbsp;</div>";
                        echo "<div class='col no2 tright bleft'>" . curr($result) . "&nbsp;</div>";
                        echo "<div class='clear dotted'></div>";
                        $this->totalhutang2 = $this->totalhutang2 + $result;
                    }
                }
            }
        }
    }

}

class rumusan extends widget {

    public function display() {

        echo "<div class='col left'>";
        echo "<b>";
        echo "<div class='col no2 brep mspa '>&nbsp;</div>";
        echo "<div class='col no6 cen rem bbleft bbtop mspa bco'>Bulan Ini</div>";
        echo "<div class='col no6 cen rem bbleft bbright bbtop mspa bco'>Keseluruhan</div>";
        echo "<div class='clear '></div>";
        echo "</b>";

        echo "<div class='col no2 line bbleft bbtop mspa bco'>Wang Masuk</div>";
        echo "<div class='col no6 line rem bbleft bbtop mspa tright'>" . curr($this->akaunbulanini(1)) . "&nbsp;</div>";
        echo "<div class='col no6 line rem bbleft bbtop bbright mspa tright'>" . curr($this->akaunsemua(1)) . "&nbsp;</div>";
        echo "<div class='clear'></div>";

        echo "<div class='col no2 line bbleft mspa bco'>Wang Keluar</div>";
        echo "<div class='col no6 line rem bbleft mspa tright'>" . curr($this->akaunbulanini(2)) . "&nbsp;</div>";
        echo "<div class='col no6 line rem bbleft bbright mspa tright'>" . curr($this->akaunsemua(2)) . "&nbsp;</div>";
        echo "<div class='clear'></div>";

        echo "<div class='col no2 line bbleft mspa bco'><b>Dalam Bank</b></div>";
        echo "<div class='col no6 line rem bbleft mspa tright'><b>&nbsp;</b></div>";
        echo "<div class='col no6 line rem bbleft bbright mspa tright'><b>" . curr(($this->bankSemua(1) - $this->bankSemua(2))) . "&nbsp;</b></div>";
        echo "<div class='clear'></div>";


        $duitAkaunSemua = ($this->akaunsemua(1) - $this->akaunsemua(2));
        $duitAkaunBulanIni = ($this->akaunbulanini(1) - $this->akaunbulanini(2));

        $duitBankSemua = ($this->bankSemua(1) - $this->bankSemua(2));
        $duitBankBulanIni = ($this->bankBulanIni(1) - $this->bankBulanIni(2));

        $dalamAkaunSemua = $duitAkaunSemua - $duitBankSemua;
        $dalamAkaunBulanIni = $duitAkaunBulanIni - $duitBankBulanIni;

        echo "<div class='col no2 dbl bbleft mspa bco'><b>Dalam Peti</b></div>";
        echo "<div class='col no6 dbl rem bbleft mspa tright'><b>&nbsp;</b></div>";
        echo "<div class='col no6 dbl rem bbleft bbright mspa tright'><b>" . curr($dalamAkaunSemua - $this->bankSemua(2)) . "&nbsp;</b></div>";
        echo "<div class='clear'></div>";

        echo "<div class='col no2 dbl bbleft mspa bco'><b>Duit Keseluruhan</b></div>";
        echo "<div class='col no6 dbl rem bbleft mspa tright'>&nbsp;</div>";
        echo "<div class='col no6 dbl rem bbleft bbright mspa tright'><b>" . curr($dalamAkaunSemua - $this->bankSemua(2) + $duitBankSemua) . "&nbsp;</b></div>";
        echo "<div class='clear'></div>";

        echo "</div>";

        echo "<div class='col right'>";
        echo "<b><div class='bbtop'></div>";
        echo "<div class='col no2 '>Cawangan</div>";
        echo "<div class='col no2 cen'>Syarikat Berhutang</div>";
        echo "<div class='col no2 cen'>Cawangan Berhutang</div></b>";
        echo "<div class='clear line'></div>";
        echo $this->checkcawhutang(1);
        echo $this->checkcawhutang(2);
        echo "<b><div class='bbtop'></div>";
        echo "<div class='col no2 '>Jumlah</div>";
        echo "<div class='col no2 tright bbleft'>" . curr($this->totalhutang) . "&nbsp;</div>";
        echo "<div class='col no2 tright bbleft'>" . curr($this->totalhutang2) . "&nbsp;</div></b>";
        echo "<div class='clear dbl'></div>";
        echo "</div>";
        echo "<div class='clear'></div>";
    }

}

function RearrangeDate($date){
    $arrangement = explode('-',$date);
    $mysqldate = $arrangement[2].'-'.$arrangement[0].'-'.$arrangement[1];
    return $mysqldate;
}

?>