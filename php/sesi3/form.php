<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4">Tambah Produk Baru</h2>
  <form action="proses.php" method="POST" class="p-4 border bg-white shadow-sm rounded">
    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="elektronik">Elektronik</option>
        <option value="fashion">Fashion</option>
        <option value="aksesoris">Aksesoris</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>

</body>
</html>
