<?php
// Konfigurasi Database
$host = 'localhost';
$username = 'root';
$password = ''; // Ganti dengan password database Anda jika ada
$database = 'ecommerce';

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok = 0; // Stok bisa diatur manual atau ditambahkan di form lain

    // Menangani upload gambar
    $target_dir = "uploads/"; // Direktori untuk menyimpan gambar
    // Pastikan direktori 'uploads' ada di root proyek Anda. Jika belum, buat folder tersebut.
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Membuat direktori jika belum ada
    }

    $nama_file_gambar = basename($_FILES["gambar_produk"]["name"]);
    $target_file = $target_dir . $nama_file_gambar;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar benar-benar gambar
    $check = getimagesize($_FILES["gambar_produk"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek jika file sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Cek ukuran file (misal: max 5MB)
    if ($_FILES["gambar_produk"]["size"] > 5000000) {
        echo "Maaf, ukuran gambar terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan format file tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Maaf, hanya format JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cek jika $uploadOk adalah 0
    if ($uploadOk == 0) {
        echo "Maaf, gambar Anda tidak terupload.";
    // Jika semuanya oke, coba upload file
    } else {
        if (move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file)) {
            // echo "Gambar ". htmlspecialchars( $nama_file_gambar ). " berhasil diupload.";

            // Simpan data ke database
            // Untuk produk, kita hanya menyimpan nama filenya saja di kolom 'gambar' jika Anda punya kolom tersebut.
            // Jika di database Anda tidak ada kolom gambar, Anda perlu menambahkannya di tabel 'products'.
            // Asumsikan ada kolom 'gambar' di tabel products.
            $sql = "INSERT INTO products (nama_produk, harga, deskripsi, stok, gambar)
                    VALUES (?, ?, ?, ?, ?)"; // Sesuaikan dengan struktur tabel Anda

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdiss", $nama_produk, $harga_produk, $deskripsi_produk, $stok, $nama_file_gambar); // 's' for string, 'd' for decimal/double, 'i' for integer

            if ($stmt->execute()) {
                echo "Produk berhasil ditambahkan!";
                // Redirect ke halaman daftar produk setelah berhasil
                header("Location: daftar_produk.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();

        } else {
            echo "Maaf, terjadi kesalahan saat mengupload gambar Anda.";
        }
    }

} else {
    // Jika bukan POST request, redirect ke halaman tambah produk
    header("Location: tambah_produk.php");
    exit();
}

$conn->close();
?>