<?php
$i = 0;
$masukBank = 0;
$keluarBank = 0;
?>
<table style="width: 100%; border:1px solid #ccc; border-collapse: collapse;" cellspacing="0" >
    <thead>
        <tr style="border-bottom: 3px double #ccc;">
            <th>No</th>
            <th>Tarikh</th>
            <th>Perkara</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $r): $i++; ?>
        <tr style="border-top:1px dotted #ccc;">
                <td class="no1"><?php echo $i; ?></td>
                <td class="no2"><?php echo $r['timestamp']; ?></td>
                <td><?php echo $r['perkara']; ?></td>
                <td class="no4 tright"><?php echo ($r['kategori'] == 1) ? number_format($r['jumlah'], 2, '.', ',') : ''; ?> </td>
                        <td class="no4 tright"><?php echo ($r['kategori'] == 2) ? number_format($r['jumlah'], 2, '.', ',') : ''; ?> </td>
                                <td class="bbleft no8 cen">
                                            <span class='link' onclick='buangTransaksiBank(<?php echo $r['id']; ?>);'>[Buang]</span>
                                    </td>
                <?php
                if ($r['kategori'] == 1):
                    $masukBank += $r['jumlah'];
                else:
                    $keluarBank += $r['jumlah'];
                endif;
                ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr style="border-top:3px double #ccc">
            <td></td>
            <td></td>
            <td></td>
            <td class="tright"><b><?php echo number_format($masukBank, 2, '.', ','); ?></b></td>
            <td class="tright"><b><?php echo number_format($keluarBank, 2, '.', ','); ?></b></td>
            <td></td>
        </tr>
    </tfoot>
</table>

<br />
<b>Duit Dalam Bank = <?php echo curr($masukBank - $keluarBank); ?></b>