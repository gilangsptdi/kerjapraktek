<?php
include('../include/config.php');

if (isset($_POST['simpan'])) {
    // $kode_laporan = $_POST['kode_laporan'];
    $noreg = $_POST['noreg'];
    $hemoglobin = $_POST['hemoglobin'];
    $leukosit = $_POST['leukosit'];
    $trombosit = $_POST['trombosit'];
    $eritrosit = $_POST['eritrosit'];
    $hematokrit = $_POST['hematokrit'];
    $limfosit = $_POST['limfosit'];
    $monosit = $_POST['monosit'];
    $granulosit = $_POST['granulosit'];
    $led = $_POST['led'];
    $golongandarah = $_POST['golongandarah'];
    $warna = $_POST['warna'];
    $kejernihan = $_POST['kejernihan'];
    $ph = $_POST['ph'];
    $beratjenis = $_POST['beratjenis'];
    $protein = $_POST['protein'];
    $glukosa = $_POST['glukosa'];
    $bilirubin = $_POST['bilirubin'];
    $urobilinogen = $_POST['urobilinogen'];
    $keton = $_POST['keton'];
    $nitrit = $_POST['nitrit'];
    $leukosittt = $_POST['leukosittt'];
    $eritrosittt = $_POST['eritrosittt'];
    $eritrositt = $_POST['eritrositt'];
    $leukositt = $_POST['leukositt'];
    $epitel = $_POST['epitel'];
    $kristal = $_POST['kristal'];
    $silinder = $_POST['silinder'];
    $teskehamilan = $_POST['teskehamilan'];
    $pagi = $_POST['pagi'];
    $sewaktu = $_POST['sewaktu'];
    $antihiv = $_POST['antihiv'];
    $sifilistprapid = $_POST['sifilistprapid'];
    $hbsag = $_POST['hbsag'];
    $antihivr2 = $_POST['antihivr2'];
    $antihivr3 = $_POST['antihivr3'];
    $styphio = $_POST['styphio'];
    $sparatyphiao = $_POST['sparatyphiao'];
    $sparatyphibo = $_POST['sparatyphibo'];
    $sparatyphico = $_POST['sparatyphico'];
    $styphih = $_POST['styphih'];
    $sparatyphiah = $_POST['sparatyphiah'];
    $sparatyphibh = $_POST['sparatyphibh'];
    $sparatyphich = $_POST['sparatyphich'];
    $ns1dbd = $_POST['ns1dbd'];
    $iggdbd = $_POST['iggdbd'];
    $igmdbd = $_POST['igmdbd'];
    $guladarahsewaktu = $_POST['guladarahsewaktu'];
    $guladarahpuasa = $_POST['guladarahpuasa'];
    $guladarah2jamp = $_POST['guladarah2jamp'];
    $kolesteroltotal = $_POST['kolesteroltotal'];
    $asamurat = $_POST['asamurat'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO laporan_lab (
                tanggal, no_registrasi, hemoglobin, leukosit, trombosit, eritrosit, hematokrit, limfosit, monosit, granulosit, led, golongandarah, warna, kejernihan, ph, beratjenis, protein,
                glukosa, bilirubin, urobilinogen, keton, nitrit, leukosittt, eritrosittt, eritrositt, leukositt, epitel, kristal, silinder, teskehamilan, 
                pagi, sewaktu, antihiv, sifilistprapid, hbsag, antihivr2, antihivr3, styphio, sparatyphiao, sparatyphibo, sparatyphico, 
                styphih, sparatyphiah, sparatyphibh, sparatyphich, ns1dbd, iggdbd, igmdbd, guladarahsewaktu, guladarahpuasa, guladarah2jamp, 
                kolesteroltotal, asamurat) VALUES ('$tanggal', '$noreg', '$hemoglobin', '$leukosit','$trombosit', '$eritrosit', '$hematokrit', '$limfosit','$monosit', '$granulosit', '$led', '$golongandarah', '$warna', '$kejernihan', '$ph', '$beratjenis','$protein',
                '$glukosa', '$bilirubin', '$urobilinogen', '$keton', '$nitrit', '$leukosittt', '$eritrosittt', '$eritrositt', '$leukositt', '$epitel', '$kristal', '$silinder', '$teskehamilan', 
                '$pagi', '$sewaktu', '$antihiv', '$sifilistprapid', '$hbsag', '$antihivr2', '$antihivr3', '$styphio', '$sparatyphiao', '$sparatyphibo', '$sparatyphico', 
                '$styphih', '$sparatyphiah', '$sparatyphibh', '$sparatyphich', '$ns1dbd', '$iggdbd', '$igmdbd', '$guladarahsewaktu', '$guladarahpuasa', '$guladarah2jamp', 
                '$kolesteroltotal', '$asamurat')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../addlaporan/?status=sukses');
    } else {
        header('Location: ../addlaporan/?status=gagal');
    }
} else {
    die('Akses dilarang');
}
