<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-skripsi.php";

$title = "EDIT Skripsi - E-KATALOG PERPUSTAKAAN";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";


//jalankan fungsi update data
if (isset($_POST['simpan'])) {
  if (update($_POST)) {
    echo "<script>
          document.location.href = 'data-skripsi.php?msg=updated';
    </script>";
  }
}

$id_skripsi = isset($_GET['id_skripsi']) ? intval($_GET['id_skripsi']) : 0;

if ($id_skripsi <= 0) {
    die("ID tidak valid. Pastikan Anda mengakses halaman ini dengan benar.");
}

// Query untuk mengambil data berdasarkan ID
$sqlEdit = "SELECT * FROM tbl_skripsi WHERE id_skripsi = '$id_skripsi'";
$result = getData($sqlEdit);

// Periksa apakah data ditemukan
if (!empty($result)) {
    $skripsi = $result[0]; // Ambil data pertama
} else {
    die("Data dengan ID $id tidak ditemukan.");
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Skripsi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $main_url?>skripsi/data-skripsi.php">Skripsi</a></li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
<div class="container-fluid">
    <div class="card">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-header">
            <h3 class="card-title"><i class="fas fa-pen fa-sm"></i> Edit Skripsi</h3>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group">
                                     <label for="id skripsi">ID Skripsi</label>
                            <input type="text" name="id skripsi" class="form-control" id="id skripsi" placeholder="Masukkan kode katalog" autofocus value="<?= $skripsi['id_skripsi'] ?>" required>

                        </div>
                         <div class="form-group">
                <div class="form-group">
                    <label for="kode katalog">Kode Katalog</label>
                    <input type="text" name="kode katalog" class="form-control" id="kode katalog" placeholder="Masukkan kode katalog" autofocus value="<?= $skripsi['kode_katalog'] ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="barcode">Barcode</label>
                  <input type="text" name="barcode" class="form-control" id="barcode" placeholder="Masukkan kode barcode" value="<?= $skripsi['Barcode'] ?>"required>
                  </div>
                  <div class="form-group">
                    <label for="nama mahasiswa">Nama Mahasiswa</label>
                    <input type="text" name="nama mahasiswa" class="form-control" id="nama mahasiswa" placeholder="Masukkan nama mahasiswa" autofocus value="<?= $skripsi['Nama_Mahasiswa'] ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="nim mahasiswa">Nim Mahasiswa</label>
                    <input type="text" name="nim mahasiswa" class="form-control" id="nim mahasiswa" placeholder="Masukkan nim mahasiswa"  value="<?= $skripsi['Nim_Mahasiswa'] ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="judul skripsi">Judul Skripsi</label>
                    <input type="text" name="judul skripsi" class="form-control" id="judul skripsi" placeholder="Masukkan judul skripsi" autofocus value="<?= $skripsi['Judul_Skripsi'] ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="jumlah halaman">Jumlah Halaman</label>
                    <input type="text" name="jumlah halaman" class="form-control" id="jumlah halaman" placeholder="Masukkan judul skripsi" autofocus value="<?= $skripsi['Jumlah_Halaman'] ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="tahun cetak">Tahun Cetak</label>
                    <input type="text" name="tahun cetak" class="form-control" id="tahun cetak" placeholder="Masukkan judul skripsi" autofocus value="<?= $skripsi['Tahun_Cetak'] ?>" required>
                  
                  </div>  
                  <div class="form-group">
                    <label for="Subyek">Subyek</label>
                    <select name="subyek" id="subyek" class="form-control" required>
                   <option value="">-- Pilih Subyek Skripsi --</option>
                   <option value="Sistem Informasi Manajemen" <?php echo ($skripsi['Subyek'] == 'Sistem Informasi Manajemen') ? 'selected' : ''; ?>>Sistem Informasi Manajemen</option>
                   <option value="Efektivitas Kerja" <?php echo ($skripsi['Subyek'] == 'Efektivitas Kerja') ? 'selected' : ''; ?>>Efektivitas Kerja</option>
                   <option value="Kinerja" <?php echo ($skripsi['Subyek'] == 'Kinerja') ? 'selected' : ''; ?>>Kinerja</option>
                   <option value="Penempatan" <?php echo ($skripsi['Subyek'] == 'Penempatan') ? 'selected' : ''; ?>>Penempatan</option>
                   <option value="Pengelolaan Surat" <?php echo ($skripsi['Subyek'] == 'Pengelolaan Surat') ? 'selected' : ''; ?>>Pengelolaan Surat</option>
                   <option value="Semangat Kerja" <?php echo ($skripsi['Subyek'] == 'Semangat Kerja') ? 'selected' : ''; ?>>Semangat Kerja</option>
                 <option value="Tata Ruang Kantor" <?php echo ($skripsi['Subyek'] == 'Tata Ruang Kantor') ? 'selected' : ''; ?>>Tata Ruang Kantor</option>
                  <option value="Iklim Kerja" <?php echo ($skripsi['Subyek'] == 'Iklim Kerja') ? 'selected' : ''; ?>>Iklim Kerja</option>
                  <option value="Sarana dan Prasarana" <?php echo ($skripsi['Subyek'] == 'Sarana dan Prasarana') ? 'selected' : ''; ?>>Sarana dan Prasarana</option>
                  <option value="Produktivitas Kerja" <?php echo ($skripsi['Subyek'] == 'Produktivitas Kerja') ? 'selected' : ''; ?>>Produktivitas Kerja</option>
                   <option value="Pelayanan Publik" <?php echo ($skripsi['Subyek'] == 'Pelayanan Publik') ? 'selected' : ''; ?>>Pelayanan Publik</option>
                  <option value="Iklim Organisasi" <?php echo ($skripsi['Subyek'] == 'Iklim Organisasi') ? 'selected' : ''; ?>>Iklim Organisasi</option>
                 <option value="Administrasi Kepegawaian" <?php echo ($skripsi['Subyek'] == 'Administrasi Kepegawaian') ? 'selected' : ''; ?>>Administrasi Kepegawaian</option>
                 <option value="Lingkungan Kerja" <?php echo ($skripsi['Subyek'] == 'Lingkungan Kerja') ? 'selected' : ''; ?>>Lingkungan Kerja</option>
               <option value="Pelayanan" <?php echo ($skripsi['Subyek'] == 'Pelayanan') ? 'selected' : ''; ?>>Pelayanan</option>
                <option value="Komunikasi Interpersonal" <?php echo ($skripsi['Subyek'] == 'Komunikasi Interpersonal') ? 'selected' : ''; ?>>Komunikasi Interpersonal</option>
              <option value="Motivasi Kerja" <?php echo ($skripsi['Subyek'] == 'Motivasi Kerja') ? 'selected' : ''; ?>>Motivasi Kerja</option>
                  <option value="Kompetensi Kewirausahaan" <?php echo ($skripsi['Subyek'] == 'Kompetensi Kewirausahaan') ? 'selected' : ''; ?>>Kompetensi Kewirausahaan</option>
                  <option value="Pendidikan dan Pelatihan" <?php echo ($skripsi['Subyek'] == 'Pendidikan dan Pelatihan') ? 'selected' : ''; ?>>Pendidikan dan Pelatihan</option>
                   <option value="Kompetensi Tenaga Administrasi Sekolah" <?php echo ($skripsi['Subyek'] == 'Kompetensi Tenaga Administrasi Sekolah') ? 'selected' : ''; ?>>Kompetensi Tenaga Administrasi Sekolah</option>
                <option value="Kepemimpinan" <?php echo ($skripsi['Subyek'] == 'Kepemimpinan') ? 'selected' : ''; ?>>Kepemimpinan</option>
              <option value="Insentif" <?php echo ($skripsi['Subyek'] == 'Insentif') ? 'selected' : ''; ?>>Insentif</option>
               <option value="Supervisi" <?php echo ($skripsi['Subyek'] == 'Supervisi') ? 'selected' : ''; ?>>Supervisi</option>
                <option value="Prestasi Belajar" <?php echo ($skripsi['Subyek'] == 'Prestasi Belajar') ? 'selected' : ''; ?>>Prestasi Belajar</option>
                  <option value="Kepuasan Kerja" <?php echo ($skripsi['Subyek'] == 'Kepuasan Kerja') ? 'selected' : ''; ?>>Kepuasan Kerja</option>

                 </select>
                </div>
                <div class="form-group">
                    <label for="link dokumen">Link Dokumen</label>
                    <input type="text" name="link dokumen" class="form-control" id="link dokumen" placeholder="Masukkan link dokumen" autofocus value="<?= $skripsi['Link_dokumen'] ?>" required> 
                  </div>  
                <div class="form-group">
                  <label for="nama dosen pembimbing 1">Nama Dosen Pembimbing 1</label>
                  <input type="text" name="nama dosen pembimbing 1" class="form-control" id="nama dosen pembimbing 1" placeholder="Masukkan nama dosen pembimbing 1" autofocus value="<?= $skripsi['Nama_Dosen_Pembimbing_1'] ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen pembimbing 2">Nama Dosen Pembimbing 2</label>
                  <input type="text" name="nama dosen pembimbing 2" class="form-control" id="nama dosen pembimbing 2" placeholder="Masukkan nama dosen pembimbing 2" autofocus value="<?= $skripsi['Nama_Dosen_Pembimbing_2'] ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen penguji 1">Nama Dosen Penguji 1</label>
                  <input type="text" name="nama dosen penguji 1" class="form-control" id="nama dosen penguji 1" placeholder="Masukkan nama dosen penguji 1" autofocus value="<?= $skripsi['Nama_Dosen_Penguji_1'] ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen penguji 2">Nama Dosen Penguji 2</label>
                  <input type="text" name="nama dosen penguji 2" class="form-control" id="nama dosen penguji 2" placeholder="Masukkan nama dosen penguji 2"autofocus value="<?= $skripsi['Nama_Dosen_Penguji_2'] ?>"required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen penguji 3">Nama Dosen Penguji 3</label>
                  <input type="text" name="nama dosen penguji 3" class="form-control" id="nama dosen penguji 3" placeholder="Masukkan nama dosen penguji 3" autofocus value="<?= $skripsi['Nama_Dosen_Penguji_3'] ?>" required>
                  </div>
                 <div class="form-group">
                <label for="lokasi skripsi">Lokasi Skripsi</label>
               <input type="lokasi skripsi" name="lokasi skripsi" class="form-control" id="lokasi skripsi" placeholder="Masukkan lokasi skripsi" autofocus value="<?= $skripsi['Lokasi_Skripsi'] ?>" required>
</div>
               
                
</div>
                </div>
            </div>
        </form>
    </div>
</div>


</section>


<?php

require "../template/footer.php";

?>