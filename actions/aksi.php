<?php
$koneksi = mysqli_connect("localhost", "root", "", "laboratorium");
if (isset($_POST["save"])) {
    // var_dump($_POST);
    // die;
    $noreg = $_POST["noreg"];
    $nama = $_POST["nama"];
    $umur = $_POST["umur"];
    $alamat = $_POST["alamat"];
    $jeniskelamin = $_POST["jeniskelamin"];
    $tanggal = $_POST["tanggal"];
    $query = "INSERT INTO data_pasien VALUES ('', '$noreg','$nama', '$umur','$alamat', '$jeniskelamin','$tanggal')";
    mysqli_query($koneksi, $query);
    var_dump($_POST);
}
// echo "<script> alert('berhasil ditambahkan'); document.location.href = 'index.php'</script>";
