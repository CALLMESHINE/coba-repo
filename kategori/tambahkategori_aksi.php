<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nm_kategori = $_POST['nm_kategori'];
$deskripsi = $_POST['deskripsi'];
$harga_kategori = $_POST['harga_kategori'];
// menginput data ke database
mysqli_query($koneksi,"insert into kategori values(NULL,'$nm_kategori','$deskripsi', '$harga_kategori')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampilkategori.php");
 
?>