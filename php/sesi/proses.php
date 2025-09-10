<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "ecommerce");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$stok = $_POST['stok'];

// Validasi sederhana
if (empty($nama) || empty($harga) || empty($deskripsi)) {
    echo "❌ Semua field harus diisi!";
} else {
    // Query simpan ke database
    $sql = "INSERT INTO products (nama_produk, harga, deskripsi, stok) 
            VALUES ('$nama', '$harga', '$deskripsi', '$stok')";
    
    if ($koneksi->query($sql) === TRUE) {
        // Ambil data terakhir yang baru disimpan
        $last_id = $koneksi->insert_id;
        $result = $koneksi->query("SELECT * FROM products WHERE id = $last_id");
        $produk = $result->fetch_assoc();

        echo "
        <div style='width:60%; margin:20px auto; font-family:Arial;'>
            <div style='padding:15px; background:#d1e7dd; color:#0f5132; border:1px solid #badbcc; border-radius:8px;'>
                ✅ Produk berhasil ditambahkan!
            </div>
            <div style='margin-top:20px; padding:20px; border:1px solid #ccc; border-radius:8px; background:#f9f9f9;'>
                <h3>{$produk['nama_produk']}</h3>
                <p><b>Harga:</b> Rp " . number_format($produk['harga'],0,',','.') . "</p>
                <p><b>Deskripsi:</b> {$produk['deskripsi']}</p>
                <p><b>Stok:</b> {$produk['stok']}</p>
            </div>
            <br>
            <a href='form_produk.php' style='display:inline-block; padding:10px 15px; background:#0d6efd; color:#fff; text-decoration:none; border-radius:5px;'>⬅️ Kembali</a>
        </div>";
    } else {
        echo "
        <div style='padding:20px; background:#f8d7da; color:#842029; border:1px solid #f5c2c7; margin:20px; border-radius:8px;'>
            ❌ Error: " . $koneksi->error . " 
            <br><br><a href='index.php'>⬅️ Kembali</a>
        </div>";
    }
}


$koneksi->close();
?>
