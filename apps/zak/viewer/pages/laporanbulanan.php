<?php
//session_start();
echo "<h2>Laporan Bulanan</h2>";
?>
<div class="infobox">
    <div class="col lbl">Tarikh Mula</div>
    <div class="col lda"><input type="text" id="datestart" onfocus="showCalendarControl(this)"></div>
    <div class="clear"></div>
    
    <div class="col lbl">Tarikh Akhir</div>
    <div class="col lda"><input type="text" id="dateend" onfocus="showCalendarControl(this)"></div>
    <div class="clear"></div>
    
    <div class="col lbl">&nbsp;</div>
    <div class="col lda"><button onclick="laporanikutpilihan();">Kemaskini Semakan</button></div>
    <div class="clear" onclick="semakancawangan();"></div>
        
</div>
<div id="keputusansemakan">
<?php
$laporan = new transaksi;
$laporan->bulanan();
?>
</div>