<?php
include '../koneksi.php';
include '../phpqrcode/qrlib.php';

$tempdir = "../qr/";

// Pengecekan apakah direktori tempat menyimpan QR code sudah ada
if (!file_exists($tempdir)) {
    mkdir($tempdir);
}

// Query untuk mendapatkan data dari tabel pengiriman dan barang kirim
$query = "SELECT p.id_pengiriman, p.no_resi, bk.id_barang_kirim, bk.nm_barang, bk.jml_barang
          FROM pengiriman p
          INNER JOIN barang_kirim bk ON p.id_pengiriman = bk.id_pengiriman";

$data = mysqli_query($koneksi, $query);

while ($d = mysqli_fetch_array($data)) {
    // Gabungkan informasi menjadi satu string (misalnya: id_pengiriman|no_resi|id_barang_kirim|nm_barang|jml_barang)
    $qrCodeData = $d['id_pengiriman'] . '|' . $d['no_resi'] . '|' . $d['id_barang_kirim'] . '|' . $d['nm_barang'] . '|' . $d['jml_barang'];

    // Buat nama file QR code
    $namafile = 'barangkirim_' . $d['id_barang_kirim'] . '.png';

    // Parameter untuk membuat QR code
    $quality = 'H'; // Ada 4 pilihan: L (Low), M (Medium), Q (Good), H (High)
    $ukuran = 10;   // Batasan 1 paling kecil, 10 paling besar
    $padding = 0;

    // Buat QR code dan simpan di direktori
    QRCode::png($qrCodeData, $tempdir . $namafile, $quality, $ukuran, $padding);
}
?>
