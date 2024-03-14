<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$id_admin= $_POST['id_admin'];
$nm_admin = $_POST['nm_admin'];
$no_hp = $_POST['no_hp'];
$username = $_POST['username'];
$password = $_POST['password'];

 
// update data ke database
mysqli_query($koneksi,"update admin_pemdes_ekspres set nm_admin='$nm_admin', no_hp='$no_hp', username='$username', password='$password' where id_admin='$id_admin'");
 
// mengalihkan halaman kembali ke index.php
header("location:tampil_adminpemdesekspres.php");
 
?>