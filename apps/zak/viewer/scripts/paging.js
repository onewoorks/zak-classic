function pagemenu(x){
	document.getElementById('appspagespe').innerHTML = "Processing...";
	nocache = Math.random();
	http.open('get', 'apps/zak/viewer/scripts/switcher.php?p='+x+'&nocache='+nocache);
	http.onreadystatechange = showpage;
	http.send(null);
}
function showpage(){
	if(http.readyState==4){
		var response = http.responseText;
		document.getElementById('appspagespe').innerHTML = response;
	}
}