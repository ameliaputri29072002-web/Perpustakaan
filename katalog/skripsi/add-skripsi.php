
<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-skripsi.php";

$title = "Form Skripsi - E-KATALOG PERPUSTAKAAN";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])){
    $msg    = $_GET['msg'];
    $id     = $_GET['id'];
    $sqlEdit= "SELECT * FROM tbl_skripsi WHERE id_skripsi = '$id'";
    $skripsi = getData($sqlEdit)[0];
} else {
    $msg    = "";
}


if (isset($_POST['simpan'])) {
  if (update($_POST)) {
    echo "<script>
          document.location.href = 'data-skripsi.php?msg=updated';
    </script>";
  }
}


if (isset($_POST['simpan'])) {
  if (insert($_POST) > 0) {
    echo"<script>
              document.location.href = 'data-skripsi.php?msg=insert';
    </script>";
  }
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
            <li class="breadcrumb-item active"><?=$msg != '' ? 'Edit Skripsi' : 'Add Skripsi' ?></li>
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
             <h3 class="card-title"><i class="fas fa-pen fa-sm"></i> <?=$msg != '' ? 'Edit Skripsi' : 'Input Skripsi' ?></h3>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 mb-3 pr-3">
                        <div class="form-group">
                         <label for="id skripsi">ID Skripsi</label>
                            <input type="text" name=" id skripsi" class="form-control" id="id skripsi" value="<?=$msg != '' ? $skripsi['id_skripsi'] : generateId() ?>" readonly>

                        </div>
                         <div class="form-group">
                    <label for="kode katalog">Kode Katalog</label>
                    <input type="text" name="kode katalog" class="form-control" id="kode katalog" placeholder="Masukkan kode katalog skripsi" value="<?=$msg != '' ? $skripsi['kode_katalog'] : null ?>" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                  <label for="barcode">Barcode</label>
                  <input type="text" name="barcode" class="form-control" id="barcode" placeholder="Masukkan kode barcode"  value="<?=$msg != '' ? $skripsi['Barcode'] : null ?>" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                  <label for="nama mahasiswa">Nama Mahasiswa</label>
                  <input type="text" name="nama mahasiswa" class="form-control" id="nama mahasiswa" placeholder="Masukkan nama mahasiswa"  value="<?=$msg != '' ? $skripsi['Nama_Mahasiswa'] : null ?>" autocomplete="off" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                  <label for="nim mahasiswa">Nim Mahasiswa</label>
                  <input type="text" name="nim mahasiswa" class="form-control" id="nim mahasiswa" placeholder="Masukkan nim mahasiswa"  value="<?=$msg != '' ? $skripsi['Nim_Mahasiswa'] : null ?>" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                  <label for="judul skripsi">Judul Skripsi</label>
                  <input type="text" name="judul skripsi" class="form-control" id="judul skripsi" placeholder="Masukkan judul skripsi" value="<?=$msg != '' ? $skripsi["Judul_Skripsi"] : null ?>"required>
                  </div>
                  <div class="form-group">
                  <label for="jumlah halaman">Jumlah Halaman</label>
                  <input type="text" name="jumlah halaman" class="form-control" id="jumlah halaman" placeholder="Masukkan jumlah halaman skripsi" value="<?=$msg != '' ? $skripsi['Jumlah_Halaman'] : null ?>" required>
                  </div>
                  
                  <div class="form-group">
                  <label for="tahun cetak">Tahun Cetak</label>
                  <input type="text" name="tahun cetak" class="form-control" id="tahun cetak" placeholder="Masukkan tahun cetak skripsi" value="<?=$msg != '' ? $skripsi['Tahun_Cetak'] : null ?>"required>
                  
                  </div>  
                  <div class="form-group">
                            <label for="subyek">Subyek</label>
                            <select name="subyek" id=" subyek" class="form-control" required>
                                <?php
                                if ($msg !="") {
                                    $subyek = ["Efektivitas", "Manajemen Berbasis Sekolah","Manajemen Layanan Khusus","Iklim Organisasi","Sarana dan Prasarana","Manajemen Peserta Didik","Supervisi",
                                   "Kurikulum","Komitmen","Kewirausahaan","Budaya Organisasi","Moral Kerja","Insentif","Sistem Informasi Manajemen","Konflik","Motivasi","Pengawasan","Pedagogi","Pengelolaan Arsip",
                                   "Manajemen Mutu","Pengambilan Keputusan","Kompetensi","Kepuasan Kerja","Penempatan Pegawai","Tata Ruang Kantor","Pelayanan","Disiplin Kerja","Kepemimpinan","Kinerja","Komunikasi"];
                                    foreach ($subyek as $sbyk){
                                        if ($subyek['subyek'] == $sbyk) { ?>
                                            <option value="<?=$sbyk?>" selected><?= $sbyk?></option>
                                        <?php } else { ?>   
                                            <option value="<?=$sbyk?>"><?= $sbyk?></option>  
                                        <?php
                                        }
                                    }
                                } else { ?>

                      <option value="">-- Pilih Subyek Skripsi --</option>
                      <option value="Efektivitas">Efektivitas</option>
                      <option value="Manajemen Berbasis Sekolah">Manajemen Berbasis Sekolah</option>
                      <option value="Manajemen Layanan Khusus">Manajemen Layanan Khusus</option>
                      <option value="Iklim Organisasi">Iklim Organisasi</option>
                      <option value="Kerjasama">Pengelolaan Surat</option>
                      <option value="Lingkungan Kerja">Lingkungan Kerja</option>
                      <option value="Husemas">Husemas</option>
                      <option value="Manajemen Rapat">Manajemen Rapat</option>
                      <option value=" Iklim Sekolah">Iklim Sekolah</option>
                      <option value="Sarana dan Prasarana">Sarana dan Prasarana</option>
                      <option value="Manajemen Peserta Didik">Manajemen Peserta Didik</option>
                      <option value="Supervisi">Supervisi</option>
                      <option value="Kurikulum">Kurikulum</option>
                      <option value="Komitmen">Komitmen</option>
                      <option value="Kewirausahaan">Kewirausahaan</option>
                      <option value="Budaya Organisasi">Budaya Organisasi</option>
                      <option value="Moral Kerja">MoralKerja</option>
                      <option value="Insentif">Insentif</option>
                      <option value="Sistem Informasi Manajemen">Sistem Informasi Manajemen</option>
                      <option value="Konflik">Konflik</option>
                      <option value="Motivasi">Motivasi</option>
                      <option value="Pengawasan">Pengawasan</option>
                      <option value="Pedagogi">Pedagogi</option>
                      <option value="Pengelolaan Arsip">Pengelolaan Arsip</option>
                      <option value="Manajemen Mutu">Manajemen Mutu</option>
                      <option value="Pengambilan Keputusan">Pengambilan Keputusan</option>
                      <option value="Kompetensi">Kompetensi</option>
                      <option value="Kepuasan Kerja">kepuasan kerja</option>
                      <option value="Penempatan Pegawai">Penempatan Pegawai</option>
                      <option value="Tata Ruang Kantor">Tata Ruang Kantor</option>
                      <option value="Pelayanan">Pelayanan</option>
                      <option value="Disiplin Kerja">Disiplin kerja</option>
                      <option value="Kepemimpinan">kepemimpinan</option>
                      <option value="Kinerja">kinerja</option>
                      <option value="Komunikasi">komunikasi</option>
                     <?php
                                }
                                ?>
                                
                            </select>
                </div>
                <div class="form-group">
                  <label for="link dokumen">link dokumen</label>
                  <input type="text" name="link dokumen" class="form-control" id="link dokumen" placeholder="Masukkan link dokumen" value="<?=$msg != '' ? $skripsi['Link_dokumen'] : null ?>" required>
                  </div>
                <div class="form-group">
                  <label for="nama dosen pembimbing 1">Nama Dosen Pembimbing 1</label>
                  <input type="text" name="nama dosen pembimbing 1" class="form-control" id="nama dosen pembimbing 1" placeholder="Masukkan nama dosen pembimbing 1" value="<?=$msg != '' ? $skripsi['Nama_Dosen_Pembimbing_1'] : null ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen pembimbing 2">Nama Dosen Pembimbing 2</label>
                  <input type="text" name="nama dosen pembimbing 2" class="form-control" id="nama dosen pembimbing 2" placeholder="Masukkan nama dosen pembimbing 2" value="<?=$msg != '' ? $skripsi['Nama_Dosen_Pembimbing_2'] : null ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen penguji 1">Nama Dosen Penguji 1</label>
                  <input type="text" name="nama dosen penguji 1" class="form-control" id="nama dosen penguji 1" placeholder="Masukkan nama dosen penguji 1" value="<?=$msg != '' ? $skripsi['Nama_Dosen_Penguji_1'] : null ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen penguji 2">Nama Dosen Penguji 2</label>
                  <input type="text" name="nama dosen penguji 2" class="form-control" id="nama dosen penguji 2" placeholder="Masukkan nama dosen penguji 2" value="<?=$msg != '' ? $skripsi['Nama_Dosen_Penguji_2'] : null ?>" required>
                  </div>
                  <div class="form-group">
                  <label for="nama dosen penguji 3">Nama Dosen Penguji 3</label>
                  <input type="text" name="nama dosen penguji 3" class="form-control" id="nama dosen penguji 3" placeholder="Masukkan nama dosen penguji 3" value="<?=$msg != '' ? $skripsi['Nama_Dosen_Penguji_3'] : null ?>" required>
                  </div>
                  <div class="form-group">
                            <label for="lokasi skripsi">Lokasi </label>
                            <select name="lokasi skripsi" id="lokasi skripsi" class="form-control" required>
                                <?php
                                if ($msg !="") {
                                    $lokasi_skripsi = ["Rak 1","Rak 2", "Rak 3"];
                                    foreach ($lokasi_skripsi as $lok){
                                        if ($lokasi['lokasi'] == $lok) { ?>
                                            <option value="<?=$lok?>" selected><?= $lok?></option>
                                        <?php } else { ?>   
                                            <option value="<?=$lok?>"><?= $lok?></option>  
                                        <?php
                                        }
                                    }
                                } else { ?>
                      <option value="">-- Pilih Lokasi Skripsi --</option>
                      <option value=" rak 1">rak 1</option>
                      <option value=" rak 2">rak 2</option>
                      <option value=" rak 3">rak 3</option>
                      <?php
                                }
                                ?>
                                
                            </select>
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

