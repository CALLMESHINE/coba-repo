<?php
include "header.php";
?>
<?php 
include 'koneksi.php';

$kategori_options = ""; // Inisialisasi variabel untuk menyimpan opsi kategori

$data_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

while ($row_kategori = mysqli_fetch_array($data_kategori)) {
    $kategori_options .= "<option value='{$row_kategori['id_kategori']}'>{$row_kategori['nm_kategori']}</option>";
}
?>
<div class="cek-ongkir-container">
    <h2>Cek Ongkir</h2>
    <form class="cek-ongkir-form" method="post" action="">
    <label for="brt_barang">Berat Barang (kg): </label>
    <input type="number" step="0.01" name="brt_barang" required><br>

    <label for="jml_barang">Jumlah Barang: </label>
    <input type="number" name="jml_barang" required><br>

    <!-- Perbaiki nama input menjadi "id_kategori" -->
    <label for="id_kategori">Kategori: </label>
    <select name="id_kategori">
        <?php echo $kategori_options; ?>
    </select><br>

    <input type="submit" value="Cek Ongkir">
</form>
</div>

<?php
include 'koneksi.php';
// Fungsi untuk mendapatkan harga kategori berdasarkan kriteria tertentu
function getHargaKategori($id_kategori)
{
    global $koneksi;

    // Perbaiki kolom yang digunakan dalam query SQL
    $query = "SELECT harga_kategori FROM kategori WHERE id_kategori = $id_kategori";

    try {
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            // Handle query error
            throw new Exception(mysqli_error($koneksi));
        }

        $row = mysqli_fetch_assoc($result);

        if ($row === null) {
            // Handle no result found
            throw new Exception("No data found for id_kategori: $id_kategori");
        }

        return $row['harga_kategori'];
    } catch (Exception $e) {
        // Handle exceptions
        die("Error: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $berat_barang = $_POST["brt_barang"];
    $jml_barang = $_POST["jml_barang"];
    $id_kategori = $_POST["id_kategori"];

    // Mendapatkan harga kategori dari database
    $harga_kategori = getHargaKategori($id_kategori);

    // Menghitung ongkir berdasarkan rumus (berat_barang * jml_barang * 5000) + harga_kategori
    $ongkir = ($berat_barang * $jml_barang * 5000) + $harga_kategori;
?>

    <!-- Tabel untuk menampilkan informasi -->
    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>Jenis Pengiriman</th>
                    <th>Berat Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Kategori Harga</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Reguler</td>
                    <td><?php echo $berat_barang; ?> kg</td>
                    <td><?php echo $jml_barang; ?></td>
                    <td>Rp <?php echo number_format($harga_kategori, 2, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($ongkir, 2, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
}

include "footer.php";
?>
