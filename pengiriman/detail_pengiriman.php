<?php
include '../koneksi.php';

// Ambil id_pengiriman dari URL
$id_pengiriman = isset($_GET['id']) ? $_GET['id'] : '';

// Query untuk mendapatkan data pengiriman dan barang kirim menggunakan JOIN
$query_detail_pengiriman = "SELECT pengiriman.*, barang_kirim.*
                            FROM pengiriman
                            LEFT JOIN barang_kirim ON pengiriman.id_pengiriman = barang_kirim.id_pengiriman
                            WHERE pengiriman.id_pengiriman = '$id_pengiriman'";
$result_detail_pengiriman = mysqli_query($koneksi, $query_detail_pengiriman);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengiriman</title>
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
    <h2>Detail Pengiriman</h2>

    <h3>Informasi Pengiriman</h3>
    <table>
        <?php if ($result_detail_pengiriman && mysqli_num_rows($result_detail_pengiriman) > 0): ?>
            <?php $data_pengiriman = mysqli_fetch_assoc($result_detail_pengiriman); ?>
            <tr>
                <th>ID Pengiriman</th>
                <td><?php echo $data_pengiriman['id_pengiriman']; ?></td>
            </tr>
            <tr>
                <th>No Resi</th>
                <td><?php echo $data_pengiriman['no_resi']; ?></td>
            </tr>
            <tr>
                <th>Nama Pengirim</th>
                <td><?php echo $data_pengiriman['nama_pengirim']; ?></td>
            </tr>
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
            <th>Nama Pengirim</th>
            <th>No. HP Pengirim</th>
            <th>Alamat Asal</th>
            <th>Bumdes Asal</th>
            <th>Bumdes Tujuan</th>
            <th>Alamat Tujuan</th>
            <th>Nama Penerima</th>
            <th>No. HP Penerima</th>
            <th>Status Bayar</th>
            <th>Nama Kurir</th>
            <th>Total Bayar</th>
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
            echo "<td>";
                        if (isset($data_barang_kirim['nama_pengirim'])) {
                            echo $data_barang_kirim['nama_pengirim'];
                        } else {
                            echo 'Data tidak tersedia';
                        }
                        echo "</td>";
            echo "<td>{$data_barang_kirim['no_hp_pengirim']}</td>";
            echo "<td>{$data_barang_kirim['alamat_asal']}</td>";
            echo "<td>{$data_barang_kirim['id_bumdes_asal']}</td>";
            echo "<td>{$data_barang_kirim['id_bumdes_tujuan']}</td>";
            echo "<td>{$data_barang_kirim['alamat_tujuan']}</td>";
            echo "<td>{$data_barang_kirim['nm_penerima']}</td>";
            echo "<td>{$data_barang_kirim['no_hp_penerima']}</td>";
            echo "<td>{$data_barang_kirim['status_bayar']}</td>";
            echo "<td>{$data_barang_kirim['id_kurir']}</td>";
            echo "<td>{$data_barang_kirim['total_bayar']}</td>";
            // Tambahkan kolom-kolom lainnya sesuai kebutuhan
            echo "</tr>";
        }
        ?>
    </table>

    <a href="../resi_cetak.php?id=1">CETAK RESI</a>
</body>
</html>
