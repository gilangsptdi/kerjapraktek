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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
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
    <i class="bi bi-caret-down-fill"></i>
    </a>
    <div class="show">
      <a href="../profile/" class="menu">
        <i class="bi bi-person-circle"></i>
        <p>Akun Saya</p>
      </a>
    </div>

    <hr />
    <a href="../dashboard/" class="menu active">
      <i class="bi bi-house"></i>
      <p>Home</p>
    </a>
    <a class="menu dropdown">
      <i class="bi bi-hospital"></i>
      <p>Tambah Data</p>
      <i class="bi bi-caret-down-fill"></i>
    </a>
    <div class="show aktif">
      <a href="../addpasien/" class="menu">
        <i class="bi bi-person-fill-add"></i>
        <p>Tambah Pasien</p>
      </a>
      <a href="../addlaporan/" class="menu active">
        <i class="bi bi-person-fill-add"></i>
        <p>Tambah Laporan Pasien</p>
      </a>
    </div>

    <a class="menu dropdown">
      <i class="bi bi-hospital"></i>
      <p>Hasil</p>
      <i class="bi bi-caret-down-fill"></i>
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
          <img src="../assets/img/puskesmas logo.png" alt="logo puskesmas" />
          <h2 class="judul">PUSKESMAS SINDANGKASIH</h2>
        </a>
      </nav>
    </header>

    <div class="formlap-container">
      <form action="../actions/tambah_laporan.php" method="POST">
        <h2 class="lab">INPUT LAPORAN LABORATORIUM</h2>
        <input type="hidden" name="tanggal" value="<?php echo Date('Y-m-d'); ?>">
        <div class="cari">
          <label for="noreg">No.Registrasi</label>
          <select name="noreg" id="noreg" required>
            <option value="" selected disabled>-Pilih-</option>
            <?php
            include('../include/config.php');

            //   $hemoglobin = !empty($_POST['hemoglobin']) ? $_POST['hemoglobin'] : null;
            //   $leukosit = !empty($_POST['leukosit']) ? $_POST['leukosit'] : null;
            // $trombosit = !empty($_POST['trombosit']) ? $_POST['trombosit'] : null;
            $sql = "SELECT * FROM data_pasien";
            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query) > 0) {
              while ($data = mysqli_fetch_array($query)) {
                echo "<option value='" . $data['no_registrasi'] . "'>" . $data['no_registrasi'] . " " . $data['nama'] . "</option>";
              }
            }
            ?>
          </select>
        </div>
        <table id="mytable" class="display">
          <thead>
            <tr>
              <th>NO</th>
              <th>JENIS PEMERIKSAAN</th>
              <th>HASIL</th>
              <th>NILAI RUJUKAN</th>
              <th>SATUAN</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>1</th>
              <td><b>HEMATOLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Hemoglobin</td>
              <td><input type="text" name="hemoglobin" /></td>
              <td>12-17.4</td>
              <td>g/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Leukosit</td>
              <td><input type="text" name="leukosit" /></td>
              <td>5-10</td>
              <td>10 <sup>9</sup>/l</td>
            </tr>
            <tr>
              <th></th>
              <td>Trombosit</td>
              <td><input type="text" name="trombosit" /></td>
              <td>150-400</td>
              <td>10 <sup>9</sup>/l</td>
            </tr>
            <tr>
              <th></th>
              <td>Eritrosit</td>
              <td><input type="text" name="eritrosit" /></td>
              <td>4-5.5</td>
              <td>10 <sup>12</sup>/l</td>
            </tr>
            <tr>
              <th></th>
              <td>Hematokrit</td>
              <td><input type="text" name="hematokrit" /></td>
              <td>36-52</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>Limfosit</td>
              <td><input type="text" name="limfosit" /></td>
              <td>25-40</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>Monosit</td>
              <td><input type="text" name="monosit" /></td>
              <td>1.8-17</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>Granulosit</td>
              <td><input type="text" name="granulosit" /></td>
              <td>50-70</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>LED</td>
              <td><input type="text" name="led" /></td>
              <td>0-20</td>
              <td>mm/jam</td>
            </tr>
            <tr>
              <th></th>
              <td>Golongan Darah</td>
              <td><input type="text" name="golongandarah" /></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th>2</th>
              <td><b>URINE</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Microskopis:</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Warna</td>
              <td><input type="text" name="warna" /></td>
              <td>Kuning</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Kejernihan</td>
              <td><input type="text" name="kejernihan" /></td>
              <td>Jernih</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>pH</td>
              <td><input type="text" name="ph" /></td>
              <td>5.0-9.0</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Berat Jenis</td>
              <td><input type="text" name="beratjenis" /></td>
              <td>1.002-1.035</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>protein</td>
              <td><input type="text" name="protein" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Glukosa</td>
              <td><input type="text" name="glukosa" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Bilirubin</td>
              <td><input type="text" name="bilirubin" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Urobilinogen</td>
              <td><input type="text" name="urobilinogen" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Keton</td>
              <td><input type="text" name="keton" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Nitrit</td>
              <td><input type="text" name="nitrit" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Leukosit</td>
              <td><input type="text" name="leukosittt" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Eritrosit</td>
              <td><input type="text" name="eritrosittt" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Sedimen:</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Eritrosit</td>
              <td><input type="text" name="eritrositt" /></td>
              <td>0-2</td>
              <td>/lp</td>
            </tr>
            <tr>
              <th></th>
              <td>-Leukosit</td>
              <td><input type="text" name="leukositt" /></td>
              <td>0-2</td>
              <td>/lp</td>
            </tr>
            <tr>
              <th></th>
              <td>-Epitel</td>
              <td><input type="text" name="epitel" /></td>
              <td>5-15</td>
              <td>/lp</td>
            </tr>
            <tr>
              <th></th>
              <td>-Kristal</td>
              <td><input type="text" name="kristal" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Silinder</td>
              <td><input type="text" name="silinder" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Tes Kehamilan</td>
              <td><input type="text" name="teskehamilan" /></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th>3.</th>
              <td><b>MICROBIOLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>BTA</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Pagi</td>
              <td><input type="text" name="pagi" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Sewaktu</td>
              <td><input type="text" name="sewaktu" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th>4</th>
              <td><b>IMUNOSEROLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Anti HIV</td>
              <td><input type="text" name="antihiv" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Sifilis/TP Rapid</td>
              <td><input type="text" name="sifilistprapid" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>HBSAg</td>
              <td><input type="text" name="hbsag" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Anti HIV (R2)</td>
              <td><input type="text" name="antihivr2" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Anti HIV (R3)</td>
              <td><input type="text" name="antihivr3" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Widal :</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. typhi O</td>
              <td><input type="text" name="styphio" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi AO</td>
              <td><input type="text" name="sparatyphiao" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi BO</td>
              <td><input type="text" name="sparatyphibo" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi CO</td>
              <td><input type="text" name="sparatyphico" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. typhi H</td>
              <td><input type="text" name="styphih" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi AH</td>
              <td><input type="text" name="sparatyphiah" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi BH</td>
              <td><input type="text" name="sparatyphibh" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi CH</td>
              <td><input type="text" name="sparatyphich" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>NS1 DBD</td>
              <td><input type="text" name="ns1dbd" /></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>IgG/DBD</td>
              <td><input type="text" name="iggdbd" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Igm/DBD</td>
              <td><input type="text" name="igmdbd" /></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th>5</th>
              <td><b>KIMIA KLINIK</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Gula darah sewaktu</td>
              <td><input type="text" name="guladarahsewaktu" /></td>
              <td>
                < 200</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Gula darah puasa</td>
              <td><input type="text" name="guladarahpuasa" /></td>
              <td>70 - 100</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Gula darah 2 jam PP</td>
              <td><input type="text" name="guladarah2jamp" /></td>
              <td>
                < 160</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Kolesterol Total</td>
              <td><input type="text" name="kolesteroltotal" /></td>
              <td>
                < 200</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Asam Urat</td>
              <td><input type="text" name="asamurat" /></td>
              <td>L: 3.4 - 7</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td>P: 2.4 - 6</td>
              <td>mg/dl</td>
            </tr>
          </tbody>
        </table>
        <input name="simpan" type="submit" value="Simpan" class="submit">
      </form>
    </div>
  </main>
  <?php include('../actions/cekStatus.php'); ?>
  <script src="../assets/js/script.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <script>
    // new DataTable('#mytable');
    $('#mytable').DataTable({
      ordering: false,
      paging: false
    });
  </script>
</body>

</html>