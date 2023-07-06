<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pinjaman Anggota Koperasi</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card-header {
            font-size: 18px;
        }

        .card-header a {
            margin-top: -5px;
        }

        th, td {
            vertical-align: middle !important;
        }

        th {
            font-size: 14px;
            font-weight: 500;
            background-color: #f8f9fa;
            border-top: none !important;
        }

        td {
            font-size: 14px;
        }

        tfoot td {
            font-weight: 600;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        th[colspan="2"] {
             text-align: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-100">
                <h1 class="text-center">Daftar Pembayaran Rekning Listrik</h1>
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Bulan: Jan - 2023
                        <a href="tambah.php" class="btn btn-sm btn-primary float-right">Tambah Data</a>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">No.REKENING</th>
                                <th rowspan="2">Nama Pelanggan</th>
                                <th rowspan="2">Daya</th>
                                <th colspan="2">Meter</th>
                                <th rowspan="2">Tanggal Bayar </th>
                                <th rowspan="2">Tarif/kwh</th>
                                <th rowspan="2">jumlah pakai</th>
                                <th rowspan="2">Denda</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>Bulan lalu</th>
                                <th>Bulan Ini</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                include "koneksi.php";
                                $datas = mysqli_query($koneksi, "SELECT * FROM listrik") or die(mysqli_error($koneksi));
                                $no = 1;

                                while ($row = mysqli_fetch_assoc($datas)) { 
                                    ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $row['no_rek']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['daya']; ?></td>
                                        <td><?= $row['bulan_lalu']; ?></td>
                                        <td><?= $row['bulan_ini']; ?></td>
                                        <td><?= $row['tgl_bayar']; ?></td>
                                        <td>
                                            <?php
                                            $jp = $row['bulan_ini'] - $row['bulan_lalu'];
                                            $daya = intval($row['daya']);
                                            $tarif = 0;
                                            if ($daya <= 900) {
                                                $tarif = 1550;
                                            } elseif ($daya > 900 && $daya <= 1300) {
                                                $tarif = 1450;
                                            } elseif ($daya > 1300 && $daya <= 2200) {
                                                $tarif = 1850;
                                            } elseif ($daya > 2200) {
                                                $tarif = 2250;
                                            }
                                            echo $tarif
                                            ?>
                                        </td>
                                        <td><?= $jp; ?></td>
                                        <td>
                                            <?php
                                            $dt= $row['tgl_bayar'];
                                            $date_obj = new DateTime($dt);
                                            $d = $date_obj ->format("d");
                                            if  (intval($d)>20) {
                                                echo ($tarif*$jp) * 0.02;
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin hapus?');">Hapus</a>
                                        </td>
                                    </tr>
                                    
                                    <?php $no++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>

