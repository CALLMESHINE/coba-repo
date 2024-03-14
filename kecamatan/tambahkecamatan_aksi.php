<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nm_kecamatan = $_POST['nm_kecamatan'];
// menginput data ke database
mysqli_query($koneksi,"insert into kecamatan values(NULL,'$nm_kecamatan')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampilkecamatan.php");
 
?>