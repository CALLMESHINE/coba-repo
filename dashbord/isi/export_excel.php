<?php
include '../../koneksi.php';

// Function to load PhpSpreadsheet classes manually
function loadPhpSpreadsheetClasses($class)
{
    $class = str_replace('PhpOffice\PhpSpreadsheet', '', $class);
    $file = __DIR__ . '/path/to/PhpSpreadsheet/src/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

// Register autoload function
spl_autoload_register('loadPhpSpreadsheetClasses');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Query to get shipment data
$query = "SELECT * FROM pengiriman";
$result = mysqli_query($koneksi, $query);

// Create a Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Column headers
$sheet->setCellValue('A1', 'ID Pengiriman');
$sheet->setCellValue('B1', 'Nama Pengirim');
$sheet->setCellValue('C1', 'Alamat Tujuan');
// ...Add other columns as needed...

// Data
$row = 2;
while ($data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $row, $data['id_pengiriman']);
    $sheet->setCellValue('B' . $row, $data['nama_pengirim']);
    $sheet->setCellValue('C' . $row, $data['alamat_tujuan']);
    // ...Add data for other columns as needed...
    $row++;
}

// Set the title of the spreadsheet
$spreadsheet->getActiveSheet()->setTitle('Laporan Pengiriman');

// Headers to set the appearance of the report
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_pengiriman.xlsx"');
header('Cache-Control: max-age=0');

// Export to Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>
