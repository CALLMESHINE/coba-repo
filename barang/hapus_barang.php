<?php 
// koneksi database
include '../koneksi.php';

// menangkap data id yang dikirim dari URL
$id = $_GET['id'];

// Menonaktifkan constraint foreign key
mysqli_query($koneksi, 'SET foreign_key_checks = 0');

// Menghapus data terkait di tabel pengiriman
mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang IN (SELECT id_barang FROM barang WHERE id_barang='$id')");

// Menghapus data dari tabel admin_bumdes
mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");

// Menghapus data dari tabel bumdes
mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");

// Mengaktifkan kembali constraint foreign key
mysqli_query($koneksi, 'SET foreign_key_checks = 1');

// Mengalihkan halaman kembali ke tampilbumdes.php
header("location:tampilbarang.php");
exit(); // Pastikan tidak ada kode berikutnya yang dieksekusi
?>
