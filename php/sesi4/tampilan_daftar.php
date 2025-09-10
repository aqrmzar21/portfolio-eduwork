<?php
session_start();
// Koneksi ke database
include 'konfigurasi_db.php';

// Ambil semua data produk
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- link icon  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- link css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Produk</h2>
    <a href="keranjang.php" class="btn btn-primary mb-3">Lihat Keranjang</a>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <?php if (!empty($row['gambar'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="Gambar Produk">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                            <p class="card-text text-success fw-bold">Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            <p class="card-text text-muted fs-6 text">Stok: <?php echo $row['stok']; ?></p>
                            <?php if ($row['stok'] > 0): ?>
                                <form action="tambah_keranjang.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="nama_produk" value="<?php echo htmlspecialchars($row['nama_produk']); ?>">
                                    <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
                                    <div class="d-flex align-items-center mb-2">
                                        <label for="quantity" class="me-2">Jumlah:</label>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $row['stok']; ?>" class="form-control form-control-sm me-2" style="width: 70px;">
                                        <button type="submit" class="btn btn-primary">
                                          <!-- tambahkan ikon keranjang --> <i class="bi bi-cart-plus-fill"></i>
                                          </button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-danger w-100" disabled>Stok Habis</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>Tidak ada produk yang tersedia.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>