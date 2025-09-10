<?php
// Koneksi ke database (pastikan ini sudah ada)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Direktori tempat menyimpan gambar
$target_dir = "uploads/"; 
// Pastikan folder 'uploads' ada di root proyek Anda dan memiliki izin tulis

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar_lama = $_POST['gambar_lama']; // Nama gambar lama

    $nama_file_gambar = $gambar_lama; // Defaultnya adalah gambar lama

    // Cek apakah ada file gambar baru yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        // Jika ada file baru, kita akan memprosesnya
        $file_tmp_path = $_FILES['gambar']['tmp_name'];
        $file_name = $_FILES['gambar']['name'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Buat nama file yang unik untuk menghindari konflik
        $new_file_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Cek apakah file lama ada dan bukan default, jika ada hapus
        if (!empty($gambar_lama) && file_exists($target_dir . $gambar_lama)) {
            // Pastikan gambar_lama bukan gambar default jika memang ada defaultnya
            // Anda bisa menambahkan logika di sini jika diperlukan
            unlink($target_dir . $gambar_lama); 
        }
        
        // Pindahkan file gambar yang baru ke direktori uploads
        if (move_uploaded_file($file_tmp_path, $target_file)) {
            $nama_file_gambar = $new_file_name; // Gunakan nama file baru jika berhasil diunggah
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file gambar Anda.";
            // Anda mungkin ingin keluar atau menangani error ini lebih lanjut
            // exit; 
        }
    } else if (isset($_POST['gambar_lama']) && !empty($_POST['gambar_lama'])) {
        // Jika tidak ada file baru diunggah DAN ada gambar_lama, gunakan gambar_lama
        $nama_file_gambar = $gambar_lama;
    } else {
        // Jika tidak ada gambar baru dan tidak ada gambar lama, set ke string kosong atau default
        $nama_file_gambar = ''; // Atau sesuaikan dengan kebutuhan Anda
    }

    // Update data ke database
    $sql = "UPDATE product SET nama_produk = ?, deskripsi = ?, harga = ?, stok = ?, gambar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    // // "ssddis" -> string, string, decimal, decimal, integer, string
    // $stmt->bind_param("ssddis", $nama_produk, $deskripsi, $harga, $stok, $nama_file_gambar, $id);
$stmt->bind_param("ssdssi", $nama_produk, $deskripsi, $harga, $stok, $nama_file_gambar, $id);

    if ($stmt->execute()) {
        echo "Produk berhasil diperbarui.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

// Redirect kembali ke halaman daftar produk
header("Location: daftar_produk.php"); // Redirect kembali ke halaman daftar produk

exit;
?>