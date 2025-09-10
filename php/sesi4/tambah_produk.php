<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Link Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            border: 1px solid #e0e0e0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        textarea,
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Penting untuk padding dan border tidak menambah lebar */
            font-size: 16px;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #28a745; /* Warna hijau */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 12px;
            cursor: pointer;
            border-radius: 4px;
            background-color: #f8f9fa;
            width: 100%;
            text-align: center;
        }
        .custom-file-upload:hover {
            background-color: #e2e6ea;
        }
        .file-name {
            margin-top: 10px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="daftar_produk.php" class="add-button"><i class="bi bi-arrow-left"></i></a>
        <h1>Tambah Produk</h1>
        <form action="proses_tambah_produk.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" required>
            </div>
            <div class="form-group">
                <label for="harga_produk">Harga Produk:</label>
                <input type="number" id="harga_produk" name="harga_produk" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk:</label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" required></textarea>
            </div>
            <div class="form-group">
                <label for="stok">Stok Produk:</label>
                <input type="number" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="gambar_produk">Upload Gambar:</label>
                <label for="gambar_produk" class="custom-file-upload">
                    Pilih File
                </label>
                <input type="file" id="gambar_produk" name="gambar_produk" style="display: none;" onchange="updateFileName(this)">
                <div id="file-name-display" class="file-name">Belum ada file yang dipilih</div>
            </div>
            <button type="submit">Tambah Produk</button>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name-display');
            if (input.files.length > 0) {
                fileNameDisplay.textContent = input.files[0].name;
            } else {
                fileNameDisplay.textContent = 'Belum ada file yang dipilih';
            }
        }
    </script>
</body>
</html>