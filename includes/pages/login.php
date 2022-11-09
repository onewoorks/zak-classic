<div id="pagechange">

<center>
<div id='insertbox'>
	<div class='loginField'>
		<img src='images/loginhead.png' />
    <form method="post"  action="">
    <input type="text" id="us_name" style='width: 200px; display: inline-block;' value="Nama Pengguna" onclick="emptyField('us_name')"  onfocus="emptyField('us_name')" onkeyup="checkmate()" />
   <input type="text" id="us_pass"  style="width: 200px; " onclick="replaceT(this)"  onfocus="replaceT(this)" onkeyup="checkmate()" value="Kata Laluan" />
 <button type="submit" id="execute" style='display:inline-block;' onclick="checkuname();" >Login</button>
    </form>
    </div>
</div>
</center>
</div>

<script type="text/javascript">var runFancy = true;</script>
<script type="text/javascript">
		 function emptyField(x){				document.getElementById(x).value = "";			}
		 function replaceT(obj){
			var newO=document.createElement('input');
			newO.setAttribute('type','password');
			newO.setAttribute('name',obj.getAttribute('name'));
			obj.parentNode.replaceChild(newO,obj);
			newO.style.width = "200px";
			newO.id = "us_pass";
			newO.focus();
		}
		function checkmate(){
			if (event.keyCode==13){
				document.getElementById('execute').click();
			}	
		}

</script>