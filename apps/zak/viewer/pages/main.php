
<h2>Paparan Utama</h2>
<iframe src='includes/graph/graph.php' width="850px" height="350px" frameborder="0"></iframe>
<h2>Ringkasan Kewangan ZAK</h2>

<?php

include('zak/includes/pages/summary.php');
	$summary = new rumusan;
	$summary->display();	
?>