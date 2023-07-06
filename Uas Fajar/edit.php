<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
        .form-group.radio-group {
            display: flex;
            align-items: center;
        }
        .form-group.radio-group label {
            margin-right: 50px;
        }
        .form-group.radio-group .radio-values {
            display: flex;
            justify-content: center;
        }
        .form-group.radio-group .radio-values label {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container col-md-6 mt-4">
        <h1>Edit Data</h1>
        <div class="card">
        <?php
                include "koneksi.php";

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT * FROM listrik WHERE id='$id'") or die(mysqli_error($koneksi));
                    $row = mysqli_fetch_assoc($data);
                }
                
                if (isset($_POST['submit'])) {
                    $norek = $_POST['no_rek'];
            
                    $nama = $_POST['nama'];
                    $daya = $_POST['daya'];
                    $bulanlalu= $_POST['bulan_lalu'];
                    $bulanini = $_POST['bulan_ini'];
                    $tglbayar=$_POST['tgl_bayar'];

                    mysqli_query($koneksi, "UPDATE listrik SET no_rek='$norek', nama='$nama', daya='$daya', bulan_lalu='$bulanlalu', bulan_ini='$bulanini' ,tgl_bayar='$tglbayar' WHERE id='$id'");
                    echo "<script>alert('Data Berhasil disimpan.'); window.location='index.php';</script>";
                    
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="no_rek">No.rekening</label>
                                <input type="text" class="form-control" id="no_rek" name="no_rek" value="<?= $row['no_rek']; ?>" required>
                            </div>
                           
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="daya">daya</label>
                                <input type="number" class="form-control" id="daya" name="daya" value="<?= $row['daya']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bulan_lalu">bulan_lalu</label>
                                <input type="number" class="form-control" id="bulan_lalu" name="bulan_lalu" value="<?= $row['bulan_lalu']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bulan_ini">Bulan ini</label>
                                <input type="number" class="form-control" id="bulan_ini" name="bulan_ini" value="<?= $row['bulan_ini']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_bayar">tanggal bayar</label>
                                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= $row['tgl_bayar']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                            <a href="index.php" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>


