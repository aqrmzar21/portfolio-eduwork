<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Keranjang Belanja Anda</h2>
    <a href="tampilan_daftar.php" class="btn btn-secondary mb-3">Lanjutkan Belanja</a>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-info'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])):
        $total_harga = 0;
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['keranjang'] as $item):
                    $subtotal = $item['harga'] * $item['quantity'];
                    $total_harga += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['nama']); ?></td>
                    <td>Rp<?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rp<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total</td>
                    <td class="fw-bold">Rp<?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>
        <?php else: ?>
        <p class="text-center">Keranjang belanja Anda kosong.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>