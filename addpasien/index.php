<?php
include('../include/config.php');
include('../actions/MySQLSessionHandler.php');
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

if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
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
        <div class="show">
            <a href="../profile/" class=" menu">
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
        <div class="show aktif">
            <a href="../addpasien/" class="menu active">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Pasien</p>
            </a>
            <a href="../addlaporan/" class="menu">
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
            <a href="../datalaporan/" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Daftar Laporan</p>
            </a>
        </div>

        <a href="../actions/logout.php" class="menu">
            <i class="bi bi-box-arrow-left"></i>
            <p>Log Out</p>
        </a>
    </aside>

    <main id="home">
        <header>
            <nav>
                <a href="../dashboard/" class="navbrand">
                    <img src="../assets/img/puskesmas logo.png" alt="logo puskesmas">
                    <h2 class="judul">PUSKESMAS SINDANGKASIH</h2>
                </a>
            </nav>
        </header>

        <!-- Content -->

        <div class="form-container">
            <div class="row">
                <div class="card">
                    <div class="">
                        <h2 class="bio">Biodata Pasien</h2>
                        <form action="../actions/prosesaddpasien.php" method="POST">
                            <div class="row">
                                <?php
                                include('../actions/generatecode.php')
                                ?>
                                <label for="no_registrasi">No. Registrasi Lab</label>
                                <input type="text" value="<?php echo $noreg ?>" disabled>
                                <input type="hidden" name="no_registrasi" value="<?php echo $noreg ?>">
                            </div>
                            <div class="row">
                                <?php
                                $currentDate = Date('Y-m-d');
                                ?>
                                <label for="tanggal">Tanggal Pemeriksaan</label>
                                <input type="date" id="tanggal" name="tanggal" value="<?php echo $currentDate ?>">
                            </div>
                            <div class="row">
                                <label for="nama">Nama</label>
                                <input name="nama" type="text">
                            </div>
                            <div class="row">
                                <label for="umur">Umur</label>
                                <input name="umur" type="number">
                            </div>
                            <div class="row center">
                                <label for="jeniskelamin">Jenis Kelamin</label>
                                <input id="lakilaki" value="laki-laki" type="radio" name="jeniskelamin">
                                <label for="lakilaki">Laki-laki</label>
                                <input id="perempuan" value="perempuan" type="radio" name="jeniskelamin">
                                <label for="perempuan">Perempuan</label>
                            </div>
                            <div class="row">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" rows="3"></textarea>
                            </div>

                            <input type="submit" name="simpan" value="Simpan" class="simpan">
                        </form>
                    </div>
                    <a href="#" type="button" class="btn btn-success" style="width: 20%;">Simpan data</a>
                </div>
            </div>
        </div>

        <!-- Content -->
    </main>
    <?php include('../actions/cekStatus.php'); ?>
    <script src="../assets/js/script.js"></script>
    <script>
    </script>
    <script>
        function validateForm(event) {
            // Dapatkan semua input yang ingin divalidasi
            var tanggal = document.getElementById('tanggal').value;
            var nama = document.querySelector('input[name="nama"]').value;
            var umur = document.querySelector('input[name="umur"]').value;
            var jeniskelamin = document.querySelector('input[name="jeniskelamin"]:checked');
            var alamat = document.querySelector('textarea[name="alamat"]').value;

            // Validasi apakah semua input telah diisi
            if (!tanggal || !nama || !umur || !jeniskelamin || !alamat) {
                // Tampilkan alert jika ada input yang kosong
                alert("Semua harus diisi.");
                // Cegah pengiriman form
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Tambahkan event listener pada form saat akan disubmit
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector('form');
            form.addEventListener('submit', validateForm);
        });
    </script>
</body>

</html>