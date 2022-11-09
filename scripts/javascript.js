function outcaw() {
    document.getElementById('caw_sh').style.display = "none";
}
function selectresult(x) {
    document.getElementById('caw_head').value = x;
    document.getElementById('caw_sh').style.display = "none";
}
function laporancawangan() {
    document.getElementById('stf_caw').enable = "true";
}
function pageclick() {
    document.getElementById('test').innerHTML = "Hello World";
}

function calrmd() {
    var a = document.getElementById('rmd').innerHTML;
}

function registerAliranBank() {
    var perkara = $('#atb_perkara').val();
    var jumlah = $('#atb_jumlah').val();
    var kategori = $('#atb_kategori').val();
    $.ajax({
        url: 'apps/zak/controller/ajax.php',
        data: {method: 'daftarAliranBank', perkara: perkara, jumlah: jumlah, kategori: kategori},
        success: function() {
            alert('Pendaftaran Transaksi telah berjaya');
            document.forms[0].reset();
        }
    });
}

function semakanTransaksiBank() {
    var startDate = $('#sdate').val();
    var endDate = $('#edate').val();
    $.ajax({
        url: 'apps/zak/controller/ajax.php',
        data: {method: 'transaksiBank', startDate: startDate, endDate: endDate},
        success: function(data) {
            $('#transBankResult').html(data);
        }
    });
}

function buangTransaksiBank(x) {
    $.ajax({
        url: 'apps/zak/controller/ajax.php',
        data: {method: 'buangTransBank', value: x},
        success: function(data) {
            alert('Transaksi telah dibuang');
            $('#transBankResult').html(data);
        }
    });
}