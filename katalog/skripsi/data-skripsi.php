
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
                <a href="<?= $main_url?>skripsi/add-skripsi.php" class="mr-2 btn btn-sm btn-primary float-right"><i class="fas fa-plus fa-sm"></i> Add Skripsi</a>
               
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
                                    <th style="width: 12%;" class="text-center">Operasi</th>
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
                                        <button type="button" class="btn btn-sm btn-secondary" id="btnCetakBarcode" data-barcode="<?= $skripsi['Barcode']?>" data-nama="<?= $skripsi['Nama_Mahasiswa']?>" title="cetak barcode" ><i class="fas fa-barcode"></i></button>
                                         <a href="add-skripsi.php?id=<?= $skripsi['id_skripsi']?>&msg=editing" class="btn btn-warning btn-sm" title="edit sarana" ><i class= "fas fa-pen"></i></a>
                                    <a href="del-skripsi.php?id=<?= $skripsi['id_skripsi']?>"class="btn btn-danger btn-sm" title="hapus skripsi" onclick="return confirm ('Anda yakin akan menghapus skripsi ini ?')"><i class= "fas fa-trash"></i></a>
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

<div class="modal fade" id="mdlCetakBarcode" tabindex="-1" role="dialog" aria-labelledby="mdlCetakBarcodeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlCetakBarcodeLabel">Cetak Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nmMahasiswa">Nama Mahasiswa</label>
                    <input type="text" id="nmMahasiswa" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="barcode">Barcode</label>
                    <input type="text" id="barcode" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="jmlCetak">Jumlah Cetak</label>
                    <input type="number" id="jmlCetak" class="form-control" min="1" max="10" value="1" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="preview"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#skripsiTable').DataTable();

    // Show the modal when clicking "Cetak Barcode"
    $(document).on("click", "#btnCetakBarcode", function() {
        $('#mdlCetakBarcode').modal('show'); 
        let nama = $(this).data('nama');
        let barcode = $(this).data('barcode');
        
        $('#nmMahasiswa').val(nama);
        $('#barcode').val(barcode);

        // Optionally generate barcode preview (requires JsBarcode library)
        JsBarcode("#barcodeContainer", barcode, {
            format: "CODE128",
            lineColor: "#0a0",
            width: 2,
            height: 100,
            displayValue: true
        });
    });

    $('#preview').click(function() {
        let barcode = $('#barcode').val();
        let jmlCetak = $('#jmlCetak').val();

        // Validate jumlah cetak
        if (!barcode || jmlCetak <= 0 || jmlCetak > 10) {
            alert("Masukkan jumlah cetak yang valid (1-10).");
            return;
        }

        // Redirect to r-barcode.php with the barcode and print count
        window.location.href = "r-barcode.php?barcode=" + encodeURIComponent(barcode) + "&jmlCetak=" + jmlCetak;
    });
});
</script>

<?php
require "../template/footer.php";
?>



