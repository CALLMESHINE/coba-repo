<?php
include '../../koneksi.php';
require_once __DIR__ . '/tcpdf/tcpdf.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Query untuk mendapatkan data pengiriman
$query = "SELECT * FROM pengiriman";
$result = mysqli_query($koneksi, $query);

// Buat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A1', 'ID Pengiriman');
$sheet->setCellValue('B1', 'Nama Pengirim');
$sheet->setCellValue('C1', 'Alamat Tujuan');
// ...Tambahkan kolom lain sesuai kebutuhan...

// Data
$row = 2;
while ($data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $row, $data['id_pengiriman']);
    $sheet->setCellValue('B' . $row, $data['nama_pengirim']);
    $sheet->setCellValue('C' . $row, $data['alamat_tujuan']);
    // ...Tambahkan data kolom lain sesuai kebutuhan...
    $row++;
}

// Set judul laporan
$spreadsheet->getActiveSheet()->setTitle('Laporan Pengiriman');

// Header untuk mengatur tampilan laporan
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_pengiriman.xlsx"');
header('Cache-Control: max-age=0');

// Export ke Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>
