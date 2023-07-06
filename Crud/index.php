<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pembayaran Rekening Listrik</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Pembayaran Rekening Listrik</h2>
        <a href="tambah_data.php" class="btn btn-primary mb-3">Tambah Data</a>
        <table class="table">
            <thead>
                <tr>
                    <th>NO REK</th>
                    <th>NAMA PELANGGAN</th>
                    <th>DAYA (VA)</th>
                    <th>METER Bulan Lalu</th>
                    <th>METER Bulan Ini</th>
                    <th>TGL BAYAR</th>
                    <th>TOTAL</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Listrik";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['no_rek']."</td>";
                        echo "<td>".$row['nama_pelanggan']."</td>";
                        echo "<td>".$row['daya']."</td>";
                        echo "<td>".$row['meter_bulan_lalu']."</td>";
                        echo "<td>".$row['meter_bulan_ini']."</td>";
                        echo "<td>".$row['tanggal_bayar']."</td>";
                        echo "<td>".$row['total']."</td>";
                        echo "<td><a href='edit.php?id=".$row['id']."' class='btn btn-primary'>Edit</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
