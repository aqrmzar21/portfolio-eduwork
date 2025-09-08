<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>E-Commerce Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card { transition: transform 0.3s; }
    .product-card:hover { transform: scale(1.05); }
  </style>
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="text-center mb-4">Daftar Produk</h2>

  <!-- Filter Produk -->
  <div class="text-center mb-4">
    <a href="index.php" class="btn btn-primary me-2">Semua</a>
    <a href="index.php?kategori=elektronik" class="btn btn-outline-primary me-2">Elektronik</a>
    <a href="index.php?kategori=fashion" class="btn btn-outline-primary me-2">Fashion</a>
    <a href="index.php?kategori=aksesoris" class="btn btn-outline-primary">Aksesoris</a>
  </div>

  <div class="row g-4">
    <?php
    // Cek apakah ada filter kategori
    if (isset($_GET['kategori'])) {
        $kategori = $_GET['kategori'];
        $sql = "SELECT * FROM products WHERE kategori='$kategori'";
    } else {
        $sql = "SELECT * FROM products";
    }

    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='col-md-4'>
              <div class='card product-card shadow-sm'>
                <img src='https://picsum.photos/400/250?random={$row['id']}' class='card-img-top'>
                <div class='card-body'>
                  <h5 class='card-title'>{$row['nama_produk']}</h5>
                  <p class='card-text'>{$row['deskripsi']}</p>
                  <p class='fw-bold text-primary'>Rp " . number_format($row['harga'], 0, ',', '.') . "</p>
                  <button class='btn btn-success'>Beli</button>
                </div>
              </div>
            </div>
            ";
        }
    } else {
        echo "<p class='text-center text-danger'>Produk tidak ditemukan.</p>";
    }
    ?>
  </div>
</div>

</body>
</html>
