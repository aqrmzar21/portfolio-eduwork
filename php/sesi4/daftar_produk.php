<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- link icon  -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 20px auto;
            border: 1px solid #e0e0e0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .product-image {
            width: 100px; /* Atur lebar gambar sesuai kebutuhan */
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 4px;
        }
        .action-buttons a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .action-buttons a:hover {
            text-decoration: underline;
        }
        .add-button {
            display: block;
            width: fit-content;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="tambah_produk.php" class="add-button">Tambah Produk Baru</a>
        <h1>Daftar Produk</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Konfigurasi Database
                include 'konfigurasi_db.php';

                // Mengambil data produk dari database
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  $no = 1; // Untuk penomoran nomor urut
                    // Menampilkan data setiap baris
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row["nama_produk"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["deskripsi"]) . "</td>";
                        echo "<td>Rp " . number_format($row["harga"], 2, ',', '.') . "</td>"; // Format Rupiah
                        echo "<td>" . $row["stok"] . "</td>";
                        echo "<td>";
                        // Menampilkan gambar jika ada
                        if (!empty($row["gambar"])) {
                            // Pastikan path gambar sesuai dengan lokasi folder uploads
                            echo '<img src="uploads/' . htmlspecialchars($row["gambar"]) . '" alt="' . htmlspecialchars($row["nama_produk"]) . '" class="product-image">';
                        } else {
                            echo "Tidak ada gambar";
                        }
                        echo "</td>";
                        echo '<td class="action-buttons">';
                        echo '<a href="edit_produk.php?id=' . $row["id"] . '"><i class="bi bi-pencil">Edit</i></a>'; // Link edit (belum dibuat)
                        echo '<a href="hapus_produk.php?id=' . $row["id"] . '" onclick="return confirm(\'Yakin ingin menghapus produk ini?\')"><i class="bi bi-trash">Hapus</i></a>'; // Link hapus (belum dibuat)
                        echo '</td>';
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7'>Belum ada produk.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>