function spePaging(x){
    nocache = Math.random();
    http.open('get', 'apps/sistemPengurusanEmas/viewer/scripts/switcher.php?a='+x+'&nocache='+nocache);
    http.onreadystatechange = spePagingResult;
    http.send(null);
    document.getElementById('appspagespe').innerHTML = "Processing...";
}

function spePagingResult(){
    if(http.readyState==4){
        var response = http.responseText;
        document.getElementById('appspagespe').innerHTML = response;
    }
}