<?php
require_once('../include/config.php');
require_once('../actions/MySQLSessionHandler.php');

// Start the session and check if user is logged in
session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
}

$kodeProfil = $_SESSION['kode_user'];
$sql = "SELECT * FROM user WHERE kode_user='$kodeProfil'";
$query = mysqli_query($conn, $sql);

$foto = '';
$nama = '';
$username = '';


if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];
    $foto = base64_encode($foto);
    $nama = $data['namauser'];
    $username = $data['username'];
} else {
    error_log("User dengan kode $kodeProfil tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    </link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body id="dashboard">
    <aside>
        <nav>
            <b>Laporan Laboratorium</b>
            <i class="bi bi-list"></i>
        </nav>
        <a class="profile dropdown">
            <img src="data:image/jpeg;base64,<?php echo $foto ?>" alt="profile" />
            <div class="card-profile">
                <b><?php echo $nama ?></b>
                <?php echo $username ?>
            </div>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show aktif">
            <a href="../profile/" class=" menu  active">
                <i class="bi bi-person-circle"></i>
                <p>Akun Saya</p>
            </a>
        </div>

        <hr>
        <a href="../dashboard/" class="menu">
            <i class="bi bi-house"></i>
            <p>Home</p>

        </a>
        <a class="menu dropdown">
            <i class="bi bi-hospital"></i>
            <p>Tambah Data</p>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show">
            <a href="../addpasien/" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Pasien</p>
            </a>
            <a href="" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Laporan Pasien</p>
            </a>
        </div>

        <a class="menu dropdown">
            <i class="bi bi-hospital"></i>
            <p>Hasil</p>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show">
            <a href="../datapasien/index.php" class="menu">
                <i class="bi bi-person-lines-fill"></i>
                <p>Daftar Pasien</p>
            </a>
            <a href="" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Daftar Laporan</p>
            </a>
        </div>

        <a href="../actions/logout.php" class="menu">
            <i class="bi bi-box-arrow-left"></i>
            <p>Log Out</p>
        </a>
    </aside>

    <main id="profile">
        <header>
            <nav>
                <a href="../dashboard/" class="navbrand">
                    <img src="../assets/img/puskesmas logo.png" alt="logo puskesmas">
                    <h2>PUSKESMAS SINDANGKASIH</h2>
                </a>
            </nav>
        </header>

        <!-- Content -->
        <div class="container">
            <h2>Profile</h2>
            <div class="card">
                <img src="data:image/jpeg;base64,<?php echo $foto ?>" alt="profile" />
                <h3><?php echo $nama ?></h3>
                <p><?php echo $username ?></p>
                <div class="btn-group">
                    <a href="../profile/akun.php" class="btn btn-reset">Ubah Profile</a>
                    <a href="../actions/logout.php" class="btn btn-logout"> Logout</a>
                </div>
            </div>
        </div>
        <!-- Content -->
    </main>
    <script src="../assets/js/script.js"></script>
</body>

</html>