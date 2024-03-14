<?php
// koneksi database
include '../../koneksi.php';

// menangkap data yang di kirim dari form
$nm_petugas = $_POST['nm_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_bumdes = $_POST['id_bumdes'];
$alamat_asal = $_POST['alamat_asal'];
// menginput data ke database
mysqli_query($koneksi, "insert into admin_bumdes values(NULL,'$nm_petugas','$username','$password', '$id_bumdes', '$alamat_asal')");

// mengalihkan halaman kembali ke index.php
header("location:admin_bumdes_tampil.php");

?>