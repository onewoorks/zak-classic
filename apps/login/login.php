<?
session_start();
//include('obs.php');
?>
<head>
    <link href="scripts/design.css" rel="stylesheet" type="text/css" />
    <link href="scripts/cal.css" rel="stylesheet" type="text/css" />
    <script src="scripts/ajax_fm.js" type="text/javascript" language="javascript"></script>
    <script src="scripts/javascript.js" type="text/javascript" language="javascript"></script>
    <script src='jx.php?js=cal.js' type="text/javascript" language="javascript"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Kedai Emas Ariffin</title>
</head>

<div id="pagechange">
    <?php echo $_SESSION[0]; ?>
    <center>
        <div id='insertbox'>
            <div class='loginField'>
                <img src='images/loginhead.png' />
                <form method="get"  action="">
                    <input type="text" id="us_name" style='width: 200px; display: inline-block;' value="Nama Pengguna" onclick="emptyField('us_name')"  onfocus="emptyField('us_name')" onkeyup="checkmate()" />
                    <input type="text" id="us_pass"  style="width: 200px; " onclick="replaceT(this)"  onfocus="replaceT(this)" onkeyup="checkmate()" value="Kata Laluan" />
                    <button type="submit" id="execute" style='display:inline-block;' onclick="checkuname();" >Login</button>
                </form>
            </div>
        </div>
    </center>
</div>

<div id='user' ></div>
<script type="text/javascript">var runFancy = true;</script>
<script type="text/javascript">
    function emptyField(x){document.getElementById(x).value = "";}
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