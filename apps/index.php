<?php
if(!isset($_SESSION['uid'])):
    header("Location: /zak/");
    exit;
endif;

include_once('settings.php');
	echo "<div class='topbar'>";
	echo "<div id='menu1' class='texl normalApp' onclick='appsOpen(1)'>Zak.</div>";
	echo "<div id='menu2' class='texl normalApp' onclick='appsOpen(2)'>Sistem Pengurusan Emas</div>";
	echo "<div class='tex normalApp' onclick=\"logout()\">Daftar Keluar</div>";
	echo "<div class='tex nopad'>|</div>";
	echo "<div id='menu0' class='activeApp' onclick='appsOpen(0)' style='float:right; padding:4px 6px 4px 6px;' >Profile</div>";
	echo "<div class='tex normalApp'><b>".username($_SESSION['uid'])."</b></div>";
	echo "<div class='clear'></div>";
	echo "</div>";
        ?>

<div id='appspage'>
    
	<div id='pageloc'><?php include_once('apps/home/index.php'); ?></div>
</div>
<div class='footer'>
	<?php include_once('template/footer.php'); ?>
</div>

<script type="text/javascript" src="//apps/zak/viewer/scripts/paging.js"></script>
<script type="text/javascript" src="//apps/sistemPengurusanEmas/viewer/scripts/paging.js"></script>
<script type="text/javascript" src="//scripts/jquery.js"></script>
<script type="text/javascript" src="//scripts/jpage.js"></script>