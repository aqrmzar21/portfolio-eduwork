<?php
include "koneksi.php";

// Ambil data dari form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$stok = $_POST['stok'];
$kategori = $_POST['kategori'];

// Validasi sederhana
if (empty($nama) || empty($harga) || empty($deskripsi) || empty($stok) || empty($kategori)) {
    echo "<script>alert('❌ Semua field harus diisi!'); window.location.href='form_produk.php';</script>";
} else {
    // Query simpan
    $sql = "INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori) 
            VALUES ('$nama', '$harga', '$deskripsi', '$stok', '$kategori')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('✅ Produk berhasil ditambahkan!'); window.location.href='produk.php';</script>";
    } else {
        echo "<script>alert('❌ Error: " . $koneksi->error . "'); window.location.href='form.php';</script>";
    }
}

$koneksi->close();
?>
