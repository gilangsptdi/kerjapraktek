<?php
include ('../include/config.php');
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/cetak.css">
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
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
                <b><?php echo $nama?></b>
                <?php echo $username?>
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
        <div class="show ">
            <a href="../addpasien/" class="menu ">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Pasien</p>
            </a>
            <a href="../addlaporan/" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Laporan Pasien</p>
            </a>
        </div>
<!-- tes -->
        <a class="menu dropdown">
            <i class="bi bi-hospital"></i>
            <p>Hasil</p>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show aktif">
            <a href="../datapasien/index.php" class="menu">
                <i class="bi bi-person-lines-fill"></i>
                <p>Daftar Pasien</p>
            </a>
            <a href="../datalaporan/" class="menu active">
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
                    <img src="../assets/img/puskesmas logo.png" alt="logo puskesmas" />
                    <h2 class="judul">PUSKESMAS SINDANGKASIH</h2>
                </a>
            </nav>
        </header>

        <div class="formlap-container">
            <h2 class="lab">HASIL LAPORAN</h2>
            
            <table id="mytable" class="display print">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Registrasi</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                <tbody>
                    <?php
                    include('../include/config.php');

                    $sql = "SELECT * FROM laporan_lab";
                    $query = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<th>" . $no . "</th>";
                            echo "<td>" . $data['no_registrasi'] . "</td>";
                            echo "<td>";
                            $sql2 = "SELECT nama FROM data_pasien WHERE no_registrasi='" . $data['no_registrasi'] . "'";
                            $query2 = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($query2) > 0) {
                                while ($data2 = mysqli_fetch_array($query2)) {
                                    echo $data2['nama'];
                                }
                            }
                            echo "</td>";
                            echo "<td>" . $data['tanggal'] . "</td>";
                            echo "<td class='btn-center'><a class='cetak' href='../laporan-pemeriksaan/?kode=" . $data['kode_laporan'] . "'>Cetak Biasa</a>";
                            echo "  <a class='cetak' href='./tes.php?kode=" . $data['kode_laporan'] . "'>Cetak Rinci</a>";
                            echo "<a class='hapus' href='../actions/hapus_laporan.php?kode=" . $data['kode_laporan'] . "'>Hapus</a></td>";
                            echo "</tr>";
                            $no++;
                        }
                    }
                    ?>

                </tbody>
                </thead>
            </table>
            <!-- <button onclick="printPage('tes.html')">Cetak</button> -->
        </div>
    </main>
    <?php include('../actions/cekStatus.php');?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></> -->
    <script src="../assets/js/script.js"></script>
    
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
       
        new DataTable('#mytable');

        function printPage(url) {
            // Buka jendela baru dengan URL yang diberikan
            var printWindow = window.open(url, '_blank');
            // Tunggu hingga halaman sepenuhnya dimuat
            printWindow.onload = function() {
                // Cetak halaman dan tutup jendela setelah selesai mencetak
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>
</body>

</html>