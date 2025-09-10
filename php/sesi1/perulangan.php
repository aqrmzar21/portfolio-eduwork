<?php 

// 1| FOR 
$data = [1,2,3,4,5,6,7,8,9,10];
$arrayBuah = ["apel", "jeruk", "mangga", "pisang", "semangka"];

for ($i = 0; $i < 10; $i++) {
  echo "Ini hasil dari perulangan ke [$i] <br>  ";
}

//atau boleh seperti ini untuk array
echo "<br>";
for ($i = 1; $i <= count($data); $i++) {
  echo "$i, ";
}

// 2 |WHILE 
// $nomor = 1; 
// while ($nomor <= 10) {
//   echo "$nomor, <br>";
//   $nomor++;
// }

// 3 | DO WHILE
// $no = 1; 
// do {
//   echo "$no, <br>";
//   $no++;
// } while ($no <= 10);

// 4 | FOREACH 
foreach ($arrayBuah as $buah) {
  echo "$buah <br>";
}


?>