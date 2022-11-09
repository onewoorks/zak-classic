<h2>Rekod Transaksi Kesuluruhan</h2>
<div class='infobox'>
    <div class='col lbl'>Tarikh Mula</div>
    <div class='col lda'><input type='text' id='sdate' onfocus='showCalendarControl(this)' /></div>
    <div class='clear'></div>
    <div class='col lbl'>Tarikh Akhir</div>
    <div class='col lda'><input type='text' id='edate' onfocus='showCalendarControl(this)'/></div>
    <div class='clear'></div>
    <div class='col lbl'>&nbsp;</div>
    <div class='col lda'><button onclick='semakantransaksi();' >Papar Transaksi</button></div>
    <div class='clear'></div>
</div>

<div id="transResult">
<?php
$rekod = new transaksi;
$rekod->allrekod(1);
?>
</div>


