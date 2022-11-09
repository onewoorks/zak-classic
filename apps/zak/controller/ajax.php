<?php
require_once '../model/functions.php';
include_once '../model/aliranbank.php';

$method = $_REQUEST['method'];
switch ($method):
    case 'transaksi':
        $rekod = new transaksi;
        $rekod->tarikhStart = $_REQUEST['startDate'];
        $rekod->tarikhAkhir = $_REQUEST['endDate'];
        $rekod->transaksiIkutTarikh();
        break;

    case 'daftarAliranBank':
        $ab         = new aliranbank_model();
        $perkara    = $_REQUEST['perkara'];
        $jumlah     = (float) $_REQUEST['jumlah'];
        $kategori   = $_REQUEST['kategori'];
        $ab->values = array($perkara, $jumlah, $kategori);
        $ab->create_aliranbank();
        if ($kategori == 2):
            $ab->create_alirantunai();
        endif;
    break;

    case 'transaksiBank':
        $ab = new aliranbank_model();
        $startDate = $_REQUEST['startDate'];
        $endDate = $_REQUEST['endDate'];
        $ab->values = array($startDate, $endDate);
        $result = $ab->read_aliranbank_ikut_tarikh();
        include_once '../viewer/pages/ajax_result/aliranbank.php';
        return $result;
        break;

    case 'buangTransBank':
        $ab = new aliranbank_model;
        $ab->values = $_REQUEST['value'];
        $ab->delete_aliranbank_id();
        $result = $ab->read_aliranbank_criteria();
        include_once '../viewer/pages/ajax_result/aliranbank.php';
        return $result;
        break;
endswitch;
