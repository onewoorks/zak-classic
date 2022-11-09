<h2>Daftar Cawangan Baru</h2>
    <form method="get" action="javascript:insertCawangan();">
    <div>
    	<div class="col lbl">Nama Ibu Pejabat</div>
        <div class='col lda'>: <input type="text" id="caw_head" onKeyUp="keysearch()" ></div>
        <input type="hidden" id="newcawval"  >
        <div class='clear'></div>
        <div id="caw_sh" style="display:none;"></div>
        
        <div class="col lbl">Nama Cawangan </div>
        <div class='col lda'>: <input type="text" id="caw_name" onFocus="document.getElementById('caw_sh').style.display='none'"></div>
        <div class='clear'></div>
        
        <div class="col lbl">Alamat</div>
        <div class='col lda'>:<textarea id="caw_alamat" rows="4"></textarea></div>
        <div class='clear'></div>
        
        <div class="col lbl">No Telefon </div>
        <div class='col lda'>: <input type="text" id="caw_tel"></div>
        <div class='clear'></div>
        
        <div id='newcaw' style='display:none;' >
        <h2>Wakil Ahli Dalam Cawangan</h2>
        <div class="col lbl"> Nama </div>
        <div class='col lda'><input type="text" id="stf_nama"></div>
        <div class='clear'></div>
        
        <div class="col lbl"> Nama Bank </div>
        <div class='col lda'><?php senaraibank('banker'); ?></div>
        <div class='clear'></div>
       
        <div class="col lbl"> No Akaun </div>
        <div class='col lda'><input type="text" id="stf_account"></div>
        <div class='clear'></div>
        
        </div>
        
        <div class='col lbl'>&nbsp;</div>
        <div class='col lda'><button type="submit">Daftar</button></div>
        <div class='clear'></div>
        
    </div>
    </form>