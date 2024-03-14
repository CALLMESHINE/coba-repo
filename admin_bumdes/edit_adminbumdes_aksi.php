<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$id_petugas = $_POST['id_petugas'];
$nm_petugas = $_POST['nm_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$id_bumdes = $_POST['id_bumdes'];
 
// update data ke database
mysqli_query($koneksi,"update admin_bumdes set nm_petugas='$nm_petugas', username='$username', password='$password', id_bumdes='$id_bumdes' where id_petugas='$id_petugas'");
 
// mengalihkan halaman kembali ke index.php
header("location:tampil_adminbumdes.php");
 
?>