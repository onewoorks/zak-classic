<h2>Transaksi Aliran Dalam Bank</h2>
<form id="registerAliranBank" action="javascript:registerAliranBank();">
    <table>
        <tr>
            <td class="no4">Perkara</td>
            <td></td>
            <td> <input type="text" id="atb_perkara" required /></td>
        </tr>

        <tr>
            <td>Jumlah</td>
            <td></td>
            <td><input type="text" id="atb_jumlah" required /></td>
        </tr>

        <tr>
            <td>Perkara</td>
            <td></td>
            <td>
                <select id='atb_kategori' >
                    <option value='0'>Pilih jenis transaksi...</option>
                    <option value='1' >Masuk</option>
                    <option value='2'>Keluar</option>
                </select>
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><button type="submit">Lakukan Transaksi</button></td>
        </tr>
    </table>

</form>