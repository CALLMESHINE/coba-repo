<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nm_bumdes = $_POST['nm_bumdes'];
$alamat = $_POST['alamat'];
// menginput data ke database
mysqli_query($koneksi,"insert into bumdes values(NULL,'$nm_bumdes','$alamat')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampilbumdes.php");
 
?>