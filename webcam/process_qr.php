<?php
// Lakukan koneksi ke database sesuai kebutuhan
include '../koneksi.php';

// Pengecekan apakah qrCodeData tersedia di $_POST
if (isset($_POST['qrCodeData'])) {
    // Terima data QR Code dari JavaScript
    $qrCodeData = $_POST['qrCodeData'];

    // Pisahkan data QR Code
    $qrCodeParts = explode("|", $qrCodeData);

    // Pastikan bahwa ada dua bagian yang diharapkan
    if (count($qrCodeParts) == 2) {
        $id_pengiriman = $qrCodeParts[0];
        $id_barang = $qrCodeParts[1];

        // Ambil data barang dari tabel barang_kirim dan pengiriman
        $query = "SELECT bk.*, p.nama_pengirim, p.alamat_tujuan, p.status_kirim
                  FROM barang_kirim bk
                  INNER JOIN pengiriman p ON bk.id_pengiriman = p.id_pengiriman
                  WHERE bk.id_pengiriman = '$id_pengiriman' AND bk.id_barang_kirim = '$id_barang'";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $data_barang = mysqli_fetch_assoc($result);

            // Tampilkan data barang
            echo "<h2>Detail Barang</h2>";
            echo "<p>ID Barang Kirim: " . $data_barang['id_barang_kirim'] . "</p>";
            echo "<p>Nama Barang: " . $data_barang['nm_barang'] . "</p>";
            echo "<p>Jumlah Barang: " . $data_barang['jml_barang'] . "</p>";
            echo "<p>Berat Barang: " . $data_barang['brt_barang'] . "</p>";

            // Tampilkan data pengiriman
            echo "<h2>Detail Pengiriman</h2>";
            echo "<p>Nama Pengirim: " . $data_barang['nama_pengirim'] . "</p>";
            echo "<p>Alamat Tujuan: " . $data_barang['alamat_tujuan'] . "</p>";
            echo "<p>Status Kirim: " . $data_barang['status_kirim'] . "</p>";

            // Tampilkan formulir untuk mengubah status kirim
            echo "<h2>Edit Status Kirim</h2>";
            echo "<form action='update_status_kirim.php' method='post'>";
            echo "<input type='hidden' name='id_pengiriman' value='" . $id_pengiriman . "'>";
            echo "<input type='hidden' name='id_barang_kirim' value='" . $id_barang . "'>";
            echo "<label for='status_kirim'>Status Kirim:</label>";
            echo "<select name='status_kirim' id='status_kirim' required>";
            echo "<option value='Packing Barang'>Packing Barang</option>";
            echo "<option value='Penyortiran'>Penyortiran</option>";
            echo "<option value='Pengiriman'>Pengiriman</option>";
            echo "<option value='Barang Sampai'>Barang Sampai</option>";
            echo "</select>";
            echo "<br>";
            echo "<input type='submit' value='Update Status Kirim'>";
            echo "</form>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Error: Format QR Code tidak valid.";
    }
} else {
    echo "Error: Data QR Code tidak ditemukan di request.";
}
?>
