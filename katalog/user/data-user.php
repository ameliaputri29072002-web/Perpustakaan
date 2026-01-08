<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";

$title = "Users - E-KATALOG PERPUSTAKAAN";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
} else {
  $msg = '';
}

$alert = '';
//jalankan fungsi hapus user
if ($msg=='insert') {
  $user = userLogin()['username'];
  $gbrUser = userLogin()['foto'];    
  $alert = "<script>
              $(document).ready(function(){
                  $(document). Toasts('create',{
                      title   : '$user',
                      body    : 'User baru berhasil diregistrasi..',
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
                      body    : 'Data user berhasil dihapus dari database..',
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
                      body    : 'Data user berhasil diperbarui dari database..',
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
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
            <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data User</h3>
            <div class="card-tools">
              <a href="<?= $main_url ?>user/add-user.php" class="btn btn-sm btn-primary"><i class="fas fa-plus fa-sm"></i> Add User</a>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
          <table id="skripsiTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Username</th>
                  <th>Fullname</th>
                  <th>Alamat</th>
                  <th>Level User</th>
                  <th style="width: 8%";>Operasi</th>
                </tr>
                </thead>
<tbody>
    <?php
    $no = 1;
    $users = getData("SELECT * FROM tbl_user");
    foreach ($users as $user) {
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><img src="../asset/image/<?= $user['foto'] ?>" class="rounded-circle" alt="" width="60px"></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['fullname'] ?></td>
            <td><?= $user['address'] ?></td>
            <td>
                <?php
                if ($user['level'] == 1) {
                    echo "Administrator";
                } else if ($user['level'] == 2) {
                    echo "Supervisor";
                } else if ($user['level'] == 3) {
                    echo "Operator";
                } else if ($user['level'] == 4) {
                    echo "Mahasiswa";
                }
                ?>
            </td>
            <td>
                <a href="edit-user.php?id=<?= $user['userid'] ?>" class="btn btn-sm btn-warning" title="edit user">
                    <i class="fas fa-user-edit"></i>
                </a>
                <a href="del-user.php?id=<?= $user['userid'] ?>&foto=<?= $user['foto'] ?>" class="btn btn-sm btn-danger" title="Hapus User" onclick="return confirm('Anda yakin akan menghapus user ini?')">
                    <i class="fas fa-user-times"></i>
                </a>
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
        $('#skripsiTable').DataTable();
    });
</script>

<?php
require "../template/footer.php";
?>
