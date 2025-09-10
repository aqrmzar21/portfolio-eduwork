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

// Ambil ID dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan prepared statement untuk keamanan
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Produk berhasil dihapus.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID produk tidak ditemukan.";
}

$conn->close();

header("Location: daftar_produk.php"); // Redirect kembali ke halaman daftar produk
exit;
?>