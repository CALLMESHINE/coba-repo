<?php
include '../../koneksi.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$query = "SELECT id_kurir, nm_kurir, alamat FROM kurir WHERE nm_kurir LIKE '%$keyword%' OR alamat LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        "id" => $row['id_kurir'],
        "text" => $row['alamat']
    );
}

echo json_encode($data);
?>
