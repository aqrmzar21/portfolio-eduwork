<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            border: 1px solid #e0e0e0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        textarea,
        input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Penting untuk padding dan border */
        }
        textarea {
            resize: vertical; /* Memungkinkan perubahan ukuran vertikal */
            min-height: 100px;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-weight: bold;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Produk</h1>

        <?php
        // Handle pesan sukses atau error dari proses sebelumnya
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="message success">Produk berhasil ditambahkan!</div>';
            } elseif ($_GET['status'] == 'error') {
                echo '<div class="message error">Gagal menambahkan produk. Silakan coba lagi.</div>';
            }
        }
        ?>

        <form action="proses_tambah_produk.php" method="POST">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" required>
            </div>

            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk:</label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" required></textarea>
            </div>

            <div class="form-group">
                <label for="harga_produk">Harga Produk:</label>
                <input type="number" id="harga_produk" name="harga_produk" step="0.01" required>
            </div>

            <div class="button-container">
                <button type="submit">Tambah Produk</button>
            </div>
        </form>
    </div>
</body>
</html>