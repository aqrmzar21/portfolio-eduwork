<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Menggunakan prepared statement untuk keamanan
    $sql = "UPDATE products SET nama_produk = ?, deskripsi = ?, harga = ?, stok = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddi", $nama_produk, $deskripsi, $harga, $stok, $id);

    if ($stmt->execute()) {
        echo "Produk berhasil diperbarui.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

header("Location: daftar_produk.php"); // Redirect kembali ke halaman daftar produk
exit;
?>