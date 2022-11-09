<?php session_start; ?>
<h2>Paparan Utama</h2>
<iframe src='includes/graph/graph.php' width="850px" height="350px" frameborder="0"></iframe>
<h2>Ringkasan Kewangan ZAK</h2>
<?
	$summary = new rumusan;
	$summary->display();
?>
