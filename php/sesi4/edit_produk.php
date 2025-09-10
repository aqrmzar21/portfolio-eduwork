<?php
// Koneksi ke database (pastikan ini sudah ada)
include 'konfigurasi_db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM product WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Produk tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Gunakan min-height agar form tidak terpotong */
        }
        .container {
            background-color: #fff;
            padding: 30px; /* Tambah padding */
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Shadow lebih jelas */
            width: 450px; /* Lebar container */
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px; /* Margin bawah judul */
        }
        .form-group {
            margin-bottom: 20px; /* Margin antar grup form */
        }
        .form-group label {
            display: block;
            margin-bottom: 8px; /* Margin bawah label */
            color: #555;
            font-weight: bold; /* Label tebal */
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 10px; /* Padding input lebih besar */
            border: 1px solid #ccc;
            border-radius: 5px; /* Radius border lebih halus */
            box-sizing: border-box;
            font-size: 16px; /* Ukuran font input */
        }
        .form-group textarea {
            resize: vertical; /* Izinkan resize vertikal saja */
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px; /* Font size tombol lebih besar */
            transition: background-color 0.3s ease; /* Transisi hover */
        }
        .btn-submit:hover {
            background-color: #45a049;
        }

        /* Style untuk preview gambar */
        .image-preview-container {
            margin-top: 10px;
            text-align: center;
        }
        .image-preview {
            max-width: 100%; /* Gambar tidak akan melebihi lebar container */
            height: auto; /* Tinggi otomatis menyesuaikan */
            max-height: 200px; /* Batas tinggi maksimum preview */
            border: 1px dashed #ccc; /* Border putus-putus untuk area preview */
            border-radius: 5px;
            padding: 5px; /* Padding di dalam area preview */
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 5px;
            background-color: #f8f8f8;
            width: 100%;
            text-align: center;
            margin-top: 5px;
        }
        .custom-file-upload:hover {
            background-color: #e0e0e0;
        }
        #upload-file-button {
            display: none; /* Sembunyikan tombol upload default */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form id="editProductForm" action="proses_edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" value="<?php echo htmlspecialchars($row['nama_produk']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk:</label>
                <textarea id="deskripsi_produk" name="deskripsi" rows="5" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="harga_produk">Harga Produk:</label>
                <input type="number" id="harga_produk" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok Produk:</label>
                <input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars($row['stok']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gambar">Ubah Gambar Produk:</label>
                <label for="upload-file-button" class="custom-file-upload">
                    Pilih Gambar
                </label>
                <input type="file" id="upload-file-button" name="gambar" accept="image/*">
                <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($row['gambar']); ?>"> <div class="image-preview-container">
                    <img id="image-preview" src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Preview Gambar Produk" class="image-preview">
                </div>
            </div>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('upload-file-button');
        const imagePreview = document.getElementById('image-preview');
        const gambarLamaInput = document.querySelector('input[name="gambar_lama"]'); // Ambil input hidden gambar_lama

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Setel source gambar preview
                    imagePreview.src = e.target.result;
                    // Hapus nilai gambar_lama jika ada file baru dipilih
                    gambarLamaInput.value = ''; 
                }
                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file yang dipilih, kembalikan ke gambar lama
                // Pastikan Anda memiliki path gambar lama yang benar di sini
                imagePreview.src = 'uploads/<?php echo htmlspecialchars($row['gambar']); ?>'; 
                gambarLamaInput.value = '<?php echo htmlspecialchars($row['gambar']); ?>';
            }
        });

        // Pastikan gambar_lama di-set saat halaman pertama kali dimuat
        // jika tidak ada gambar yang dipilih sebelumnya
        if (!imagePreview.src) {
            gambarLamaInput.value = '<?php echo htmlspecialchars($row['gambar']); ?>';
        }
    </script>
</body>
</html>