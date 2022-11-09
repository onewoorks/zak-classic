<?php   
 include('../config.php');   
 include("pChart/pData.php");   
 include("pChart/pChart.php");
 
 function totalday($x){
 	return date('t',mktime(0,0,0,$x,1,0));
 }
 
 function getLatestMonth($x){
 	switch($x){
		case 1;
			$fi = "min(sv_date)";
			break;
		case 2;
			$fi = "max(sv_date)";
			break;
		default:
			break;
	}	
 	$a = mysqli_query("SELECT $fi as result FROM tbl_servis LIMIT 1");
	while($b=mysqli_fetch_array($a)){
		$result = $b['result'];
		}
	$j = explode('-',$result);
	return $j[1]-0;
 }
  
 function totalservisuntung(){
 	$year = date('Y');
 	for($i=1;$i<=12;$i++){
		if(strlen($i)==1){$month = '0'.$i;} else {$month = $i;}
		$check = $year.'-'.$month.'%';
		$a = mysqli_query("SELECT sum(sv_value) FROM tbl_servis WHERE sv_date LIKE '$check%'");
		while($b=mysqli_fetch_array($a)){
			$result[] = $b['sum(sv_value)'];
		}
	}
	$val = 'aa';
	foreach($result as $val){
		$val .= $val;
	}
	return $val;
 }

 function expdate($x,$y){
 	$a = explode(" ",$x);
	$b = explode("-",$a[0]);
	switch($y){
		case 1;
			return ($b[1]-0);
			break;
		case 2;
			return $b[0]."-".$b[1];
			break;
		default:
			break;
		}
 }
 
 function getsumonmonth($x){
 	$k = date('Y-m');
	if(strlen($x)<2){
			$l = "0".$x;
		} else {
			$l = $x;
		}
	$y = $k.'-'.$l.'%';
 	$a = mysqli_query("SELECT sum(sv_value) FROM tbl_servis WHERE sv_date LIKE '$y'");
	while($b=mysqli_fetch_array($a)){
		//if($b['sum(sv_value)']==0){
//			return 0;
//		} else {
		return $b['sum(sv_value)'];
		//}
	}
 }
 
 function getsumkeluaronmonth($x){
	$k = date('Y-m');
	if(strlen($x)<2){
			$l = "0".$x;
		} else {
			$l = $x;
		}
	$y = $k.'-'.$l.'-%';
 	$a = mysqli_query("SELECT sum(ak_value) FROM tbl_akaun WHERE ak_type='2' and ak_date LIKE '$y'");
	while($b=mysqli_fetch_array($a)){
		//if($b['sum(ak_value)']==0){
//			return 0;
//		} else {
		return $b['sum(ak_value)'];
		//}
	}
 }
 
 for($i=0;$i<=totalday(2);$i++){
 	if($i>0){$arr[] = getsumonmonth($i);}
	else { $arr[] = '';}
 }
 
 for($i=0;$i<=12;$i++){
 	if($i>0){$arr2[] = getsumkeluaronmonth($i);}
	else { $arr2[] = '';}
 }

 //$arr = array('',10,20,3,50,40,90,16,19,40,10,11,21);
 //$arr2 = array('',4,70,50,30,90,10,6,2,7,32,22,10);
 
 $DataSet = new pData;     
 $DataSet->AddPoint($arr,"Serie1");
 $DataSet->AddPoint($arr2,"Serie2");
 $DataSet->AddAllSeries();   
 $DataSet->SetAbsciseLabelSerie();   
 $DataSet->SetSerieName("Untung Servis","Serie1");   
 $DataSet->SetSerieName("Komisen Keluar","Serie2");      
 $DataSet->SetYAxisName("Jumlah Wang Masuk");
 $DataSet->SetXAxisName("Bulan");
 $DataSet->SetYAxisUnit(" MYR");
 $DataSet->SetXAxisUnit("");
  
 // Initialise the graph   
 $Test = new pChart(700,250);
 $Test->setFontProperties("Fonts/tahoma.ttf",8);   
 $Test->setGraphArea(90,30,650,200);   
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
 $Test->drawTitle(60,22,'Jumlah Wang Masuk Setiap Hari Bagi Bulan '.date('F'),50,50,50,585);   
 $Test->Stroke("servis.png");
?>