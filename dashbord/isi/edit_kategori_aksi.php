<?php
// koneksi database
include '../../koneksi.php';

// periksa apakah id_kategori dikirimkan dari form
if (isset($_POST['id_kategori'])) {
    // tangkap data yang dikirim dari form
    $id_kategori = $_POST['id_kategori'];
    $nm_kategori = $_POST['nm_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga_kategori = $_POST['harga_kategori'];
    // update data ke database
    $query = "UPDATE kategori SET nm_kategori='$nm_kategori', deskripsi='$deskripsi', harga_kategori='$harga_kategori' WHERE id_kategori='$id_kategori'";
    $result = mysqli_query($koneksi, $query);

    // periksa hasil query sebelum melanjutkan
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // mengalihkan halaman kembali ke tampilkategori.php
    header("location:kategori_tampil.php");
} else {
    // jika id_kategori tidak dikirimkan, berikan pesan kesalahan atau lakukan tindakan lain
    die("ID Kategori tidak dikirimkan");
}
?>