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

    // 1. Ambil nama file gambar dari database
    $sql_select_gambar = "SELECT gambar FROM product WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select_gambar);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $row = $result->fetch_assoc();
    $nama_gambar = $row['gambar'];
    $stmt_select->close();

    // 2. Hapus file gambar dari folder (pastikan pathnya benar)
    $target_dir = "uploads/"; // Ganti dengan path folder Anda
    $target_file = $target_dir . $nama_gambar;

    if (!empty($nama_gambar) && file_exists($target_file)) {
        unlink($target_file); // Menghapus file
    }

    // 3. Hapus data produk dari database
    $sql_delete = "DELETE FROM product WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
        echo "Produk dan gambar terkait berhasil dihapus.";
    } else {
        echo "Error: " . $stmt_delete->error;
    }

    $stmt_delete->close();
} else {
    echo "ID produk tidak ditemukan.";
}

$conn->close();
header("Location: daftar_produk.php"); // Redirect kembali ke halaman daftar produk
exit;
?>