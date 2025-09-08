<?php
// Deklarasi variabel
$nama = "Aqram";
$umur = 22;
$nilai = 85;

// Operator
$umurTahunDepan = $umur + 1;

// If-Else
if ($nilai >= 80) {
    $keterangan = "Lulus dengan baik";
} else {
    $keterangan = "Perlu belajar lebih giat";
}

// Output
echo "Halo, nama saya $nama<br>";
echo "Umur saya sekarang $umur tahun, tahun depan $umurTahunDepan<br>";
echo "Nilai saya: $nilai ($keterangan)";
?>
