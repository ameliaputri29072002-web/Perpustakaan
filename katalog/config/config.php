<?php

date_default_timezone_set('Asia/Jakarta');

$host = '153.92.15.3';
$user = 'u354480686_db_katalog';
$pass = ':7fgH3wO9m';
$dbname = 'u354480686_db_katalog';

$koneksi = mysqli_connect($host,$user,$pass,$dbname); 


//if (mysqli_connect_errno()) {
//    echo "gagal koneksi ke database";
//    exit();
//} else {
//    echo "berhasil koneksi ke database";
//}

$main_url = 'http://amel-simperpus.com/katalog/';



?>