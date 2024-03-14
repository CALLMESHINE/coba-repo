<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nm_admin = $_POST['nm_admin'];
$no_hp = $_POST['no_hp'];
$username = $_POST['username'];
$password = $_POST['password'];
 
// menginput data ke database
mysqli_query($koneksi,"insert into admin_pemdes_ekspres values(NULL,'$nm_admin','$no_hp','$username','$password')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampil_adminpemdesekspres.php");
 
?>