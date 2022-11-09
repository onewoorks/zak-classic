<h2>Maklumat dan Baki Terakhir Setiap Cawangan</h2>
<div class='infobox'>
    <div class='col lbl'>Cawangan </div>
    <div class='col lda'><?php echo updateselectcaw(); ?></div>
    <div class='clear'></div>
    <div class='col lbl'>Tarikh Mula </div>
    <div class='col lda'><input type='text' id='sdate' onfocus="showCalendarControl(this)" /></div>
    <div class='col lbl'>Tarikh Terakhir</div>
    <div class='col lda'><input type='text' id='edate' onfocus='showCalendarControl(this)'/></div>
    <div class='clear'></div>
    <div class='col lbl'>&nbsp;</div>
    <div class='col lda'><button onclick='semakancawanganbakiterakhir();' >Kemaskini Semakan</button></div>
    <div class='clear'></div>
</div>
<div id='keputusansemakan'>Ruang Paparan Hasil Carian </div>
