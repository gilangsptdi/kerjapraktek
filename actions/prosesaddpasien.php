<?php
include('../include/config.php');
if (isset($_POST['simpan'])) {
    $noreg = $_POST['no_registrasi'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jeniskelamin'];

    include('./generatecode.php');
    $sql = "INSERT INTO data_pasien(no_registrasi, nomor, nama, umur, alamat, jenis_kelamin, tanggal_pemeriksaan) VALUE('$noreg', '$newNumber', '$nama', '$umur', '$alamat', '$jeniskelamin', '$tanggal')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../addpasien/?status=sukses');
    } else {
        header('Location: ../addpasien/?status=gagal');
    }
} else {
    die('akses dilarang');
}
