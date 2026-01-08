<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-skripsi.php";

$title = "DATA Skripsi - E-KATALOG PERPUSTAKAAN";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
//jalankan fungsi hapus skripsi
if ($msg=='insert') {
    $user = userLogin()['username'];
    $gbrUser = userLogin()['foto'];    
    $alert = "<script>
                $(document).ready(function(){
                    $(document). Toasts('create',{
                        title   : '$user',
                        body    : 'Data skripsi berhasil ditambah..',
                        class   : 'bg-success',
                        image    : '../asset/image/$gbrUser',
                        position    : 'topRight',
                        autohide    : true,
                        delay   : 5000,
                    })
                });
            </script>";
}

if ($msg=='deleted') {
    $user = userLogin()['username'];
    $gbrUser = userLogin()['foto'];    
    $alert = "<script>
                $(document).ready(function(){
                    $(document). Toasts('create',{
                        title   : '$user',
                        body    : 'Data skripsi berhasil dihapus dari database..',
                        class   : 'bg-success',
                        image    : '../asset/image/$gbrUser',
                        position    : 'topRight',
                        autohide    : true,
                        delay   : 5000,
                    })
                });
            </script>";

}

if ($msg=='updated') {
    $user = userLogin()['username'];
    $gbrUser = userLogin()['foto'];    
    $alert = "<script>
                $(document).ready(function(){
                    $(document). Toasts('create',{
                        title   : '$user',
                        body    : 'Data skripsi berhasil diperbarui dari database..',
                        class   : 'bg-success',
                        image    : '../asset/image/$gbrUser',
                        position    : 'topRight',
                        autohide    : true,
                        delay   : 5000,
                    })
                });
            </script>";

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
            <li class="breadcrumb-item active"> Skripsi</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card"> 
            <?php if ($alert != '') {
                echo $alert;
            }?>
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Skripsi</h3>
               
               
            </div>

                    <div class="card-body table-responsive p-3">
                        <table id="skripsiTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                     <th>ID Skripsi</th>
                                    <th>Kode Katalog</th>
                                    <th>Judul Skripsi</th>
                                    <th>Penulis</th>
                                    <th>Tahun Cetak</th>
                                    <th>Jumlah Halaman</th>
                                    <th>Subyek</th>
                                    <th>Rak</th>
                                    <th style="width: 0%;" class="text-center">Operasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                $skripsis = getData("SELECT * FROM tbl_skripsi");
                                foreach ($skripsis as $skripsi)  { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                           <td><?= $skripsi['id_skripsi']?></td>
                                        <td><?= $skripsi['kode_katalog'] ?></td>
                                        <td><?= $skripsi['Judul_Skripsi']?></td>
                                        <td><?= $skripsi['Nama_Mahasiswa'] ?></td>
                                        <td><?= $skripsi['Tahun_Cetak'] ?></td>
                                        <td><?= $skripsi['Jumlah_Halaman']?></td>      
                                        <td><?= $skripsi['Subyek']?></td>
                                        <td><?= $skripsi['Lokasi_Skripsi'] ?></td>
                                        <td>
                                        <a href="view-skripsi.php?id=<?= $skripsi['id_skripsi'] ?>" class="btn btn-sm bg-info" title="Lihat"><i class="fa fa-eye"></i></a>
                                    </td>

</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>
</section>

<script>
$(document).ready(function() {
$('#skripsiTable').DataTable({
pageLength: 10 // Menampilkan 10 kolom per halaman
});
});
</script>

<?php

require "../template/footer.php";

?>



