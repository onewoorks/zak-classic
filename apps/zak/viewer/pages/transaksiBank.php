<?php include_once '../../model/aliranbank.php';?>
<h2>Rekod Transaksi Bank Kesuluruhan</h2>
<div class='infobox'>
    <div class='col lbl'>Tarikh Mula</div>
    <div class='col lda'><input type='text' id='sdate' onfocus='showCalendarControl(this)' /></div>
    <div class='clear'></div>
    <div class='col lbl'>Tarikh Akhir</div>
    <div class='col lda'><input type='text' id='edate' onfocus='showCalendarControl(this)'/></div>
    <div class='clear'></div>
    <div class='col lbl'>&nbsp;</div>
    <div class='col lda'><button onclick='semakanTransaksiBank();' >Papar Transaksi</button></div>
    <div class='clear'></div>
</div>

<div id="transBankResult">
    <?php
    
    $ab = new aliranbank_model();
    $ab->read_aliranbank_criteria();
    $result = $ab->read_aliranbank_criteria();
    include_once 'ajax_result/aliranbank.php';
    ?>
</div>