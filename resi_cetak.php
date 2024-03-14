<?php
include 'koneksi.php';

// Ambil id_pengiriman dari URL
$id_pengiriman = isset($_GET['id']) ? $_GET['id'] : '';

// Query untuk mendapatkan data pengiriman dan barang kirim menggunakan JOIN
$query_detail_pengiriman = "SELECT pengiriman.*, barang_kirim.*
                            FROM pengiriman
                            LEFT JOIN barang_kirim ON pengiriman.id_pengiriman = barang_kirim.id_pengiriman
                            WHERE pengiriman.id_pengiriman = '$id_pengiriman'";
$result_detail_pengiriman = mysqli_query($koneksi, $query_detail_pengiriman);


// Fungsi untuk menampilkan data dengan format tertentu (jika perlu)
function displayData($label, $value) {
    echo "<tr>";
    echo "<td>{$label}</td>";
    echo "<td>{$value}</td>";
    echo "</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Resi Pengiriman</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Resi Pengiriman</h2>

    <h3>Informasi Pengiriman</h3>
    <table>
        <?php if ($result_detail_pengiriman && mysqli_num_rows($result_detail_pengiriman) > 0): ?>
            <?php $data_pengiriman = mysqli_fetch_assoc($result_detail_pengiriman); ?>
            
            <?php displayData('ID Pengiriman', $data_pengiriman['id_pengiriman']); ?>
            <?php displayData('No Resi', $data_pengiriman['no_resi']); ?>
            <?php displayData('Nama Pengirim', $data_pengiriman['nama_pengirim']); ?>
            <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
        <?php else: ?>
            <tr>
                <td colspan="2">Data pengiriman tidak ditemukan.</td>
            </tr>
        <?php endif; ?>
    </table>

    <h3>Barang yang Dikirim</h3>
    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>KATEGORI</th>
            <th>NO RESI</th>
            <th>BERAT BARANG</th>
            <th>Nama Petugas</th>
            <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
        </tr>
        <?php
        // Loop untuk menampilkan data barang kirim
        mysqli_data_seek($result_detail_pengiriman, 0); // Kembalikan pointer hasil query ke awal
        while ($data_barang_kirim = mysqli_fetch_assoc($result_detail_pengiriman)) {
            echo "<tr>";
            echo "<td>{$data_barang_kirim['id_barang_kirim']}</td>";
            echo "<td>{$data_barang_kirim['nm_barang']}</td>";
            echo "<td>{$data_barang_kirim['jml_barang']}</td>";
            echo "<td>{$data_barang_kirim['id_kategori']}</td>";
            echo "<td>{$data_barang_kirim['no_resi']}</td>";
            echo "<td>{$data_barang_kirim['brt_barang']}</td>";
            echo "<td>{$data_barang_kirim['id_petugas']}</td>";
            // Tambahkan kolom-kolom lainnya sesuai kebutuhan
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function printResi() {
            window.print();
        }
    </script>
</body>
</html>
