<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_rek = $_POST['no_rek'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $daya = $_POST['daya'];
    $meter_bulan_lalu = $_POST['meter_bulan_lalu'];
    $meter_bulan_ini = $_POST['meter_bulan_ini'];
    $tanggal_bayar = $_POST['tanggal_bayar'];

    // Tarif/kWh sesuai dengan jenis pelanggan
    if ($daya == 900) {
        $tarif = 1150;
    } elseif ($daya == 1300) {
        $tarif = 1450;
    } elseif ($daya == 2200) {
        $tarif = 1850;
    } elseif ($daya > 2200) {
        $tarif = 2250;
    }

    // Jumlah Pemakaian (JML PAKAI)
    $jml_pakai = $meter_bulan_ini - $meter_bulan_lalu;

    // Mengecek apakah tanggal bayar di atas tanggal 20
    $tgl_bayar = date_create($tanggal_bayar);
    $tgl_batas = date_create('20');
    $tgl_batas->modify('+1 month'); // Mengubah batas tanggal menjadi bulan depan
    $is_denda = date_diff($tgl_bayar, $tgl_batas)->invert == 1;

    // Menghitung denda
    $denda = $is_denda ? 0.02 * $tarif * $jml_pakai : 0;

    // Total pembayaran
    $total = ($tarif * $jml_pakai) + $denda;

    $sql = "INSERT INTO Listrik (no_rek, nama_pelanggan, daya, meter_bulan_lalu, meter_bulan_ini, tanggal_bayar, tarif, jml_pakai, denda, total) VALUES ('$no_rek', '$nama_pelanggan', $daya, $meter_bulan_lalu, $meter_bulan_ini, '$tanggal_bayar', $tarif, $jml_pakai, $denda, $total)";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Pembayaran Rekening Listrik</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Data Pembayaran Rekening Listrik</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="no_rek">NO REK</label>
                <input type="text" class="form-control" id="no_rek" name="no_rek" required>
            </div>
            <div class="form-group">
                <label for="nama_pelanggan">NAMA PELANGGAN</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="form-group">
                <label for="daya">DAYA (VA)</label>
                <input type="number" class="form-control" id="daya" name="daya" required>
            </div>
            <div class="form-group">
                <label for="meter_bulan_lalu">METER Bulan Lalu</label>
                <input type="number" class="form-control" id="meter_bulan_lalu" name="meter_bulan_lalu" required>
            </div>
            <div class="form-group">
                <label for="meter_bulan_ini">METER Bulan Ini</label>
                <input type="number" class="form-control" id="meter_bulan_ini" name="meter_bulan_ini" required>
            </div>
            <div class="form-group">
                <label for="tanggal_bayar">TGL BAYAR</label>
                <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
