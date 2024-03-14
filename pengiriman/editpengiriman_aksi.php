<?php
include '../koneksi.php';
if (isset($_POST['simpan'])) {
    $id_pengiriman = $_POST['id_pengiriman'];
    $waktu_status_kirim = isset($_POST['waktu_status_kirim']) ? $_POST['waktu_status_kirim'] : null;

    // Update waktu status kirim di tabel pengiriman
    $query_update_pengiriman = "UPDATE pengiriman SET waktu_status_kirim = '$waktu_status_kirim' WHERE id_pengiriman = '$id_pengiriman'";

    if (mysqli_query($koneksi, $query_update_pengiriman)) {
        // Ambil status kirim dari tabel pengiriman
        $query_get_status_kirim = "SELECT status_kirim FROM pengiriman WHERE id_pengiriman = '$id_pengiriman'";
        $result_get_status_kirim = mysqli_query($koneksi, $query_get_status_kirim);
        $data_status_kirim = mysqli_fetch_assoc($result_get_status_kirim);

        // Update waktu status kirim di tabel barang_kirim sesuai dengan status yang sedang diubah
        $status_kirim = $data_status_kirim['status_kirim'];
$kolom_waktu_status_kirim = "waktu_status_kirim_$status_kirim";
$query_update_waktu_status_kirim_barang = "UPDATE barang_kirim SET $kolom_waktu_status_kirim = '$waktu_status_kirim' WHERE id_pengiriman = '$id_pengiriman'";

if (!mysqli_query($koneksi, $query_update_waktu_status_kirim_barang)) {
    echo "Error: " . $query_update_waktu_status_kirim_barang . "<br>" . mysqli_error($koneksi);
}

        header("location:tampil_pengiriman.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pengiriman = $_POST['id_pengiriman'];
    $id_petugas = $_POST['id_petugas'];
    $nama_pengirim = $_POST['nama_pengirim'];
    $no_hp_pengirim = $_POST['no_hp_pengirim'];
    $alamat_asal = $_POST['alamat_asal'];
    $id_bumdes_asal = $_POST['id_bumdes_asal'];
    $id_bumdes_tujuan = $_POST['id_bumdes_tujuan'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $nm_penerima = $_POST['nm_penerima'];
    $no_hp_penerima = $_POST['no_hp_penerima'];
    $status_kirim = $_POST['status_kirim'];
    $waktu_status_kirim_packing = $_POST['waktu_status_kirim_packing'];
    $waktu_status_kirim_penyortiran = $_POST['waktu_status_kirim_penyortiran'];
    $waktu_status_kirim_pengiriman = $_POST['waktu_status_kirim_pengiriman'];
    $waktu_status_barang_sampai = $_POST['waktu_status_barang_sampai'];
    $status_bayar = $_POST['status_bayar'];
    $id_kurir = $_POST['id_kurir'];
    $total_bayar = $_POST['total_bayar'];

    // Cek apakah id_petugas valid
    $checkPetugasQuery = "SELECT * FROM admin_bumdes WHERE id_petugas = '$id_petugas'";
    $petugasResult = mysqli_query($koneksi, $checkPetugasQuery);

    if (mysqli_num_rows($petugasResult) > 0) {
        $query = "UPDATE pengiriman SET 
                    id_petugas = '$id_petugas',
                    nama_pengirim = '$nama_pengirim',
                    no_hp_pengirim = '$no_hp_pengirim',
                    alamat_asal = '$alamat_asal',
                    id_bumdes_asal = '$id_bumdes_asal',
                    id_bumdes_tujuan = '$id_bumdes_tujuan',
                    alamat_tujuan = '$alamat_tujuan',
                    nm_penerima = '$nm_penerima',
                    no_hp_penerima = '$no_hp_penerima',
                    status_kirim = '$status_kirim',
                    waktu_status_kirim_packing = '$waktu_status_kirim_packing',
                    waktu_status_kirim_penyortiran = '$waktu_status_kirim_penyortiran',
                    waktu_status_kirim_pengiriman = '$waktu_status_kirim_pengiriman',
                    waktu_status_barang_sampai = '$waktu_status_barang_sampai',
                    status_bayar = '$status_bayar',
                    id_kurir = '$id_kurir',
                    total_bayar = '$total_bayar'
                WHERE id_pengiriman = '$id_pengiriman'";
                
        // }
    
        // Eksekusi query
        if (mysqli_query($koneksi, $query)) {
            header("location:tampil_pengiriman_keluar.php");
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error: Petugas not found.";
    }
    
    mysqli_close($koneksi);
    
} else {
    // Jika bukan request POST, sesuaikan dengan kebutuhan Anda
}
?>
