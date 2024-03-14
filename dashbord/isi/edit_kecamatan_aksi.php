<?php
// koneksi database
include '../../koneksi.php';

// menangkap data yang di kirim dari form
$id_kecamatan = $_POST['id_kecamatan'];
$nm_kecamatan = $_POST['nm_kecamatan'];

// update data ke database
mysqli_query($koneksi, "update kecamatan set nm_kecamatan='$nm_kecamatan' where id_kecamatan='$id_kecamatan'");

// mengalihkan halaman kembali ke index.php
header("location:kecamatan_tampil.php");

?>