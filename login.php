<div id="pagechange">
    <?php echo $_SESSION[0]; ?>
    <center>
        <div id='insertbox'>
            <div class='loginField'>
                <img src='images/loginhead.png' />
                <form method="post" action="">
                    <input type="text" name='us_name' id="us_name" style='width: 200px; display: inline-block;' value="Nama Pengguna" onclick="emptyField('us_name')"  onfocus="emptyField('us_name')" onkeyup="checkmate()" />
                    <input type="text" name='us_pass' id="us_pass"  style="width: 200px;" onclick="replaceT(this)"  onfocus="replaceT(this)" onkeyup="checkmate()" value="Kata Laluan" />
                    <button type="submit" id="execute" style='display:inline-block;' onclick="checkuname();" >Login</button>
                </form>
            </div>
        </div>
    </center>
</div>