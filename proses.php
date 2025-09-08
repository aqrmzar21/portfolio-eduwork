<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "ecommerce_db");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// Validasi sederhana
if (empty($nama) || empty($harga) || empty($deskripsi)) {
    echo "❌ Semua field harus diisi!";
} else {
    // Query simpan ke database
    $sql = "INSERT INTO products (nama_produk, harga, deskripsi, stok) 
            VALUES ('$nama', '$harga', '$deskripsi', 0)";
    
    if ($koneksi->query($sql) === TRUE) {
        echo "✅ Produk berhasil ditambahkan!";
        echo "<br><a href='form_produk.php'>Tambah produk lagi</a>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}

$koneksi->close();
?>
