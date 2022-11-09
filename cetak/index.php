<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <style>
            body, table {
                font-family: 'Open Sans', sans-serif;
                font-size : 12px;
            }
            .text-right { text-align: right;}
            .tright { text-align: right;}
            table { border-collapse: collapse;}

            table th { font-weight: bold; background-color: #ccc; padding:2px;}
            table td { padding:2px;}
            .border-right { border-right:  1px solid #000;}
            #table-data tr:nth-child(even) {
                background-color: #d9edf7;
            }
            @media print {
                #cetakDiv {
                    display: none;
                }
                body, table {
                    font-family: 'Open Sans', sans-serif;
                    font-size : 12px;
                }
            }
        </style>
    </head>

    <body>
        <?php
        include_once('../includes/config.php');
        include_once('../includes/functions.php');
        ?>

        <?php
        $rekod = $_REQUEST['rekod'];

        switch ($rekod):
            case 'transaksi':
                $start = $_REQUEST['start'] . ' 00:00:00';
                $end = $_REQUEST['end'] . ' 23:59:59';
                $start2 = $_REQUEST['start'] . ' 23:59:59';
                $caw = $_REQUEST['cawangan'];
                $sql = "SELECT * FROM tbl_alirantunai WHERE at_timeDate BETWEEN '$start' AND '$end' AND caw_id='$caw' ORDER BY at_timeDate ASC";
                $v = mysqli_query("SELECT at_kategori, at_jumlah, at_guna FROM tbl_alirantunai WHERE at_timeDate < '$start' AND caw_id='$caw'");
                $balDariAwal = 0;
                $keluarDariAwal = 0;
                while ($h = mysqli_fetch_array($v)):
                    if ($h['at_kategori'] == 1):
                        $balDariAwal += $h['at_jumlah'] + $h['at_guna'];
                    else:
                        $keluarDariAwal += $h['at_jumlah'] + $h['at_guna'];
                    endif;
                endwhile;

                $resultTerdahulu = array('1', $start, 'Baki Terdahulu', $balDariAwal, $keluarDariAwal);
                $masukBaru = 0 + $resultTerdahulu[3];
                $keluarBaru = 0 + $resultTerdahulu[4];


                $a = mysqli_query($sql);
                $result = array();
                $baki = 0;
                $totBaki = 0;
                $i = 2;
                $nombor = 1;
                echo "<h2>Maklumat dan Rekod Transaksi Cawangan " . getnamacawangan($caw) . "</h2>";

                while ($b = mysqli_fetch_array($a)) :
                    $result[] = $b;
                endwhile;
                echo "<table id='table-data' style='width:100%; border:1px solid #000; border-collapse: collapse;'>";
                echo "<thead>";
                echo "<tr style='border-bottom:1px solid #000;'>";
                echo "<th class='border-right'>No</th>";
                echo "<th class='border-right'>Tarikh Dan Masa</th>";
                echo "<th class='border-right'>Perkara</th>";
                echo "<th class='border-right'>Staf</th>";
                echo "<th>Masuk</th>";
                echo "<th class='border-right'>Keluar</th>";
                echo "<th>Berat</th>";
                echo "<th class='border-right'>Nilai Emas</th>";
                echo "<th>Baki</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($result as $r):
                    $i++;
                    echo "<tr style='border-bottom:1px solid #000;'>";
                    echo "<td class='border-right'>" . $nombor++ . "</td>";
                    echo "<td class='border-right'>" . $r['at_timeDate'] . "</td>";
                    echo "<td class='border-right'>" . $r['at_perkara'] . "</td>";
                    echo "<td class='border-right'>" . getahliname($r['stf_id']) . "</td>";

                    switch ($r['at_kategori']):
                        case '1':
                            $baki = curr($r['at_guna'] + $r['at_jumlah']);
                            $totBaki = $totBaki + (($r['at_guna'] + $r['at_jumlah']));
                            $masukBaru += $r['at_jumlah'] + $r['at_guna'];
                            $nilaimasuk = $nilaimasuk + $r['at_jumlah'] + $r['at_guna'];
                            echo "<td class='text-right'>" . number_format($r['at_jumlah'], 2, '.', ',') . '</td>';
                            echo '<td  class="border-right"></td>';
                            break;
                        case '2':
                            $baki = "(" . curr($r['at_jumlah'] + $r['at_guna']) . ")";
                            $totBaki = $totBaki - ($r['at_jumlah'] + $r['at_guna']);
                            $keluarBaru += $r['at_jumlah'];
                            $nilaikeluar = $nilaikeluar + $r['at_jumlah'] + $r['at_guna'];
                            echo '<td></td>';
                            echo "<td class='text-right border-right'>" . number_format($r['at_jumlah'], 2, '.', ',') . '</td>';
                            break;
                    endswitch;
                    echo "<td>";
                    if ($r['at_beratEmas'] > 0):
                        echo curr($r['at_beratEmas']);
                    endif;
                    echo "</td>";
                    echo "<td class='text-right border-right'>";
                    if ($r['at_guna'] > 0) {
                        echo curr($r['at_guna']);
                    }
                    echo "</td>";
                    echo "<td class='text-right'>" . $baki . "</td>";
                    echo "</tr>";
                endforeach;
                echo "<tr style='font-weight:bold;'>";
                echo "<td colspan='4'  class='border-right'></td>";
                echo "<td class='text-right'>" . curr($masukBaru) . "</td>";
                echo "<td class='text-right border-right'>" . curr($keluarBaru) . "</td>";
                echo "<td></td>";
                echo "<td class='border-right'></td>";
                echo "<td class='text-right'>" . curr($masukBaru - $keluarBaru) . "</td>";
                echo "</tr>";


                echo "</tbody>";
                echo "</table>";

                echo "<br />";
                echo "<table style='border:1px solid black; width:60%; border-collapse: collapse; '>";
                echo "<thead>";
                echo "<tr style='border:1px solid black;'>";
                echo "<th colspan='3'>Maklumat Keseluruhan</th>";
                echo "<th colspan='3' style='border-left:1px solid black;'>Maklumat Mengikut Tarikh Pilihan</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tr>";
                echo "<td style=''>Jumlah Masuk Sehingga Tarikh Akhir</td>";
                echo "<td>:</td>";
                echo "<td class='tright'>" . curr($masukBaru) . "</td>";
                if ($caw == 37):
                    echo "<td style='border-left:1px solid black;'>Jumlah Masuk</td>";
                    echo "<td>:</td>";
                    echo "<td class='tright'>" . curr($nilaimasuk) . "</td>";
                else:
                    echo "<td style='border-left:1px solid black;'></td>";
                    echo "<td></td>";
                    echo "<td class='tright'></td>";
                endif;

                echo "<tr style='border-bottom:1px solid black;'>";
                echo "<td>Jumlah Keluar Sehingga Tarikh Akhir</td>";
                echo "<td>:</td>";
                echo "<td class='tright'>" . curr($keluarBaru) . "</td>";
                echo "<td style='border-left:1px solid black;'>Jumlah Keluar</td>";
                echo "<td>:</td>";
                echo "<td class='tright'>" . curr($nilaikeluar) . "</td>";
                echo "</tr>";
                echo "<tr style='border-bottom:1px solid black; font-weight:bold;'>";
                echo "<td>Baki</td>";
                echo "<td>:</td>";
                echo "<td class='tright'>" . curr($masukBaru - $keluarBaru) . "</td>";
                echo "<td style='border-left:1px solid black;'></td>";
                echo "<td></td>";
                echo "<td class='tright'></td>";
                echo "</tr>";
                echo "</table>";
                break;
        endswitch;
        ?>
        <br />
        <div id='cetakDiv'>
            <button onclick='cetak();'>Cetak Maklumat Ini</button>
        </div>
        <script>
                function cetak() {
                    document.getElemen
                    window.print();
                }
        </script>
    </body>

</html>
