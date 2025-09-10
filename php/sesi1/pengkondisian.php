<?php 
// buat var role
$role = "admin";

// cara ummum 
// if ($role == "admin") {
//   echo "Selamat datang admin";
// } else {
//   echo "Anda bukan admin";
// }

// SWITCH

switch ($role) {
  case "admin":
    echo "Selamat datang admin";
    break;
  case "user":
    echo "Selamat datang user";
    break;
  default:
    echo "Anda bukan admin $role";
    break;
}

// MATCH 
// $sebagai = "admin";
// $aturan = match ($sebagai) {
//   "admin" => "Anda masuk sebagai Admin",
//   "user" => "Anda masuk sebagai User",
//   default => "Anda bukan admin"
// };
// echo $aturan; 

?>