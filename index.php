<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Tambah Produk</title>
</head>
<body>
  <h2>Tambah Produk Baru</h2>
  <form action="proses.php" method="POST">
    <label>Nama Produk:</label><br>
    <input type="text" name="nama"><br>

    <label>Harga:</label><br>
    <input type="number" name="harga"><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"></textarea><br>

    <label>Stok:</label><br>
    <input type="number" name="stok"><br>

    <button type="submit">Simpan Produk</button>
  </form>
</body>
</html>
