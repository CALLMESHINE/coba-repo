<!DOCTYPE html>
<html>
<head>
    <title>EDIT bumdes</title>
</head>
<body>
 
    <h2>EDIT BARANG</h2>
    <br/>
    <a href="tampilbarang.php">KEMBALI</a>
    <br/>
    <?php
    include '../koneksi.php';
    $id = $_GET['id'];
    $data = mysqli_query($koneksi, "select * from barang where id_barang='$id'");
    while ($d = mysqli_fetch_array($data)) {
        ?>
        <form method="post" action="editbarang_aksi.php">
            <table>
                <tr>
                    <td>ID</td>
                    <td>
                        <input type="text" name="id_barang" value="<?php echo $d['id_barang']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>NAMA BARANG</td>
                    <td>
                        <input type="text" name="nm_barang" value="<?php echo $d['nm_barang']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>JUMLAH BARANG</td>
                    <td>
                        <input type="number" name="jml_barang" value="<?php echo $d['jml_barang']; ?>">
                    </td>
                </tr>
                <tr>
				<td>KATEGORI</td>
				<td>
				<select name="id_kategori" id="id_kategori" required>
					<?php
					include "../koneksi.php";
					$data = mysqli_query($koneksi, "select * from kategori");
					while ($data_kategori = mysqli_fetch_array($data)) {
						echo "<option value='$data_kategori[id_kategori]'> $data_kategori[nm_kategori]</option>";
					}
					?>
					</select>
				</td>
			    </tr>
                <tr>
                <td>
					<?php
					// Membuat nomor resi dengan kombinasi ID pengiriman dan beberapa karakter acak
					$no_resi = "PEMDES" . $id_barang . rand(100000, 999999);
					echo '<input type="text" name="no_resi" value="' . $no_resi . '" readonly>';
					?>
				</td>
                </tr>
                <tr>
                    <td>BERAT BARANG</td>
                    <td>
                        <input type="number" name="brt_barang" id="brt_barang" value="<?php echo $d['brt_barang']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>BIAYA</td>
                    <td>
                        <input type="number" name="biaya" value="<?php echo $d['biaya']; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="SIMPAN"></td>
                </tr>        
            </table>
        </form>
        <?php 
    }
    ?>
 
</body>
</html>
