<?
session_start();
echo "<h2>Laporan Bulanan</h2>";
$laporan = new transaksi;
$laporan->bulanan();
?>