<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    @media print {
      @page {
        size: B5;
        margin: 0;
      }
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      padding: 24px;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
      /* border: 1px solid black; */
    }

    .header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    .header div {
      /* border: 1px solid black; */
      padding: 8px;
    }



    .dokter {
      border: 1px solid black;
      width: calc(100% / 3);
      height: 100%;
      margin-left: auto;
    }

    .column {
      display: flex;
    }

    .col {
      /* border: 1px solid black; */
      /* display: flex; */
      width: 100%;
      /* height: 500px; */
    }

    table {
      border-collapse: collapse;
      margin: 4px;
      width: 100%;
    }

    table,
    th,
    td {
      border: 1px solid black;
      font-size: 10px;
    }

    th,
    td {
      padding: 0 8px;
    }

    tr td:nth-child(1) {
      text-align: center;
    }

    th {
      font-weight: bold;
    }

    .brand,
    .title {
      display: flex;
      gap: 4px;
      text-align: center;
      align-items: center;
      height:fit-content;
      /* background: red; */
    }

    div.brand {
      border-top: none;
      border-left: none;
      border-right: none;
      width: 60%;
    }

    div.title {
      border-top: none;
    }

    div .logo {
      width: 80px;
      /* height: 80px; */
      border: none;
    }

    div .logo img {
      width: 50px;
      height: 50px;
      object-fit: contain;
      /* filter: grayscale(100%); */
    }

    div.jalan,
    div.text {
      border: none;
    }

    div.text {
      width: 100%;
      /* height: 100%; */
      padding: 0;
      /* background: green; */
    }

    div.jalan {
      font-size: 11px;
      width: 100%;
      height: 100%;
      padding: 0;
    }

    div.form-pasien {
      padding: 8px;
      display: flex;
      align-items: flex-start;
      border-top: none;
      border-right: none;
      border-left: none;
      width: 35%;
      /* justify-content: center; */
    }

    div.form-pasien table,
    div.form-pasien tr,
    div.form-pasien td {
      border: none;
      /* display: flex; */
      text-align: start;
    }

    div.form-pasien td:nth-child(1) {
      width: 80px;
    }

    div.form-pasien td {
      padding: 0;
      /* font-size: 10px; */
      font-weight: 500;
    }

    div.form-sample {
      padding: 8px;
      display: flex;
      align-items: flex-start;
      border-top: none;
      border-right: none;
      border-left: none;
      /* justify-content: center; */
    }

    div.form-sample table,
    div.form-sample tr,
    div.form-sample td {
      border: none;
      /* display: flex; */
      text-align: start;
    }

    div.form-sample td:nth-child(1) {
      width: 150px;
    }

    div.form-sample td {
      padding: 0;
      font-size: 10px;
      font-weight: 500;
    }

    .footer {
      display: flex;
    }

    .footer .form-sample {
      width: 70%;
    }

    .ttd table,
    .ttd tr,
    .ttd td {
      border: none;
    }

    .kotak-ttd {
      height: 50px;
    }

    .kotak-ttd td:nth-child(3) {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="brand">
        <div class="logo">
          <img src="../assets/img/puskesmas logo.png" alt="">
        </div>
        <div class="text">
          <h4>UPTD</h4>
          <h4>PUSKESMAS SINDANGKASIH</h4>
          <div class="jalan">
            Jl. Raya Ancol 1 No. 79 Ciamis Telp. 0265 5303232 Jawa Barat 46268
          </div>
        </div>
      </div>
      <div class="form-pasien">
        
        <table>
          <tr>
            <td>No. Register Lab</td>
            <td>:</td>
            <td><?php
                include('../include/config.php');
                $kode = $_GET['kode'];
                $sql = "SELECT * FROM laporan_lab WHERE kode_laporan='" . $kode . "'";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                  while ($data = mysqli_fetch_array($query)) {
                    echo $data['no_registrasi'];
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Tanggal</td>";
                    echo "<td>:</td>";
                    $sql2 = "SELECT * FROM data_pasien WHERE no_registrasi='" . $data['no_registrasi'] . "'";
                    $query2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($query2) > 0) {
                      while ($data2 = mysqli_fetch_array($query2)) {
                        echo "<td>" . date("d-m-Y", strtotime($data2['tanggal_pemeriksaan'])) . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Nama</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $data2['nama'] . "</td>";
                        echo "</tr>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Umur</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $data2['umur'] . " Tahun</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Alamat</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $data2['alamat'] . "</td>";
                        echo "</tr>";
                      }
                    }
                  }
                }
                ?>
                <tr>
            <td>Dokter Pengirim</td>
            <td>:</td>
            <td>dr. H. Rais Atum/BP Umum</td>
          </tr>
        </table>
      </div>
    </div>
    <h4 style="text-align: center; padding:8px;">Hasil Pemeriksaan Laboratorium</h4>
    <div class="column">
        <div class="col">
        <table>
          <thead>
            <th>NO</th>
            <th>JENIS PEMERIKSAAN</th>
            <th>HASIL</th>
            <th>NILAI RUJUKAN</th>
            <th>SATUAN</th>
          </thead>
          <tbody>
            <tr>
              <th>1</th>
              <td><b>HEMATOLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php
            include('../actions/dataCetak.php');
            ?>
            <?php 
            if ($hemoglobin != ""){
                echo "<tr>";
                echo '<th></th>';
                echo '<td>Hemoglobin</td>';
                echo '<td>'. $hemoglobin .'</td>';
                echo '<td>12-17.4</td>';
                echo '<td>g/dl</td>';
                echo "</tr>";
            }
            if ($leukosit != "") {
                echo "<tr>";
                echo '<th></th>';
                echo '<td>Leukosit</td>';
                echo '<td>' . $leukosit . '</td>';
                echo '<td>5-10</td>';
                echo '<td>10 <sup>9</sup>/l</td>';
                echo "</tr>";
            }
            if ($trombosit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Trombosit</td>";
                echo "<td>" . $trombosit . "</td>";
                echo "<td>150-400</td>";
                echo "<td>10 <sup>9</sup>/l</td>";
                echo "</tr>";
            }

            if ($eritrosit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Eritrosit</td>";
                echo "<td>" . $eritrosit . "</td>";
                echo "<td>4-5.5</td>";
                echo "<td>10 <sup>12</sup>/l</td>";
                echo "</tr>";
            }

            if ($hematokrit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Hematokrit</td>";
                echo "<td>" . $hematokrit . "</td>";
                echo "<td>36-52</td>";
                echo "<td>%</td>";
                echo "</tr>";
            }

            if ($limfosit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Limfosit</td>";
                echo "<td>" . $limfosit . "</td>";
                echo "<td>25-40</td>";
                echo "<td>%</td>";
                echo "</tr>";
            }

            if ($monosit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Monosit</td>";
                echo "<td>" . $monosit . "</td>";
                echo "<td>1.8-17</td>";
                echo "<td>%</td>";
                echo "</tr>";
            }

            if ($granulosit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Granulosit</td>";
                echo "<td>" . $granulosit . "</td>";
                echo "<td>50-70</td>";
                echo "<td>%</td>";
                echo "</tr>";
            }

            if ($led != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>LED</td>";
                echo "<td>" . $led . "</td>";
                echo "<td>0-20</td>";
                echo "<td>mm/jam</td>";
                echo "</tr>";
            }

            if ($golongandarah != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Golongan Darah</td>";
                echo "<td>" . $golongandarah . "</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<th>2</th>";
            echo "<td><b>URINE</b></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th></th>";
            echo "<td>Microskopis:</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            if ($warna != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Warna</td>";
                echo "<td>" . $warna . "</td>";
                echo "<td>Kuning</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($kejernihan != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Kejernihan</td>";
                echo "<td>" . $kejernihan . "</td>";
                echo "<td>Jernih</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($ph != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>pH</td>";
                echo "<td>" . $ph . "</td>";
                echo "<td>5.0-9.0</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($beratjenis != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Berat Jenis</td>";
                echo "<td>" . $beratjenis . "</td>";
                echo "<td>1.002-1.035</td>";
                echo "<td></td>";
                echo "</tr>";
            }
            if ($protein != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Protein</td>";
                echo "<td>" . $protein . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($glukosa != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Glukosa</td>";
                echo "<td>" . $glukosa . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($bilirubin != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Bilirubin</td>";
                echo "<td>" . $bilirubin . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($urobilinogen != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Urobilinogen</td>";
                echo "<td>" . $urobilinogen . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($keton != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Keton</td>";
                echo "<td>" . $keton . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($nitrit != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Nitrit</td>";
                echo "<td>" . $nitrit . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($leukosittt != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Leukosit</td>";
                echo "<td>" . $leukosittt . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($eritrosittt != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Eritrosit</td>";
                echo "<td>" . $eritrosittt . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<th></th>";
            echo "<td>Sedimen:</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            if ($eritrositt != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Eritrosit</td>";
                echo "<td>" . $eritrositt . "</td>";
                echo "<td>0-2</td>";
                echo "<td>/lp</td>";
                echo "</tr>";
            }

            if ($leukositt != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Leukosit</td>";
                echo "<td>" . $leukositt . "</td>";
                echo "<td>0-2</td>";
                echo "<td>/lp</td>";
                echo "</tr>";
            }

            if ($epitel != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Epitel</td>";
                echo "<td>" . $epitel . "</td>";
                echo "<td>5-15</td>";
                echo "<td>/lp</td>";
                echo "</tr>";
            }

            if ($kristal != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Kristal</td>";
                echo "<td>" . $kristal . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($silinder != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Silinder</td>";
                echo "<td>" . $silinder . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($teskehamilan != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Tes Kehamilan</td>";
                echo "<td>" . $teskehamilan . "</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<th>3.</th>";
            echo "<td><b>MICROBIOLOGI</b></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th></th>";
            echo "<td>BTA</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            if ($pagi != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Pagi</td>";
                echo "<td>" . $pagi . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sewaktu != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>-Sewaktu</td>";
                echo "<td>" . $sewaktu . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<th>4</th>";
            echo "<td><b>IMUNOSEROLOGI</b></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            if ($antihiv != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Anti HIV</td>";
                echo "<td>" . $antihiv . "</td>";
                echo "<td>Non reaktif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sifilistprapid != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Sifilis/TP Rapid</td>";
                echo "<td>" . $sifilistprapid . "</td>";
                echo "<td>Non reaktif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($hbsag != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>HBSAg</td>";
                echo "<td>" . $hbsag . "</td>";
                echo "<td>Non reaktif</td>";
                echo "<td></td>";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<th></th>";
            echo "<td>Anti HIV (R2)</td>";
            echo "<td>" . $antihivr2 . "</td>";
            echo "<td>Non reaktif</td>";
            echo "<td></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th></th>";
            echo "<td>Anti HIV (R3)</td>";
            echo "<td>" . $antihivr3 . "</td>";
            echo "<td>Non reaktif</td>";
            echo "<td></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th></th>";
            echo "<td>Widal :</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            if ($styphio != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. typhi O</td>";
                echo "<td>" . $styphio . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sparatyphiao != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. paratyphi AO</td>";
                echo "<td>" . $sparatyphiao . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sparatyphibo != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. paratyphi BO</td>";
                echo "<td>" . $sparatyphibo . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sparatyphico != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. paratyphi CO</td>";
                echo "<td>" . $sparatyphico . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($styphih != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. typhi H</td>";
                echo "<td>" . $styphih . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sparatyphiah != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. paratyphi AH</td>";
                echo "<td>" . $sparatyphiah . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sparatyphibh != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. paratyphi BH</td>";
                echo "<td>" . $sparatyphibh . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($sparatyphich != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>- S. paratyphi CH</td>";
                echo "<td>" . $sparatyphich . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($ns1dbd != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>NS1 DBD</td>";
                echo "<td>" . $ns1dbd . "</td>";
                echo "<td>Negatif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($iggdbd != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>IgG/DBD</td>";
                echo "<td>" . $iggdbd . "</td>";
                echo "<td>Non reaktif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            if ($igmdbd != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>IgM/DBD</td>";
                echo "<td>" . $igmdbd . "</td>";
                echo "<td>Non reaktif</td>";
                echo "<td></td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<th>5</th>";
            echo "<td><b>KIMIA KLINIK</b></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            if ($guladarahsewaktu != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Gula darah sewaktu</td>";
                echo "<td>" . $guladarahsewaktu . "</td>";
                echo "<td>< 200</td>";
                echo "<td>mg/dl</td>";
                echo "</tr>";
            }
            if ($guladarahpuasa != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Gula darah puasa</td>";
                echo "<td>" . $guladarahpuasa . "</td>";
                echo "<td>70 - 100</td>";
                echo "<td>mg/dl</td>";
                echo "</tr>";
            }

            if ($guladarah2jamp != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Gula darah 2 jam PP</td>";
                echo "<td>" . $guladarah2jamp . "</td>";
                echo "<td>< 160</td>";
                echo "<td>mg/dl</td>";
                echo "</tr>";
            }

            if ($kolesteroltotal != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Kolesterol Total</td>";
                echo "<td>" . $kolesteroltotal . "</td>";
                echo "<td>< 200</td>";
                echo "<td>mg/dl</td>";
                echo "</tr>";
            }

            if ($asamurat != '') {
                echo "<tr>";
                echo "<th></th>";
                echo "<td>Asam Urat</td>";
                echo "<td>" . $asamurat . "</td>";
                echo "<td>L: 3.4 - 7</td>";
                echo "<td>mg/dl</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th></th>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>P: 2.4 - 6</td>";
                echo "<td>mg/dl</td>";
                echo "</tr>";
            }

            ?>

          </tbody>
        </table>
      </div>
    </div>
    <div class="footer">
      <div class="form-sample">
        <table>
        <tr>
            <td>Dokter Penanggung Jawab</td>
            <td>:</td>
            <td>dr. H. Rais Atum</td>
          </tr>
          <tr>
            <td>Tgl/Jam pengambilan sample</td>
            <td>:</td>
            <td>..../..../....</td>
          </tr>
          <tr>
            <td>Tgl/Jam pemeriksaan selesai</td>
            <td>:</td>
            <td>..../..../....</td>
          </tr>
        </table>
      </div>
      <div class="ttd">
        <table>
          <tr>
            <td>Pemeriksa</td>
          </tr>
          <tr>
            <td class="kotak-ttd"></td>
          </tr>
          <tr>
            <td>Heni Ekasari, AM.AK</td>
          </tr>
          <tr>
            <td>NIP. 19820307200642011</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <script>
    window.onload = function() {
      window.print();
      window.onafterprint = function() {
        window.close();
      };
    };
  </script>
</body>

</html>