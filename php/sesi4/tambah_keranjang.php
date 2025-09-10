<?php
session_start();
// Koneksi ke database
include 'konfigurasi_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Ambil data produk dari database untuk validasi stok
    $sql_product = "SELECT stok FROM product WHERE id = ?";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param("i", $product_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $product_data = $result_product->fetch_assoc();

    if ($product_data && $product_data['stok'] >= $quantity) {
        // Logika keranjang
        if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = [];
        }

        if (array_key_exists($product_id, $_SESSION['keranjang'])) {
            // Jika produk sudah ada, tambahkan kuantitas
            $_SESSION['keranjang'][$product_id]['quantity'] += $quantity;
        } else {
            // Jika produk belum ada, tambahkan ke keranjang
            $_SESSION['keranjang'][$product_id] = [
                'id' => $product_id,
                'nama' => $_POST['nama_produk'],
                'harga' => $_POST['harga'],
                'quantity' => $quantity
            ];
        }

        // KURANGI STOK PRODUK DI DATABASE
        $stok_baru = $product_data['stok'] - $quantity;
        $sql_update_stok = "UPDATE product SET stok = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update_stok);
        $stmt_update->bind_param("ii", $stok_baru, $product_id);
        $stmt_update->execute();
        $stmt_update->close();

        $_SESSION['message'] = "Produk berhasil ditambahkan ke keranjang!";
    } else {
        $_SESSION['message'] = "Stok tidak mencukupi atau produk tidak ditemukan.";
    }

    $stmt_product->close();
}

$conn->close();

header("Location: tampilan_daftar.php");
exit;
?>