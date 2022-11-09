<?php session_start(); ?>	
<h2>Transaksi Aliran Tunai</h2>
<form action="javascript:registeraw()">
<div class='col lbl'>Perkara</div>
<div class='col lda'> : <input type="text" id="at_perkara" /></div>
<div class='clear'></div>

<div class='col lbl'>Daripada / Kepada</div>
<div class='col lda'> : <?php senaraikakitangan(); ?>
</div><div class='clear'></div>

<div class='col lbl'>Jumlah </div>
<div class='col lda'> : <input type="text" id="at_jumlah" /></div>
<div class='clear'></div>

<div class='col lbl'>Jenis </div>
<div class='col lda'> : 
    <select id='at_kategori' onchange="showgo('zakacc',1)" >
    	<option value='0'>Pilih jenis transaksi...</option>
        <option value='1' >Masuk</option>
        <option value='2'>Keluar</option>
    </select>
</div><div class='clear'></div>

<div id='zakacc' style='display:none;'>
<div class='col lbl'>Akaun ZAK </div>
<div class='col lda'> : 
    <select id='at_zak' >
    	<option value='0'>Sila pilih akaun zak...</option>
        <option value='1'>ZAK Services</option>
        <option value='2'>Malik</option>
        <option value='3'>Joe</option>
    </select>
</div><div class='clear'></div>
</div>







<div id='maklumatemas'>
<h2>Maklumat Emas</h2>
<div class='col lbl'>Berat </div>
<div class='col lda'> : <input type="text" id="at_beratEmas"/> gram</div>
<div class='clear'></div>

<!--<div class='col lbl'>Mutu </div>
<div class='col lda'> : <?php //listmutu('at_mutu'); ?></div>
<div class='clear'></div>-->

<div class='col lbl'>Nilai </div>
<div class='col lda'> : <input type="text" id="at_guna" />
	<!--<span onclick='daftaremas()'> Daftar Maklumat Emas</span>-->
</div>
<div class='clear'></div>

<div class='col lbl'>&nbsp;</div>
<div class='col lda'></div>
<div class='clear'></div>

</div>
<div id='emasmasuk'></div>

<div class='col lbl'>&nbsp;</div>
<div class='col lda'><button onclick='registeraw()'>Lakukan Transaksi</button></div>
<div class='clear'></div>
</form>