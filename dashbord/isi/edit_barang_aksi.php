<?php 
// koneksi database
include '../../koneksi.php';

// menangkap data yang di kirim dari form
$id_barang= $_POST['id_barang'];
$nm_barang = $_POST['nm_barang'];
$jml_barang = $_POST['jml_barang'];
$id_kategori = $_POST['id_kategori'];
$no_resi = $_POST['no_resi'];
$brt_barang = $_POST['brt_barang'];
$biaya = $_POST['biaya'];
 
// update data ke database
mysqli_query($koneksi,"update barang set nm_barang='$nm_barang', jml_barang='$jml_barang', id_kategori='$id_kategori', brt_barang='$brt_barang', biaya='$biaya', no_resi='$no_resi' where id_barang='$id_barang'");
 
// mengalihkan halaman kembali ke tampilbumdes.php
header("location:barang_tampil.php");
exit(); // Tambahkan baris ini untuk memastikan tidak ada kode berikutnya yang dieksekusi
?>
