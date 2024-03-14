<?php
// koneksi database
include '../../koneksi.php';

// menangkap data yang di kirim dari form
$id_kurir = $_POST['id_kurir'];
$nm_kurir = $_POST['nm_kurir'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$username = $_POST['username'];
$password = $_POST['password'];

// update data ke database
mysqli_query($koneksi, "update kurir set nm_kurir='$nm_kurir', alamat='$alamat', no_hp='$no_hp', username='$username', password='$password' where id_kurir='$id_kurir'");

// mengalihkan halaman kembali ke index.php
header("location:kurir_tampil.php");

?>