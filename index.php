<?php 
$nilai = 40;

if ($nilai >= 80) {
  echo "A";
} elseif ($nilai >= 70) {
  echo "B";
} elseif ($nilai >= 60) {
  echo "C";
} elseif ($nilai >= 50) {
  echo "D";
} else {
  echo "E";
}

// short ternary
$nilai = 90;
// maka akan di eksekusi $nilai >= 80
echo $nilai >= 80 ? "A" : ($nilai >= 70 ? "B" : ($nilai >= 60 ? "C" : ($nilai >= 50 ? "D" : "E")));

?>