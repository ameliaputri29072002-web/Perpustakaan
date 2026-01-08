
<?php

function generateId(){
    global $koneksi;
    $queryId = mysqli_query($koneksi, "SELECT MAX(id_skripsi) as maxid FROM tbl_skripsi");
    $data    = mysqli_fetch_array($queryId);
    $maxid   = $data['maxid'];

    if ($maxid) {
        // Ambil angka setelah "SKR-"
        $noUrut = (int) substr($maxid, 4);
        $noUrut++;
    } else {
        // Jika belum ada data, mulai dari 812
        $noUrut = 812;
    }

    // Buat ID baru dengan format "SKR-xxx"
    $newId = "SKR-" . $noUrut;

    return $newId;
}


// Fungsi untuk menambahkan data skripsi
function insert($data) {
    global $koneksi;

    $id_skripsi               = mysqli_real_escape_string($koneksi, $data['id_skripsi']);
    $kode_katalog            = mysqli_real_escape_string($koneksi, $data['kode_katalog']);
    $barcode                  = mysqli_real_escape_string($koneksi, $data['barcode']);
    $nama_mahasiswa           = mysqli_real_escape_string($koneksi, $data['nama_mahasiswa']);
    $nim_mahasiswa            = mysqli_real_escape_string($koneksi, $data['nim_mahasiswa']);
    $judul_skripsi            = mysqli_real_escape_string($koneksi, $data['judul_skripsi']);
    $jumlah_halaman           = mysqli_real_escape_string($koneksi, $data['jumlah_halaman']);
    $tahun_cetak              = mysqli_real_escape_string($koneksi, $data['tahun_cetak']);
    $subyek                   = mysqli_real_escape_string($koneksi, $data['subyek']);
    $link_dokumen             = mysqli_real_escape_string($koneksi, $data['link_dokumen']);
    $nama_dosen_pembimbing_1  = mysqli_real_escape_string($koneksi, $data['nama_dosen_pembimbing_1']);
    $nama_dosen_pembimbing_2  = mysqli_real_escape_string($koneksi, $data['nama_dosen_pembimbing_2']);
    $nama_dosen_penguji_1     = mysqli_real_escape_string($koneksi, $data['nama_dosen_penguji_1']);
    $nama_dosen_penguji_2     = mysqli_real_escape_string($koneksi, $data['nama_dosen_penguji_2']);
    $nama_dosen_penguji_3     = mysqli_real_escape_string($koneksi, $data['nama_dosen_penguji_3']);
    $lokasi_skripsi           = mysqli_real_escape_string($koneksi, $data['lokasi_skripsi']);

    // Validasi barcode unik
    $cekBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_skripsi WHERE barcode = '$barcode'");
    if (mysqli_num_rows($cekBarcode) > 0) {
        echo '<script>alert("Kode barcode sudah ada, skripsi gagal ditambahkan")</script>';
        return false;
    }

    $sqlSkripsi = "INSERT INTO tbl_skripsi (
       id_skripsi, kode_katalog,  barcode, nama_mahasiswa, nim_mahasiswa, judul_skripsi, jumlah_halaman, 
        tahun_cetak, subyek, link_dokumen, nama_dosen_pembimbing_1, nama_dosen_pembimbing_2, 
        nama_dosen_penguji_1, nama_dosen_penguji_2, nama_dosen_penguji_3, lokasi_skripsi
    ) VALUES (
        '$id_skripsi', '$kode_katalog', '$barcode', '$nama_mahasiswa', '$nim_mahasiswa',  '$judul_skripsi', '$jumlah_halaman', 
        '$tahun_cetak', '$subyek',  '$link_dokumen', '$nama_dosen_pembimbing_1', '$nama_dosen_pembimbing_2', 
        '$nama_dosen_penguji_1', '$nama_dosen_penguji_2', '$nama_dosen_penguji_3', '$lokasi_skripsi')";
    
    mysqli_query($koneksi, $sqlSkripsi);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menghapus data skripsi berdasarkan ID
function delete($id) {
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $id); // Amankan ID sebelum digunakan
    $sqlDelete = "DELETE FROM tbl_skripsi WHERE id_skripsi = '$id'";

    mysqli_query($koneksi, $sqlDelete);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk memperbarui data skripsi berdasarkan ID
function update($data) {
    global $koneksi;

    $id_skripsi                      = mysqli_real_escape_string($koneksi, $data['id_skripsi']);
    $kode_katalog            = mysqli_real_escape_string($koneksi, $data['kode_katalog']); 
    $barcode                  = mysqli_real_escape_string($koneksi, $data['barcode']);
    $nama_mahasiswa           = mysqli_real_escape_string($koneksi, $data['nama_mahasiswa']);
    $nim_mahasiswa            = mysqli_real_escape_string($koneksi, $data['nim_mahasiswa']);
    $judul_skripsi            = mysqli_real_escape_string($koneksi, $data['judul_skripsi']);
    $jumlah_halaman           = mysqli_real_escape_string($koneksi, $data['jumlah_halaman']);
    $tahun_cetak              = mysqli_real_escape_string($koneksi, $data['tahun_cetak']);
    $subyek                   = mysqli_real_escape_string($koneksi, $data['subyek']);
    $link_dokumen             = mysqli_real_escape_string($koneksi, $data['link_dokumen']);
    $nama_dosen_pembimbing_1  = mysqli_real_escape_string($koneksi, $data['nama_dosen_pembimbing_1']);
    $nama_dosen_pembimbing_2  = mysqli_real_escape_string($koneksi, $data['nama_dosen_pembimbing_2']);
    $nama_dosen_penguji_1     = mysqli_real_escape_string($koneksi, $data['nama_dosen_penguji_1']);
    $nama_dosen_penguji_2     = mysqli_real_escape_string($koneksi, $data['nama_dosen_penguji_2']);
    $nama_dosen_penguji_3     = mysqli_real_escape_string($koneksi, $data['nama_dosen_penguji_3']);
    $lokasi_skripsi           = mysqli_real_escape_string($koneksi, $data['lokasi_skripsi']);

    // Validasi barcode unik jika diubah
    $cekBarcode = mysqli_query($koneksi, "SELECT * FROM tbl_skripsi WHERE barcode = '$barcode' AND id_skripsi != '$id_skripsi'");
    if (mysqli_num_rows($cekBarcode) > 0) {
        echo '<script>alert("Kode barcode sudah ada, skripsi gagal diperbarui")</script>';
        return false;
    }

    $sqlSkripsi = "UPDATE tbl_skripsi SET
                   kode_katalog             ='$kode_katalog',
                   barcode                 = '$barcode',
                   nama_mahasiswa          = '$nama_mahasiswa',
                   nim_mahasiswa           = '$nim_mahasiswa',
                   judul_skripsi           = '$judul_skripsi',
                   jumlah_halaman          = '$jumlah_halaman',
                   tahun_cetak             = '$tahun_cetak',
                   subyek                  = '$subyek',
                   link_dokumen            = '$link_dokumen',
                   nama_dosen_pembimbing_1 = '$nama_dosen_pembimbing_1',
                   nama_dosen_pembimbing_2 = '$nama_dosen_pembimbing_2',
                   nama_dosen_penguji_1    = '$nama_dosen_penguji_1',
                   nama_dosen_penguji_2    = '$nama_dosen_penguji_2',
                   nama_dosen_penguji_3    = '$nama_dosen_penguji_3',
                   lokasi_skripsi          = '$lokasi_skripsi'
                   WHERE id_skripsi = '$id_skripsi'";

    mysqli_query($koneksi, $sqlSkripsi);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menampilkan semua data skripsi
function getAll() {
    global $koneksi;

    $sqlGetAll = "SELECT * FROM tbl_skripsi";
    $result = mysqli_query($koneksi, $sqlGetAll);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi untuk mengambil data skripsi berdasarkan ID
function getById($id) {
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $id);
    $sqlGetById = "SELECT * FROM tbl_skripsi WHERE id_skripsi = '$id'";
    $result = mysqli_query($koneksi, $sqlGetById);

    return mysqli_fetch_assoc($result);
}

?>


