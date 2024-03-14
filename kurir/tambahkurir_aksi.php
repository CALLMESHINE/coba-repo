<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nm_kurir = $_POST['nm_kurir'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$username = $_POST['username'];
$password = $_POST['password'];
// menginput data ke database
mysqli_query($koneksi,"insert into kurir values(NULL,'$nm_kurir','$alamat','$no_hp', '$username', '$password')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampilkurir.php");
 
?>