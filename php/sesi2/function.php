<?php 
// membuat function yang bisa dipakai berulang
function tampilkanNama($nama) {
  echo "Halo, nama saya $nama";
}

tampilkanNama("Sari");

function jumlah ($a, $b) {
  return $a + $b;
}
$angka1 = 10;
$angka2 = 4;
echo "Hasilnya dari $angka1 + $angka2 adalah " . jumlah($angka1, $angka2);


// jumlah(2,4);
// echo "Hasilnya adalah [ " . jumlah(2, 3) . " ]";
?>