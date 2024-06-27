<?php
include('../include/config.php');

function bulanRomawi($bulan)
{
    $bulanRomawiArray = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    return $bulanRomawiArray[$bulan];
}

// Mendapatkan bulan dan tahun saat ini
$currentMonthRomawi = bulanRomawi(date('n')); // Format bulan dengan dua digit (01-12)
$currentMonth = date('m');
$currentYear = date('Y');

$pattern = "/pum-lab/{$currentMonthRomawi}/{$currentYear}";

// Mendapatkan data terakhir berdasarkan bulan dan tahun saat ini
$sql = "SELECT nomor FROM data_pasien WHERE MONTH(tanggal_pemeriksaan) = $currentMonth AND YEAR(tanggal_pemeriksaan) = $currentYear ORDER BY nomor DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika ada data, ambil nomor terakhir dan tambahkan 1
    $row = $result->fetch_assoc();
    $newNumber = $row['nomor'] + 1;
} else {
    // Jika tidak ada data, set nomor menjadi 1
    $newNumber = 1;
}
$noreg = $newNumber . $pattern;