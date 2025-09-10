<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
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
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form action="proses_edit.php" method="post" enctype="multipart/form-data">
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
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>