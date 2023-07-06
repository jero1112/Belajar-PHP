<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
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
        <h1>Tambah Data</h1>
        <div class="card">
        <?php
                include "koneksi.php";
                // count number
                $num = mysqli_query($koneksi, "SELECT COUNT(*) AS id FROM listrik;");
                $row = mysqli_fetch_assoc($num);
                $total = intval($row['id']);
                $id = $total + 1;
                ?>
            <div class="card-header bg-success text-white">Tambah Data</div>
            <div class="card-body">
                <form action="" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="no_rek">No.rekening</label>
                        <input type="text" class="form-control" id="no_rek"  name="no_rek" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="daya">daya</label>
                        <input type="number" class="form-control" id="daya" name="daya" required>
                    </div>
                    <div class="form-group">
                        <label for="bulan_lalu">bulan lalu</label>
                        <input type="number" class="form-control" id="bulan_lalu" name="bulan_lalu" required>
                    </div>
                    <div class="form-group">
                        <label for="bulan_ini">Bulan ini</label>
                        <input type="number" class="form-control" id="bulan_ini" name="bulan_ini" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_bayar">tanggal bayar</label>
                        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
                <?php
                include "koneksi.php";
                

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    $norek = $_POST['no_rek'];
                    $nama = $_POST['nama'];
                    $daya = $_POST['daya'];
                    $bulanlalu = $_POST['bulan_lalu'];
                    $bulanini = $_POST['bulan_ini'];
                    $tglbayar = $_POST['tgl_bayar'];

                    // Lakukan validasi atau manipulasi data sesuai kebutuhan

                    mysqli_query($koneksi,"INSERT into listrik(no_rek,nama,daya,bulan_lalu,bulan_ini,tgl_bayar) values ('$norek', '$nama', '$daya', '$bulanlalu', '$bulanini', '$tglbayar')") or die (mysqli_error($koneksi));
                    echo "<script>alert('Data Berhasil disimpan.'); window.location='index.php';</script>";
                }
            ?>
            </div>
        </div>
    </div>
</body>
<script>
    window.addEventListener('DOMContentLoaded', function() {
    var tanggalInput = document.querySelector('input[type="date"]');
    
    // Mendapatkan tanggal hari ini
    var today = new Date();
    
    // Format tanggal dengan YYYY-MM-DD
    var year = today.getFullYear();
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    var day = ('0' + today.getDate()).slice(-2);
    
    var formattedDate = year + '-' + month + '-' + day;
    
    // Mengatur nilai default pada input tanggal
    tanggalInput.value = formattedDate;
});

</script>
</html>




