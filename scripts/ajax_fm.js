function createObject() {
    var request_type;
    var browser = navigator.appName;
    if (browser == "Microsoft Internet Explorer") {
        request_type = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        request_type = new XMLHttpRequest();
    }
    return request_type;
}

var http = createObject();
var nocache = 0;

function checkuname() {
    var a = encodeURI(document.getElementById('us_name').value);
    var b = encodeURI(document.getElementById('us_pass').value);
    nocache = Math.random();
    http.open('get', 'checkuser.php?un=' + a + '&up=' + b + '&nocache=' + nocache);
    //document.getElementById('pagechange').innerHTML = "Checking....";
    http.onreadystatechange = showuname;
    http.send(null);
}
function showuname() {
    if (http.readyState == 4) {
        var response = http.textResponse;
        //alert(http.responseText);
        //setTimeout(alert(response),10000);
    }
}

function gotomain(x) {
    window.location.reload();
    document.getElementById('pagechange').innerHTML = x;
    document.getElementById('user').innerHTML = x;

}

function logout() {
    nocache = Math.random();
    http.open('get', 'includes/executer/execute.php?t=3&nocache=' + nocache);
    http.onreadystatechange = successlogout;
    http.send(null);
}
function successlogout() {
    if (http.readyState == 4) {
        var response = http.textResponse;
        //alert(http.responseText);
        window.location = 'logout.php';
    }
}

function insertCawangan() {
    var a = encodeURI(document.getElementById('caw_head').value);
    var b = encodeURI(document.getElementById('caw_name').value);
    var c = encodeURI(document.getElementById('caw_alamat').value);
    //var d = encodeURI(document.getElementById('caw_staff').value);
    var e = encodeURI(document.getElementById('caw_tel').value);
    var f = encodeURI(document.getElementById('newcawval').value);
    if (f == 0) {
        var g = encodeURI(document.getElementById('stf_nama').value);
        var h = encodeURI(document.getElementById('stf_account').value);
        var i = encodeURI(document.getElementById('banker').value);
    }
    nocache = Math.random();
    if (f != 0) {
        http.open('get', 'includes/executer/execute.php?t=4&a=' + a + '&b=' + b + '&c=' + c + '&d=' + e + '&nocache=' + nocache);
    } else {
        http.open('get', 'includes/executer/execute.php?t=4&a=' + a + '&b=' + b + '&c=' + c + '&d=' + e + '&g=' + g + '&h=' + h + '&i=' + i + '&f=' + f + '&nocache=' + nocache);
    }
    http.onreadystatechange = showcawangan;
    http.send(null);
}
function showcawangan() {
    if (http.readyState == 4) {
        var response = http.responseText;
        alert(response);
    }
}

function keysearch() {
    var a = encodeURI(document.getElementById('caw_head').value);
    nocache = Math.random();
    http.open('get', 'includes/iframe/cawsearch.php?a=' + a + '&nocache=' + nocache);
    http.onreadystatechange = showsearch;
    http.send(null);
}
function showsearch() {
    if (http.readyState == 4) {
        var response = http.responseText;
        if (response == 0) {
            document.getElementById('caw_sh').style.display = "none";
            document.getElementById('newcaw').style.display = 'block';
            document.getElementById('newcawval').value = 0;
        } else {
            document.getElementById('caw_sh').style.display = "block";
            document.getElementById('caw_sh').innerHTML = response;
            document.getElementById('newcaw').style.display = 'none';
            document.getElementById('newcawval').value = 1;
        }
    }
}

function daftarkakitangan() {
    var a = encodeURI(document.getElementById('stf_nama').value);
    var b = encodeURI(document.getElementById('stf_tel').value);
    var c = encodeURI(document.getElementById('stf_account').value);
    var d = encodeURI(document.getElementById('caw_id').value);
    var e = encodeURI(document.getElementById('banker').value);
    nocache = Math.random();
    http.open('get', 'includes/executer/execute.php?t=6&sn=' + a + '&st=' + b + '&sa=' + c + '&ci=' + d + '&bi=' + e + '&nocache=' + nocache);
    http.onreadystatechange = showkakitangan;
    http.send(null);
}
function showkakitangan() {
    if (http.readyState == 4) {
        var response = http.responseText;
        alert("Pendaftaran Ahli Selesai");
    }
}



function changeKakitanganList() {
    var a = encodeURI(document.getElementById('caw_id').value);
    nocache = Math.random();
    http.open('get', 'includes/executer/execute.php?t=5&a=' + a + '&nocache=' + nocache);
    http.onreadystatechange = showkakitanganlist;
    http.send(null);
}
function showkakitanganlist() {
    if (http.readyState == 4) {
        var response = http.responseText;
        document.getElementById('stf_list').innerHTML = response;
    }
}

function deletekakitangan(x) {
    var a = x;
    var b = encodeURI(document.getElementById('caw_id').value);
    nocache = Math.random();
    http.open('get', 'includes/executer/_deletekakitangan.php?a=' + a + '&b=' + b + '&nocache=' + nocache);
    http.onreadystatechange = deletekakitanganpilih;
    http.send(null);
}
function deletekakitanganpilih() {
    if (http.readyState == 4) {
        var response = http.responseText;
        alert("Maklumat Kakitangan Telah dibuang daripada sistem ini");
        document.getElementById('stf_list').innerHTML = response;
    }
}

function updatebank() {
    //alert('1111');
    var a = encodeURI(document.getElementById('banker').value);
    nocache = Math.random();
    http.open('get', 'includes/executer/_bankshow.php?a=' + a + '&nocache' + nocache);
    http.onreadystatechange = showbank;
    http.send(null);
}
function showbank() {
    if (http.readyState == 4) {
        var response = http.responseText;
        document.getElementById('acct').style.display = 'block';
        //document.getElementById('rmd').innerHTML = response;
    }
}

function registeraw() {
    var a = encodeURI(document.getElementById('at_perkara').value);
    var b = encodeURI(document.getElementById('stf_id').value);
    var c = encodeURI(document.getElementById('at_jumlah').value);
    var e = encodeURI(document.getElementById('at_beratEmas').value);
    var f = encodeURI(document.getElementById('at_guna').value);
    if (a == '') {
        alert("Sila masukkan perkara bagi aliran ini");
        document.getElementById('at_perkara').focus();
        return;
    }
    if (b == 0) {
        alert("Sila pilih kepada atau daripada transaksi ini dilakukan");
        document.getElementById('stf_id').focus();
        return;
    }
    if (c == '') {
        alert("Masukkan jumlah bagi transaksi " + a);
        document.getElementById('at_jumlah').focus();
        return;
    }
    if (document.getElementById('at_kategori').value == 0) {
        alert("Sila buat pilihan transaksi bagi pendaftaran ini.");
        document.getElementById('at_kategori').focus();
        return;
    }
    if (document.getElementById('at_kategori').value == 1) {
        if (document.getElementById('at_zak').value == 0) {
            alert("Sila buat pilihan akaun zak");
            document.getElementById('zakacc').focus();
            return;
        }
    }
    registervalid();
}
function registervalid() {
    nocache = Math.random();
    var a = encodeURI(document.getElementById('at_perkara').value);
    var b = encodeURI(document.getElementById('stf_id').value);
    var c = encodeURI(document.getElementById('at_jumlah').value);
    var d = encodeURI(document.getElementById('at_kategori').value);
    var e = encodeURI(document.getElementById('at_beratEmas').value);
    var f = encodeURI(document.getElementById('at_guna').value);
    var g = encodeURI(document.getElementById('at_zak').value);
    http.open('get', 'includes/executer/execute.php?t=1&a=' + a + '&b=' + b + '&c=' + c + '&d=' + d + '&e=' + e + '&f=' + f + '&g=' + g + '&nocache=' + nocache);
    http.onreadystatechange = doneregisteraw;
    http.send(null);
}
function doneregisteraw() {
    if (http.readyState == 4) {
        clearform('daftartransaksi');
        //var a = http.responseText;
        alert('Pendaftaran Aliran Telah Selesai');
        //window.location.reload(true);
        //apps(1);

        //pagemenu(10);
        //refreshringkasan();
    }
}


function clearform(fname) {
    var a = fname;
    document.forms[a].reset();
}

function daftaremas() {
    nocache = Math.random();
    var a = encodeURI(document.getElementById('at_beratEmas').value);
    //var b = encodeURI(document.getElementById('at_mutu').value);
    var c = encodeURI(document.getElementById('at_guna').value);
    var d = encodeURI(document.getElementById('stf_id').value);
    if (b == 0) {
        alert("Sila Pilih Mutu Emas");
        return;
    }
    //http.open('get','includes/executer/execute.php?t=2&a='+a+'&b='+b+'&c='+c+'&d='+d+'&nocache='+nocache);
    http.open('get', 'includes/executer/execute.php?t=2&a=' + a + '&c=' + c + '&d=' + d + '&nocache=' + nocache);
    http.onreadystatechange = donedaftaremas;
    http.send(null);
}
function donedaftaremas() {
    if (http.readyState == 4) {
        var a = http.responseText;
        document.getElementById('at_beratEmas').value = '';
        document.getElementById('at_mutu').value = 0;
        document.getElementById('at_guna').value = '';
        document.getElementById('emasmasuk').innerHTML = a;
    }
}

function semakcawangan(x) {
    nocache = Math.random();
    http.open('get', 'includes/executer/execute.php?t=7&a=' + x + '&nocache=' + nocache);
    http.onreadystatechange = donesemak;
    http.send(null);
    document.getElementById('keputusansemakan').innerHTML = "<center><img src='images/loading.gif' /></center>";
}
function donesemak() {
    if (http.readyState == 4) {
        var a = http.responseText;
        document.getElementById('keputusansemakan').innerHTML = a;
    }
}

function showgo(x, y) {
    var a = document.getElementById('at_kategori').value;
    if (a == 1) {
        document.getElementById(x).style.display = 'block';
    } else {
        document.getElementById(x).style.display = 'none';
    }
}

function refreshringkasan() {
    nocache = Math.random();
    http.open('get', 'includes/pages/ringkasantransaksi.php?nocache=' + nocache);
    http.onreadystatechange = donerefresh;
    http.send(null);
}
function donerefresh() {
    if (http.readyState == 4) {
        var a = http.responseText;
        document.getElementById('ringkasantransaksi').innerHTML = a;
    }
}

function buangcaw(x) {
    nocache = Math.random();
    http.open('get', 'includes/executer/execute.php?t=10&a=' + x + '&nocache=' + nocache);
    http.onreadystatechange = donebuangcaw;
    http.send(null);
}
function donebuangcaw() {
    if (http.readyState == 4) {
        var a = http.responseText;
        var b = a.split('###');
        alert(b[1]);
        document.getElementById('caw' + b[0]).style.display = 'none';
    }
}

function buangatini(x) {
    nocache = Math.random();
    http.open('get', 'includes/executer/execute.php?t=8&a=' + x + '&nocache=' + nocache);
    http.onreadystatechange = donebuangatini;
    http.send(null);
}
function donebuangatini() {
    if (http.readyState == 4) {
        var a = http.responseText;
        var b = a.split('###');
        alert(b[1]);
        document.getElementById('at' + b[0]).style.display = 'none';
    }
}

function semakancawangan() {
    var x = encodeURI(document.getElementById('sdate').value);
    var y = encodeURI(document.getElementById('edate').value);
    var z = encodeURI(document.getElementById('scaw').value);
    if (x == '') {
        alert("Sila masukkan tarikh mula untuk membuat semakan");
        return;
    }
    if (y == '') {
        alert("Sila masukkan tarikh akhir untuk membuat semakan");
        return;
    }
    nocache = Math.random();
    http.open('get', 'apps/zak/includes/executer/execute.php?t=9&x=' + x + '&y=' + y + '&z=' + z + '&nocache=' + nocache);
    http.onreadystatechange = donesemakcawangan;
    http.send(null);
    document.getElementById('keputusansemakan').innerHTML = "<center><img src='images/loading.gif' /></center>";
}
function donesemakcawangan() {
    if (http.readyState == 4) {
        var a = http.responseText;
        document.getElementById('keputusansemakan').innerHTML = a;
    }
}

function laporanikutpilihan(){
    var datestart = encodeURI(document.getElementById('datestart').value);
    var dateend = encodeURI(document.getElementById('dateend').value);
    if (datestart == '') {
        alert("Sila masukkan tarikh mula untuk membuat semakan");
        return;
    }
    if (dateend == '') {
        alert("Sila masukkan tarikh akhir untuk membuat semakan");
        return;
    }
    nocache = Math.random();
    http.open('get', 'apps/zak/includes/executer/execute.php?t=19&datestart=' + datestart + '&dateend=' + dateend + '&nocache=' + nocache);
    http.onreadystatechange = donelaporaikutpilihan;
    http.send(null);
    document.getElementById('keputusansemakan').innerHTML = "<center><img src='images/loading.gif' /></center>";
}
function donelaporaikutpilihan() {
    if (http.readyState == 4) {
        var a = http.responseText;
        document.getElementById('keputusansemakan').innerHTML = a;
    }
}

function semakancawanganbakiterakhir() {
    var x = encodeURI(document.getElementById('sdate').value);
    var y = encodeURI(document.getElementById('edate').value);
    var z = encodeURI(document.getElementById('scaw').value);

    if (y == '') {
        alert("Sila masukkan tarikh akhir untuk membuat semakan");
        return;
    }
    nocache = Math.random();
    http.open('get', 'apps/zak/includes/executer/execute.php?t=18&stardate='+x+'&y=' + y + '&z=' + z + '&nocache=' + nocache);
    http.onreadystatechange = donesemakcawanganbakiterakhir;
    http.send(null);
    document.getElementById('keputusansemakan').innerHTML = "<center><img src='images/loading.gif' /></center>";
}
function donesemakcawanganbakiterakhir() {
    if (http.readyState == 4) {
        var a = http.responseText;
        document.getElementById('keputusansemakan').innerHTML = a;
    }
}


function buangahli(x) {
    nocache = Math.random;
    http.open('get', 'includes/executer/execute.php?t=11&a=' + x + '&nocache=' + nocache);
    http.onreadystatechange = donebuangahli;
    http.send(null);
}
function donebuangahli() {
    if (http.readyState == 4) {
        var a = http.responseText;
        var b = a.split('###');
        alert(b[1]);
        document.getElementById('ahli' + b[0]).style.display = 'none';
    }
}

function appsOpen(x) {
    //var a = document.getElementById('useridname').value;
    var a = 2;
    var menu;
    nocache = Math.random();
    http.open('get', 'apps/switcher.php?a=' + x + '&nocache=' + nocache);
    http.onreadystatechange = appsdone;
    http.send(null);
    document.getElementById('appspage').innerHTML = "Processing...";
    for (i = 0; i < 3; i++) {
        if (i == x) {
            document.getElementById("menu" + i).className = "texl activeApp";
        } else {
            document.getElementById("menu" + i).className = "texl normalApp";
        }
    }
}

function appsdone() {
    if (http.readyState == 4) {
        var response = http.responseText;
        document.getElementById('appspage').innerHTML = response;
    }
}

function cetakMaklumat(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

