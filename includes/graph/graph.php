<?php   
include('../config.php');   
include("pChart/pData.php");   
include("pChart/pChart.php");

$db = new Connection();


function progress($jenis){
	for($i=0;$i<=6;$i++){
		$a 		= date('Y-m',mktime(date('H'),date('i'),date('s'),date('m')-$i,date('d'),date('Y')));
		$b[] 	= $a.'%';
	}
	$result = [];
	for($j=0;$j<=6;$j++){
		global $db;
		$ab = $db->execute("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$jenis' and at_timeDate LIKE '$b[$j]'");
		while($ac=mysqli_fetch_array($ab)){
			if($ac['sum(at_jumlah)']==0){
				$result[] = 0;
				} else {
				$res = $ac['sum(at_jumlah)']/1000;
				$result[] = $res;
				}
		}	
	}
	return $result;
}

function generateMonth(){
	$result = [];
	for($i=0;$i<=5;$i++){
		$a = date("M y",mktime(date('H'),date('i'),date('s'),date('m')-$i,date('d'),date('Y')));
		$b[] = $a;
	}
	foreach($b as $c){
		$result[] = $c;
	}
	return $result;
}

$month = array_reverse(generateMonth());
$masuk = array_reverse(progress(1));
$keluar = array_reverse(progress(2));
?>

<div style="height:320px">
	<canvas id="myChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
	let bulan = <?php echo json_encode($month);?>;
  	const labels = bulan;

  	let masuk = JSON.parse("<?php echo json_encode($masuk);?>");
  	let keluar = JSON.parse("<?php echo json_encode($keluar);?>");
	const data = {
		labels: labels,
		datasets: [{
		label: 'Wang Masuk',
		backgroundColor: 'rgb(124,252,0)',
		borderColor: 'rgb(124,252,0)',
		data: masuk,
		},{
		label: 'Wang Keluar',
		backgroundColor: 'rgb(255, 99, 132)',
		borderColor: 'rgb(255, 99, 132)',
		data: keluar,
		}]
	};

  const config = {
    type: 'line',
    data: data,
    options: {
		responsive: true,
		maintainAspectRatio: false
	}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
