<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARANG KIRIM</title>
</head>

<body>
    <h2>BARANG KIRIM</h2>
    <br />
    <a href="tambah_barang.php">Tambah Barang</a>
    <br />
    <br />
    <table border="1">
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>JUMLAH BARANG</th>
            <th>KATEGORI</th>
            <th>NO RESI</th>
            <th>BERAT BARANG</th>
            <th>NAMA PETUGAS</th>
            <th>AKSI</th>
        </tr>
        <?php
include '../koneksi.php';
$no = 1;
$data = mysqli_query($koneksi, "SELECT 
    p.id_pengiriman, 
    b.id_barang_kirim, 
    b.nm_barang, 
    b.jml_barang, 
    b.id_kategori, 
    b.no_resi, 
    b.brt_barang, 
    b.waktu_status_kirim_packing,
    b.waktu_status_kirim_penyortiran,
    b.waktu_status_kirim_pengiriman,
    b.waktu_status_barang_sampai,
    k.nm_kategori, 
    a.nm_petugas
FROM barang_kirim b
LEFT JOIN barang k ON b.id_kategori = k.id_kategori
LEFT JOIN pengiriman p ON b.id_pengiriman = p.id_pengiriman
LEFT JOIN admin_bumdes a ON p.id_petugas = a.id_petugas;");

while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['nm_barang']; ?></td>
    <td><?php echo $d['jml_barang']; ?></td>
    <td><?php echo $d['nm_kategori']; ?></td>
    <td><?php echo $d['no_resi']; ?></td>
    <td><?php echo $d['brt_barang']; ?></td>
    <td><?php echo $d['nm_petugas']; ?></td>
    <!-- Add other columns as needed -->
</tr>
<?php
}
?>

    </table>
</body>

</html>
