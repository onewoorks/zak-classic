<?php
session_start();
//include('obs.php');

include_once('includes/functions.php');
if (isset($_POST['us_name'])):
    checkuser($_POST['us_name'], $_POST['us_pass']);
endif;
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="scripts/design.css" rel="stylesheet" type="text/css" />
        <link href="scripts/cal.css" rel="stylesheet" type="text/css" />
        <script src="scripts/ajax_fm.js" type="text/javascript" language="javascript"></script>
        
        <script src='scripts/cal.js' type="text/javascript" language="javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="scripts/javascript.js" type="text/javascript" language="javascript"></script>

        <title>Kedai Emas Ariffin [ZAK]</title>
        <script type="text/javascript">var runFancy = true;</script>
        <script type="text/javascript">
            function emptyField(x) {
                document.getElementById(x).value = "";
            }
            function replaceT(obj) {
                var newO = document.createElement('input');
                newO.setAttribute('type', 'password');
                newO.setAttribute('name', obj.getAttribute('name'));
                obj.parentNode.replaceChild(newO, obj);
                newO.style.width = "200px";
                newO.id = "us_pass";
                newO.focus();
            }
            function checkmate() {
                if (event.keyCode == 13) {
                    document.getElementById('execute').click();
                }
            }

        </script>
    </head>

    <body>
        <?php if (!isset($_SESSION['uid'])) { ?>
            <div id="pagechange">
                <center>
                    <div id='insertbox'>
                        <div class='loginField'>
                            <img src='images/loginhead.png' />
                            <form method="post" action=''>
                                <input type="text" name="us_name" id="us_name" style='width: 200px; display: inline-block;' value="Nama Pengguna" onclick="emptyField('us_name')"  onfocus="emptyField('us_name')" onkeyup="checkmate()" />
                                <input type="text" name="us_pass" id="us_pass"  style="width: 200px;" onclick="replaceT(this)"  onfocus="replaceT(this)" onkeyup="checkmate()" value="Kata Laluan" />
                                <button type="submit" id="execute" style='display:inline-block;'  >Login</button>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
            <?php
        } else {
            include_once('includes/config.php');
            //include_once('includes/functions.php');
            include_once('apps/index.php');
        }
        ?>
        <div id='user'></div>
        <script>
            function semakantransaksi() {
                var startDate = $('#sdate').val();
                var endDate = $('#edate').val();
                $.ajax({
                   url : 'apps/zak/controller/ajax.php',
                   data : {method:'transaksi',startDate:startDate,endDate:endDate},
                   success : function(data){
                       $('#transResult').html(data);
                   }
                });
            }
        </script>
    </body>
</html>
