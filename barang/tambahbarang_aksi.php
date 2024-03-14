<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$nm_barang = $_POST['nm_barang'];
$jml_barang = $_POST['jml_barang'];
$id_kategori = $_POST['id_kategori'];
$brt_barang = $_POST['brt_barang'];
$no_resi = $_POST['no_resi'];

// Mengambil harga_kategori dari tabel kategori
$query_kategori = mysqli_query($koneksi, "SELECT harga_kategori FROM kategori WHERE id_kategori = '$id_kategori'");
$data_kategori = mysqli_fetch_assoc($query_kategori);
$harga_kategori = $data_kategori['harga_kategori'];

// Menghitung biaya berdasarkan formula
$biaya = $jml_barang * $brt_barang * $harga_kategori;

// Menyimpan data ke dalam tabel barang
mysqli_query($koneksi, "INSERT INTO barang VALUES (NULL,'$nm_barang','$jml_barang', '$id_kategori', '$brt_barang', '$biaya', '$no_resi')");

// Mengalihkan halaman kembali ke tampilbarang.php
header("location:tampilbarang.php");
?>
