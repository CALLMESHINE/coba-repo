<?php
include '../koneksi.php';

// Fungsi untuk mendapatkan ikon status kirim
function getStatusIcon($status)
{
    switch ($status) {
        case 'Packing Barang':
        case 'Penyortiran':
        case 'Pengiriman':
            return '<i class="fas fa-clock"></i>'; // Ganti dengan ikon jam yang diinginkan (gunakan Font Awesome atau ikon lainnya)
        case 'Barang Sampai':
            return '<i class="fas fa-check"></i>'; // Ganti dengan ikon centang yang diinginkan (gunakan Font Awesome atau ikon lainnya)
        default:
            return '';
    }
}

?>
<?php
// Fungsi untuk mendapatkan ikon status kirim
if (!function_exists('getStatusIcon')) {
    function getStatusIcon($status)
    {
        switch ($status) {
            case 'Packing Barang':
            case 'Penyortiran':
            case 'Pengiriman':
                return '<i class="fas fa-clock"></i>'; // Ganti dengan ikon jam yang diinginkan (gunakan Font Awesome atau ikon lainnya)
            case 'Barang Sampai':
                return '<i class="fas fa-check"></i>'; // Ganti dengan ikon centang yang diinginkan (gunakan Font Awesome atau ikon lainnya)
            default:
                return '';
        }
    }
}

// Set zona waktu
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengiriman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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
    <h2>Data Pengiriman</h2>
    <a href="tambah_pengiriman.php">TAMBAH PENGIRIMAN</a>
    <table>
        <tr>
            <th>NO</th>
            <th>ID</th>
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
            <th>WAKTU PACKING</th>
            <th>WAKTU PENYORTIRAN</th>
            <th>WAKTU PENGIRIMAN</th>
            <th>WAKTU BARANG SAMPAI</th>
            <th>DETAIL</th>
            <th>Status Kirim</th>
            <th>Aksi</th>
        </tr>
        <?php
        include '../koneksi.php';
        $no = 1;
        $query = "SELECT *, (b.nm_bumdes) as nama_bumdes_asal, (b2.nm_bumdes) as nama_bumdes_tujuan FROM pengiriman p LEFT JOIN admin_bumdes a ON p.id_petugas = a.id_petugas LEFT JOIN bumdes b ON p.id_bumdes_asal=b.id_bumdes LEFT JOIN bumdes b2 ON p.id_bumdes_tujuan=b2.id_bumdes LEFT JOIN kurir k ON p.id_kurir=k.id_kurir";
        $data = mysqli_query($koneksi, $query);
        while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td>
                    <?php echo $no++; ?>
                </td>
                <td>
                    <?php echo isset($d['id_pengiriman']) ? $d['id_pengiriman'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['nm_petugas']) ? $d['nm_petugas'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['nama_pengirim']) ? $d['nama_pengirim'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['no_hp_pengirim']) ? $d['no_hp_pengirim'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['alamat_asal']) ? $d['alamat_asal'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['id_bumdes_asal']) ? $d['nama_bumdes_asal'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['id_bumdes_tujuan']) ? $d['nama_bumdes_tujuan'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['alamat_tujuan']) ? $d['alamat_tujuan'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['nm_penerima']) ? $d['nm_penerima'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['no_hp_penerima']) ? $d['no_hp_penerima'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['status_bayar']) ? $d['status_bayar'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['id_kurir']) ? $d['nm_kurir'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['total_bayar']) ? $d['total_bayar'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['waktu_status_kirim_packing']) ? $d['waktu_status_kirim_packing'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['waktu_status_kirim_penyortiran']) ? $d['waktu_status_kirim_penyortiran'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['waktu_status_kirim_pengiriman']) ? $d['waktu_status_kirim_pengiriman'] : ''; ?>
                </td>
                <td>
                    <?php echo isset($d['waktu_status_barang_sampai']) ? $d['waktu_status_barang_sampai'] : ''; ?>
                </td>
                <td>
                    <a href="detail_pengiriman.php?id=<?php echo $d['id_pengiriman']; ?>">DETAIL</a>
                </td>
                <td>
                    <?php echo isset($d['status_kirim']) ? getStatusIcon($d['status_kirim']) . ' ' . $d['status_kirim'] : ''; ?>
                </td>
                <td>
                <a
                    href="edit_pengiriman.php?id=<?php echo isset($d['id_pengiriman']) ? $d['id_pengiriman'] : ''; ?>">EDIT</a>
                <a
                    href="hapus_pengiriman.php?id=<?php echo isset($d['id_pengiriman']) ? $d['id_pengiriman'] : ''; ?>">HAPUS</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

</body>

</html>