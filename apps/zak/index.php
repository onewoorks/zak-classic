
<?php
//session_start();
include('zak/model/functions.php');
include_once 'zak/model/aliranbank.php';

echo "<div class='menu'>";
 echo "<div class='box'>";
 include("zak/viewer/menu/menu.php");
 echo "</div>";
 echo "<div class='spacerMenu'>&nbsp;</div>"; 
 echo "<div class='box'>";
 include("zak/viewer/menu/ringkasanTransaksi.php");
 echo "</div>";
 echo "</div>";
 
 echo "<div class='action'>";
 echo "<div id='appspagespe'>";
 include('zak/viewer/pages/main.php');
 echo "</div>";
 echo "</div>";

?>