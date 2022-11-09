<?php   
include('../config.php');   
include("pChart/pData.php");   
include("pChart/pChart.php");

class graphData{
	public function monthData($x){
		$a = date('Y-m-').'%';
		$b = mysqli_query("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$x' and at_timeDate LIKE '$a'");
		while($c=mysqli_fetch_array($b)){
			return $c['sum(at_jumlah)']/1000;
		}
	}
	public function progress($jenis){
		$j = 0;
		for($i=0;$i<=6;$i++){
			$a = date('Y-m',mktime(date('H'),date('i'),date('s'),date('m')-$i,date('d'),date('Y')));
			$b[] = $a.'%';
		}
		
		foreach($b as $c){
			$j++;
			$d = trim($c);
			$ab = mysqli_query("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$jenis' and at_timeDate LIKE '$d'");
			while($ac=mysqli_fetch_array($ab)){
				if($j<=6){
					if($ac['sum(at_jumlah)']==0){ 
						$re = '0'.','; } else { 
						$re = $ac['sum(at_jumlah)'].','; }
				} else {
					if($ac['sum(at_jumlah)']==0){ 
						$re = 0; } else {
						$re = $ac['sum(at_jumlah)'];	}
				}
				$result .= $re;
			}
			return $result;
		}
	}
}


function progress($jenis){
	for($i=0;$i<=6;$i++){
		$a = date('Y-m',mktime(date('H'),date('i'),date('s'),date('m')-$i,date('d'),date('Y')));
		$b[] = $a.'%';
	}
	for($j=0;$j<=6;$j++){
		$ab = mysqli_query("SELECT sum(at_jumlah) FROM tbl_alirantunai WHERE at_kategori='$jenis' and at_timeDate LIKE '$b[$j]'");
		while($ac=mysqli_fetch_array($ab)){
			if($ac['sum(at_jumlah)']==0){
				$res = 0;
				} else {
				$res = $ac['sum(at_jumlah)']/1000;
				}
			$result .= $res.', ';
		}	
	}
	return $result;
}

function generateMonth(){
	$result = '';
	for($i=0;$i<=5;$i++){
		$a = date("M 'y",mktime(date('H'),date('i'),date('s'),date('m')-$i,date('d'),date('Y')));
		$b[] = $a;
	}
	foreach($b as $c){
		$result .= $c.', ';
	}
	return $result;
}

$jm = explode(', ',generateMonth());
$arr3 = array($jm[5],$jm[4],$jm[3],$jm[2],$jm[1],$jm[0]);

//$arr3 = array("Jan","Feb","Mac","Apr","May","Jun","Jul","Aug","Sep","Okt","Nov","Dec");

$gdata = new graphData;

$jk = explode(',',progress(1));
$arr = array($jk[5],$jk[4],$jk[3],$jk[2],$jk[1],$jk[0]);

$jl = explode(',',progress(2));
$arr2 = array($jl[5],$jl[4],$jl[3],$jl[2],$jl[1],$jl[0]);

//$arr = array(10,20,3,50,$gdata->monthData(1),90,16,19,40,10,11,21);
//$arr2 = array(4,70,50,30,$gdata->monthData(2),10,6,2,7,32,22,10);

$DataSet = new pData;     
$DataSet->AddPoint($arr,"Serie1");
$DataSet->AddPoint($arr2,"Serie2");
$DataSet->AddPoint($arr3,"Serie3");
$DataSet->AddSerie("Serie1");   
$DataSet->AddSerie("Serie2");
$DataSet->SetAbsciseLabelSerie("Serie3"); 
$DataSet->SetSerieName("Masuk","Serie1");   
$DataSet->SetSerieName("Keluar","Serie2");      
$DataSet->SetYAxisName("Jumlah Wang (RM)");
$DataSet->SetXAxisName("Bulan");
$DataSet->SetYAxisUnit(" K");
$DataSet->SetXAxisUnit("");

// Initialise the graph   
$Test = new pChart(830,300);
$Test->setFontProperties("Fonts/tahoma.ttf",8);   
$Test->setGraphArea(90,30,800,280);   
$Test->drawFilledRoundedRectangle(7,7,673,223,5,255,255,255);   
$Test->drawRoundedRectangle(5,5,675,225,5,255,255,255);   
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,150,150,150,TRUE,0,2);   
$Test->drawGrid(2,TRUE,230,230,230,50);

// Draw the 0 line   
$Test->setFontProperties("Fonts/tahoma.ttf",6);   
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);   

// Draw the line graph
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());   
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);   

// Finish the graph   
$Test->setFontProperties("Fonts/tahoma.ttf",8);   
$Test->drawLegend(100,35,$DataSet->GetDataDescription(),255,255,255);   
$Test->setFontProperties("Fonts/tahoma.ttf",10);   
$Test->drawTitle(250,22,"Aliran Wang Tunai ZAK ".date('Y'),50,50,50,585);   
$Test->Stroke("servis.png");
?>