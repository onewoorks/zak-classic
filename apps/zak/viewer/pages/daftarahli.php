<h2> Daftar Kakitangan</h2>

<form method="get" action="javascript:daftarkakitangan();">
    <div class="col lbl"> Cawangan</div>
    <div class='col lda'><?php senaraicawangan();?></div>
    <div class='clear'></div>
    
    <div class="col lbl"> Nama </div>
    <div class='col lda'><input type="text" id="stf_nama"></div>
    <div class='clear'></div>
    
    <div class="col lbl"> No Telefon </div>
    <div class='col lda'><input type="text" id="stf_tel"></div>
    <div class='clear'></div>
    
    <div class="col lbl"> Nama Bank </div>
    <div class='col lda'><?php senaraibank('banker'); ?></div>
    <div class='clear'></div>
    
    <div id="acct" style="display:none">
    <div class="col lbl"> No Akaun </div>
    <div class='col lda'><input type="text" id="stf_account"><span id='rmd'></span></div>
    <div class='clear'></div>
    </div>
    
    <div class='col lbl'>&nbsp;</div>
    <div class='col lda'><button type="submit">Daftar</button></div>
    <div class='clear'></div>
    
</form>