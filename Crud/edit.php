<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
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

    $sql = "UPDATE Listrik SET no_rek='$no_rek', nama_pelanggan='$nama_pelanggan', daya=$daya, meter_bulan_lalu=$meter_bulan_lalu, meter_bulan_ini=$meter_bulan_ini, tanggal_bayar='$tanggal_bayar', tarif=$tarif, jml_pakai=$jml_pakai, denda=$denda, total=$total WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Listrik WHERE id=$id";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $no_rek = $row['no_rek'];
        $nama_pelanggan = $row['nama_pelanggan'];
        $daya = $row['daya'];
        $meter_bulan_lalu = $row['meter_bulan_lalu'];
        $meter_bulan_ini = $row['meter_bulan_ini'];
        $tanggal_bayar = $row['tanggal_bayar'];
    } else {
        echo "Data not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pembayaran Rekening Listrik</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Pembayaran Rekening Listrik</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="no_rek">NO REK</label>
                <input type="text" class="form-control" id="no_rek" name="no_rek" value="<?php echo $no_rek; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_pelanggan">NAMA PELANGGAN</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>" required>
            </div>
            <div class="form-group">
                <label for="daya">DAYA (VA)</label>
                <input type="number" class="form-control" id="daya" name="daya" value="<?php echo $daya; ?>" required>
            </div>
            <div class="form-group">
                <label for="meter_bulan_lalu">METER Bulan Lalu</label>
                <input type="number" class="form-control" id="meter_bulan_lalu" name="meter_bulan_lalu" value="<?php echo $meter_bulan_lalu; ?>" required>
            </div>
            <div class="form-group">
                <label for="meter_bulan_ini">METER Bulan Ini</label>
                <input type="number" class="form-control" id="meter_bulan_ini" name="meter_bulan_ini" value="<?php echo $meter_bulan_ini; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_bayar">TGL BAYAR</label>
                <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" value="<?php echo $tanggal_bayar; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
