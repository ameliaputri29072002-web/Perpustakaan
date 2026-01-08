<?php
session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-skripsi.php";

// Validasi apakah ada parameter ID di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSkripsi = "SELECT * FROM tbl_skripsi WHERE id_skripsi = '$id'";
    $skripsi = getData($sqlSkripsi);

    // Cek apakah data ditemukan
    if (!empty($skripsi)) {
        $skripsi = $skripsi[0];
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='data-skripsi.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Parameter ID tidak valid!'); window.location.href='data-skripsi.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Skripsi</title>
    <!-- Import CSS AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        /* Custom CSS untuk tabel biru muda */
        .table-custom {
            background-color: #e6f7ff; /* Warna biru muda */
        }
        .table-custom th, .table-custom td {
            vertical-align: middle;
            text-align: center;
        }
        .form-control {
            margin-bottom: 10px; /* Spasi antar form control */
        }

        /* Custom CSS for making text bold and black */
        .bold-black-text {
            color: black; /* Set text color to black */
            font-weight: bold; /* Make text bold */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold" style="font-size: 1.5rem;">Informasi Detail Skripsi</h3>
                <button type="button" class="close" onclick="window.location.href='info-skripsi.php';" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form>
                    <!-- Tabel untuk menampilkan data kurikulum -->
                    <table class="table table-bordered table-custom">
                        <tr>
                            <th style="width: 30%;">ID Skripsi</th>
                              <td>
                        <input type="text" class="form-control bold-black-text" value="<?= $skripsi['id_skripsi'] ?>" readonly></td>
                        </tr>
                             <tr></tr>
                             <th>Kode Katalog</th>
                        <td><input type="text" class="form-control bold-black-text" value="<?= $skripsi['kode_katalog'] ?>" readonly></td>
                        </tr>
                        <tr>    
                        <th>Barcode</th>
                            <td><input type="text" name="barcode" class="form-control bold-black-text" value="<?= $skripsi['Barcode'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <td><input type="text" name="nama_mahasiswa" class="form-control bold-black-text" value="<?= $skripsi['Nama_Mahasiswa'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>NIM Mahasiswa</th>
                            <td><input type="text" name="nim_mahasiswa" class="form-control bold-black-text" value="<?= $skripsi['Nim_Mahasiswa'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Judul Skripsi</th>
                            <!-- Apply custom class to make text black and bold -->
                            <td>
    <textarea name="judul_skripsi" class="form-control bold-black-text" readonly><?= $skripsi['Judul_Skripsi'] ?></textarea>
</td>

                        </tr>
                        <tr>
                            <th>Jumlah Halaman</th>
                            <td><input type="text" name="jumlah_halaman" class="form-control bold-black-text" value="<?= $skripsi['Jumlah_Halaman'] ?>" readonly></td>
                        </tr>
                        <tr>
                            
                            <th>Tahun Cetak</th>
                            <td><input type="text" name="tahun_cetak" class="form-control bold-black-text" value="<?= $skripsi['Tahun_Cetak'] ?>" readonly></td>
                        </tr>
                        <tr>
                        <th>Subyek</th>
                            <td><input type="text" name="subyek" class="form-control bold-black-text" value="<?= $skripsi['Subyek'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Link Dokumen Skripsi</th>
                            <td><input type="text" name="link_dokumen" class="form-control bold-black-text" value="<?= $skripsi['Link_dokumen'] ?>" readonly></td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <th>Nama Dosen Pembimbing 1</th>
                            <td><input type="text" name="nama_dosen_pembimbing_1" class="form-control bold-black-text" value="<?= $skripsi['Nama_Dosen_Pembimbing_1'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Nama Dosen Pembimbing 2</th>
                            <td><input type="text" name="nama_dosen_pembimbing_2" class="form-control bold-black-text" value="<?= $skripsi['Nama_Dosen_Pembimbing_2'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Nama Dosen Penguji 1</th>
                            <td><input type="text" name="nama_dosen_penguji_1" class="form-control bold-black-text" value="<?= $skripsi['Nama_Dosen_Penguji_1'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Nama Dosen Penguji 2</th>
                            <td><input type="text" name="nama_dosen_penguji_2" class="form-control bold-black-text" value="<?= $skripsi['Nama_Dosen_Penguji_2'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Nama Dosen Penguji 3</th>
                            <td><input type="text" name="nama_dosen_penguji_3" class="form-control bold-black-text" value="<?= $skripsi['Nama_Dosen_Penguji_3'] ?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Rak Skripsi</th>
                            <td><input type="text" name="Rak" class="form-control bold-black-text" value="<?= $skripsi['Lokasi_Skripsi'] ?>" readonly></td>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" onclick="window.location.href='info-skripsi.php';">Kembali</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
