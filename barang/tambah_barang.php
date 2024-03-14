<!DOCTYPE html>
<html>
<head>
    <title>TAMBAH barang</title>
    <script>
        function updateBiaya() {
            // Mendapatkan nilai jml_barang
            var jmlBarang = document.getElementById('jml_barang').value;

            // Mendapatkan nilai brt_barang
            var brtBarang = document.getElementById('brt_barang').value;

            // Mendapatkan nilai id_kategori
            var idKategori = document.getElementById('id_kategori').value;

            // Mendapatkan nilai harga_kategori dari opsi yang dipilih
            var hargaKategori = document.getElementById('id_kategori').options[document.getElementById('id_kategori').selectedIndex].getAttribute('data-harga');

            // Menghitung biaya berdasarkan rumus
            var biaya = jmlBarang * brtBarang * hargaKategori;

            // Menampilkan hasil perhitungan pada input biaya
            document.getElementById('biaya').value = biaya;
        }
    </script>
</head>
<body>
    <h2>TAMBAH barang</h2>
    <br/>
    <br/>
    <form method="post" action="tambahbarang_aksi.php">
        <table>
            <tr>
                <td>ID</td>
                <td>
                    <?php
                        include '../koneksi.php';
                        $result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'barang'");
                        $row = mysqli_fetch_array($result);
                        $id_barang = $row['AUTO_INCREMENT'];
                        echo '<input type="text" name="id" value="' . $id_barang . '" readonly>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>NAMA BARANG</td>
                <td><input type="text" name="nm_barang" required></td>
            </tr>
            <tr>
                <td>JUMLAH BARANG</td>
                <td><input type="number" name="jml_barang" id="jml_barang" required oninput="updateBiaya()"></td>
            </tr>
            <tr>
                <td>KATEGORI</td>
                <td>
                    <select name="id_kategori" id="id_kategori" required onchange="updateBiaya()">
                        <?php
                        include "../koneksi.php";
                        $data = mysqli_query($koneksi, "select * from kategori");
                        while ($d = mysqli_fetch_array($data)) {
                            echo "<option value='$d[id_kategori]' data-harga='$d[harga_kategori]'> $d[nm_kategori]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
			<tr>
			<td>NO RESI</td>
				<td>
					<?php
					// Membuat nomor resi dengan kombinasi ID pengiriman dan beberapa karakter acak
					$no_resi = "PEMDES-" . $id_barang . rand(100000, 999999);
					echo '<input type="text" name="no_resi" value="' . $no_resi . '" readonly>';
					?>
				</td>
			</tr>
            <tr>
                <td>BERAT BARANG</td>
                <td><input type="number" step="0.01" name="brt_barang" id="brt_barang" required placeholder="Masukkan berat barang" oninput="updateBiaya()"></td>
            </tr>
            <tr>
                <td>BIAYA</td>
                <td><input type="number" name="biaya" id="biaya" required readonly></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>       
        </table>
    </form>
</body>
</html>
