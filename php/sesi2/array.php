<?php 
$buah = ["durian", "apel", "jeruk", "mangga", "pisang", "semangka"];

// echo $buah[0] . "<br>";
// echo $buah[4] . "<br>";

// cara tambah data array terakhir 
array_push($buah, "jambu"); // array_push()
// cara hapus data array terakhir 
// $buah_hapus = array_pop($buah);

// foreach ($buah as $b) {
//   echo $b . "<br>";
// }
for ($i = 0; $i < count($buah); $i++) {
  echo $i+1 . "." . $buah[$i] . "<br><br>";
}

// misal ada array dalam array data mahasiswa

$kelas = [
  [
    "nama" => "Aqram",
    "umur" => 22,
    "alamat" => "Gorontalo"
  ],
  [
    "nama" => "Fira",  
    "umur" => 12,
    "alamat" => "Gorontalo"
  ],
  [
    "nama" => "Gontu",  
    "umur" => 2,
    "alamat" => "Gorontalo"
  ]
];

// cara tambahkan data baru ke array 
$kelas[] = [  "nama" => "Dimas",  "umur" => 24,  "alamat" => "Gorontalo"
];
// cara hapus daata array index ke 2
// unset($kelas[1]);

// cara urutkan array berdasarkan nama
sort($kelas);

// cara menjumlah data array
// echo "jumlah data berapa orang di kelas adalah " . count($kelas);

// tampilkan satu-satu
// echo $kelas[0]["nama"] . "<br>";
// echo $kelas[1]["umur"] . "<br>";
// echo $kelas[2]["alamat"] . "<br>";

// tampilkan dengan foreach
foreach ($kelas as $k) {
  echo $k["nama"] . "<br>";
  echo $k["umur"] . "<br>";
  // echo $k["alamat"] . "<br><br>";
}

?>