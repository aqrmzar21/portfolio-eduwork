<?php
session_start();
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $product_id_to_remove = $_GET['id'];

    // Cek apakah produk ada di keranjang
    if (isset($_SESSION['keranjang'][$product_id_to_remove])) {
        $quantity_to_return = $_SESSION['keranjang'][$product_id_to_remove]['quantity'];

        // Ambil stok produk saat ini dari database
        $sql_select_stok = "SELECT stok FROM product WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select_stok);
        $stmt_select->bind_param("i", $product_id_to_remove);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $row = $result->fetch_assoc();
        $stok_saat_ini = $row['stok'];
        $stmt_select->close();

        // Tambahkan kembali stok produk
        $stok_baru = $stok_saat_ini + $quantity_to_return;
        $sql_update_stok = "UPDATE product SET stok = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update_stok);
        $stmt_update->bind_param("ii", $stok_baru, $product_id_to_remove);
        $stmt_update->execute();
        $stmt_update->close();

        // Hapus produk dari sesi keranjang
        unset($_SESSION['keranjang'][$product_id_to_remove]);
        $_SESSION['message'] = "Item berhasil dihapus dari keranjang.";
    } else {
        $_SESSION['message'] = "Item tidak ditemukan di keranjang.";
    }
} else {
    $_SESSION['message'] = "ID produk tidak valid.";
}

$conn->close();

// Redirect kembali ke halaman keranjang
header("Location: keranjang.php");
exit;
?>