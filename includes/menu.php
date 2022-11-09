<div id='pageloc'>
    <div class="pagechange">
        <div class='menu'>
            <div class='box'>
                <h3>Menu</h3>
                <div onclick="pagemenu(10);" class='link'>Paparan Utama</div>
                <div class='underspace'>Cawangan dan Ahli</div>
                <div onclick="pagemenu(1);" class='link gap' >Senarai Cawangan</div>
                <div onclick="pagemenu(7);" class='link gap'>Daftar Cawangan</div>
                <div onclick='pagemenu(12);' class='link gap'>Kemaskini Cawangan</div>
                <div>&nbsp;</div>
                <div onclick="pagemenu(2);" class='link gap' >Senarai Ahli Cawangan</div>
                <div onclick="pagemenu(8);" class='link gap'>Daftar Ahli</div>
                <div onclick='pagemenu(13);' class='link gap'>Kemaskini Ahli</div>
                <div>&nbsp;</div>
                <div class='underspace'>Transaksi</div>
                <div onclick="pagemenu(3);" class='link gap'>Daftar Aliran Tunai</div>
                <div onclick="pagemenu(11)" class='link gap'>Buang Aliran Tunai</div>
                <div class='underspace'>Laporan</div>
                <div onclick="pagemenu(4);" class='link gap'>Rekod Transaksi Keseluruhan</div>
                <div onclick="pagemenu(9);" class='link gap'>Semakan Rekod Mengikut Pilihan</div>
                <div onclick="pagemenu(6);" class='link gap'>Laporan Bulanan</div>
                <div onclick="pagemenu(14);" class='link gap' >Laporan Harian</div>
            </div>
            <div class='box'>
                <h3>Ringkasan Transaksi </h3>
                <div id="ringkasantransaksi">
                    <?php
                    include('includes/pages/ringkasantransaksi.php');
                    //include('../includes/pages/ringkasantransaksi.php');
                    ?>
                </div>
            </div>
        </div>
        <div class='action'>
            <div id='pageaction'><?php include('pages/main.php'); ?></div>
        </div>
    </div>
    <div class='footer'>&nbsp;</div>
</div>