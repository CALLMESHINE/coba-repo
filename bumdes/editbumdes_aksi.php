<?php
// koneksi database
include '../koneksi.php';

// periksa apakah id_kategori dikirimkan dari form
if(isset($_POST['id_bumdes'])){
    // tangkap data yang dikirim dari form
    $id_bumdes = $_POST['id_bumdes'];
    $nm_bumdes = $_POST['nm_bumdes'];
    $alamat = $_POST['alamat'];

    // update data ke database
    $query = "UPDATE bumdes SET nm_bumdes='$nm_bumdes', alamat='$alamat' WHERE id_bumdes='$id_bumdes'";
    $result = mysqli_query($koneksi, $query);

    // periksa hasil query sebelum melanjutkan
    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // mengalihkan halaman kembali ke tampilkategori.php
    header("location:tampilbumdes.php");
} else {
    // jika id_kategori tidak dikirimkan, berikan pesan kesalahan atau lakukan tindakan lain
    die("ID bumdes tidak dikirimkan");
}
?>
