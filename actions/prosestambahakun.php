<?php
include ('../include/config.php');

if (isset($_POST['simpan'])) {
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
    $foto = addslashes($foto);
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $password = password_hash($pw, PASSWORD_DEFAULT);
    $nama = $_POST['nama'];

    // Menggunakan prepared statements untuk menghindari SQL injection
    $sql = "INSERT INTO user(username, password, namauser, foto) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $nama, $foto);
    
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        header('Location: ../tambah-akun/?status=sukses');
    } else {
        header('Location: ../tambah-akun/?status=gagal');
    }
} else {
    die('Akses dilarang');
}
?>
