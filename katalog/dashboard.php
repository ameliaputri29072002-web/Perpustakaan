<?php
session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: auth/login.php");
    exit();
}

require "config/config.php";
require "config/functions.php";

$title = "E-KATALOG PERPUSTAKAAN";
require "template/header.php";
require "template/navbar.php";
require "template/sidebar.php";

// Query to get the count of users
$userCount = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tbl_user");
$user = mysqli_fetch_assoc($userCount);
$totalUser = $user['total'];

// Query to get the count of skripsi
$skripsiCount = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tbl_skripsi");
$skripsi = mysqli_fetch_assoc($skripsiCount);
$totalSkripsi = $skripsi['total'];

// Ambil level user
$level = userLogin()['level'];
?>

<!-- Content Wrapper -->
<div class="content-wrapper">

    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>Dashboard</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active"><strong>Dashboard</strong></li>
                    </ol>
                </div>
                <div class="col-sm-12 text-center">
                    <h1 class="m-2"><strong>SELAMAT DATANG DI</strong></h1>
                    <h1 class="m-2"><strong>SISTEM INFORMASI KATALOG PERPUSTAKAAN</strong></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- User Box -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalUser ?></h3>
                            <p>USERS</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <?php if ($level == 1): ?>
                            <a href="user/data-user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php else: ?>
                            <a href="#" onclick="alert('Hanya admin yang dapat mengakses halaman ini.')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Skripsi Box -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalSkripsi ?></h3>
                            <p>KOLEKSI SKRIPSI</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-folder"></i>
                        </div>
                        <a href="informasi/info-skripsi.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                           </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </div>
    <!-- /.content -->

    <?php

    require "template/footer.php";

    ?>


