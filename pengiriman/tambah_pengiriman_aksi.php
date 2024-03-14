<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id_petugas = isset($_POST['id_putugas']) ? $_POST['id_putugas'] : null;
$nama_pengirim = isset($_POST['nama_pengirim']) ? $_POST['nama_pengirim'] : null;
$no_hp_pengirim = isset($_POST['no_hp_pengiriman']) ? $_POST['no_hp_pengiriman'] : null;
$alamat_asal = isset($_POST['alamat_asal']) ? $_POST['alamat_asal'] : null;
$id_bumdes_asal = isset($_POST['id_bumdes_asal']) ? $_POST['id_bumdes_asal'] : null;
$id_bumdes_tujuan = isset($_POST['id_bumdes_tujuan']) ? $_POST['id_bumdes_tujuan'] : null;
$alamat_tujuan = isset($_POST['alamat_tujuan']) ? $_POST['alamat_tujuan'] : null;
$nm_penerima = isset($_POST['nm_penerima']) ? $_POST['nm_penerima'] : null;
$no_hp_penerima = isset($_POST['no_hp_penerima']) ? $_POST['no_hp_penerima'] : null;
$status_kirim = isset($_POST['status_kirim']) ? $_POST['status_kirim'] : null;
$status_bayar = isset($_POST['status_bayar']) ? $_POST['status_bayar'] : null;
$waktu_status_kirim_packing = isset($_POST['waktu_status_kirim_packing']) ? $_POST['waktu_status_kirim_packing'] : null;
$waktu_status_kirim_penyortiran = isset($_POST['waktu_status_kirim_penyortiran']) ? $_POST['waktu_status_kirim_penyortiran'] : null;
$waktu_status_kirim_pengiriman = isset($_POST['waktu_status_kirim_pengiriman']) ? $_POST['waktu_status_kirim_pengiriman'] : null;
$waktu_status_barang_sampai = isset($_POST['waktu_status_barang_sampai']) ? $_POST['waktu_status_barang_sampai'] : null;
$id_kurir = isset($_POST['id_kurir']) ? $_POST['id_kurir'] : null;
$total_bayar = isset($_POST['total_bayar']) ? $_POST['total_bayar'] : null;

// Mengecek apakah data yang dibutuhkan sudah diisi
if ($id_petugas !== null && $no_hp_pengirim !== null) {
    // Menginput data ke database
    $query = "INSERT INTO pengiriman (id_petugas, nama_pengirim, no_hp_pengirim, alamat_asal, id_bumdes_asal, id_bumdes_tujuan, alamat_tujuan, nm_penerima, no_hp_penerima, status_kirim, status_bayar, id_kurir, total_bayar, waktu_status_kirim_packing, waktu_status_kirim_penyortiran, waktu_status_kirim_pengiriman, waktu_status_barang_sampai) 
    VALUES ('$id_petugas', '$nama_pengirim', '$no_hp_pengirim', '$alamat_asal', '$id_bumdes_asal', '$id_bumdes_tujuan', '$alamat_tujuan', '$nm_penerima', '$no_hp_penerima', '$status_kirim', '$status_bayar', '$id_kurir', '$total_bayar', '$waktu_status_kirim_packing', '$waktu_status_kirim_penyortiran', '$waktu_status_kirim_pengiriman', '$waktu_status_barang_sampai')";

    if (mysqli_query($koneksi, $query)) {
        // Mendapatkan daftar barang yang dicentang
        $barang_checked = isset($_POST['barang']) ? $_POST['barang'] : [];

        // Mendapatkan id_pengiriman dari data yang baru saja diinsert
        $id_pengiriman = mysqli_insert_id($koneksi);

        // Menambahkan barang ke tabel barang_kirim dan menghapus dari tabel barang
        foreach ($barang_checked as $id_barang) {
            // Ambil data barang
            $query_get_barang = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
            $result_get_barang = mysqli_query($koneksi, $query_get_barang);
            $data_barang = mysqli_fetch_assoc($result_get_barang);
        
            // Query untuk memasukkan ke tabel barang_kirim
            $query_barang_kirim = "INSERT INTO barang_kirim (nm_barang, jml_barang, id_kategori, brt_barang, id_pengiriman, no_resi) 
                VALUES ('{$data_barang['nm_barang']}', '{$data_barang['jml_barang']}', '{$data_barang['id_kategori']}', '{$data_barang['brt_barang']}', '$id_pengiriman', '{$data_barang['no_resi']}')";
        
            // Query untuk menghapus dari tabel barang
            $query_delete_barang = "DELETE FROM barang WHERE id_barang = '$id_barang'";
        
            // Eksekusi query barang_kirim
            if (!mysqli_query($koneksi, $query_barang_kirim) || !mysqli_query($koneksi, $query_delete_barang)) {
                echo "Error: " . $query_barang_kirim . "<br>" . mysqli_error($koneksi);
            }
            
        }
        
        // Mengalihkan halaman kembali ke tampil_pengiriman.php
        header("location:tampil_pengiriman_keluar.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Data belum lengkap, pastikan semua data terisi.";
}
?>
