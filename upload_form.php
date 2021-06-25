<?php

echo '<h3 align="center">Buat Laporan</h3><ul>';
?>
<form id="form-report">
    <pre>
    <label for="fr-foto">Foto Orang Hilang </label>
    <input type="file" id="fr-foto" name="foto" placeholder="Masukan Foto" required><br>
    <label for="fr-name">Nama Orang Hilang </label>
    <input type="text" id="fr-name" class="itext" name="nama" placeholder="Masukan Nama"><br>
    <label for="fr-umur">Umur Orang Hilang </label>
    <input type="number" id="fr-umur" class="itext" name="umur" placeholder="Masukan Umur"><br>
    <label for="fr-date">Tanggal Mulai Hilang  </label>
    <input  type="date" id="fr-date" class="itext" name="tgl_hilang" placeholder="Masukan Tanggal Hilang"><br>
    <label for="fr-ket">Keterangan Orang Hilang</label>
    <textarea name="ket" id="fr-ket" class="itext" cols="30" rows="10"></textarea><br>
    <input onclick="create_report()" type="button" value=" Kirim ">
    </pre>
</form>