<?php
function getStatusIcon($status)
{
	switch ($status) {
		case 'Packing Barang':
		case 'Penyortiran':
		case 'Pengiriman':
			return '<i class="fas fa-clock"></i>'; // Ganti dengan ikon jam yang diinginkan (gunakan Font Awesome atau ikon lainnya)
		case 'Barang Sampai':
			return '<i class="fas fa-check"></i>'; // Ganti dengan ikon centang yang diinginkan (gunakan Font Awesome atau ikon lainnya)
		default:
			return '';
	}
} ?>
<!DOCTYPE html>
<html>

<head>
	<title>TAMBAH PENGIRIMAN</title>
	<script>
		function updateTotalBayar() {
			var checkboxes = document.getElementsByName('barang[]');
			var totalBayar = 0;

			checkboxes.forEach(function (checkbox) {
				if (checkbox.checked) {
					// Mendapatkan biaya dari data-biaya pada checkbox
					var biaya = parseFloat(checkbox.getAttribute('data-biaya'));

					// Menambahkan biaya ke totalBayar
					totalBayar += biaya;
				}
			});

			// Menyimpan nilai totalBayar ke input total_bayar
			document.getElementById('total_bayar').value = totalBayar;
		}
	</script>
	<script>
    function updateWaktu() {
        var statusKirim = document.getElementById('status_kirim').value;

        // Get the elements for WAKTU PENYORTIRAN, WAKTU PENGIRIMAN, and WAKTU BARANG SAMPAI
        var waktuPacking = document.getElementsByName('waktu_status_kirim_packing')[0];
        var waktuPenyortiran = document.getElementsByName('waktu_status_kirim_penyortiran')[0];
        var waktuPengiriman = document.getElementsByName('waktu_status_kirim_pengiriman')[0];
        var waktuBarangSampai = document.getElementsByName('waktu_status_barang_sampai')[0];

        // Disable all date fields
        waktuPacking.disabled = true;
        waktuPenyortiran.disabled = true;
        waktuPengiriman.disabled = true;
        waktuBarangSampai.disabled = true;

        // Enable the date field based on the selected status
        if (statusKirim === 'Packing Barang') {
            waktuPacking.disabled = false;
        } else if (statusKirim === 'Penyortiran') {
            waktuPenyortiran.disabled = false;
        } else if (statusKirim === 'Pengiriman') {
            waktuPengiriman.disabled = false;
        } else if (statusKirim === 'Barang Sampai') {
            waktuBarangSampai.disabled = false;
        }
    }
</script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<style>
		.status-icon {
			margin-right: 15px;
		}
	</style>
</head>

<body>
	<?php
	date_default_timezone_set('Asia/Bangkok');
	?>
	<h2>INPUT PENGIRIMAN</h2>
	<br />
	<br />
	<form method="post" action="tambah_pengiriman_aksi.php">
		<table>
			<tr>
				<td>ID</td>
				<td>
					<?php
					include '../koneksi.php';
					$result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'pengiriman'");
					$row = mysqli_fetch_array($result);
					$id_pengiriman = $row['AUTO_INCREMENT'];
					echo '<input type="text" name="id" value="' . $id_pengiriman . '" readonly>';
					?>
				</td>
			</tr>
			<tr>
				<td>NAMA PETUGAS</td>
				<td>
					<select name="id_putugas" id="id_petugas" required>
						<?php
						$data = mysqli_query($koneksi, "SELECT * FROM admin_bumdes");
						while ($d = mysqli_fetch_array($data)) {
							echo "<option value='{$d['id_petugas']}'> {$d['nm_petugas']}</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>NAMA PENGIRIMAN</td>
				<td><input type="text" name="nama_pengirim" required></td>
			</tr>
			<tr>
				<td>NO HP PENGIRIM</td>
				<td><input type="number" name="no_hp_pengiriman" required></td>
			</tr>
			<tr>
				<td>ALAMAT ASAL</td>
				<td><textarea name="alamat_asal" required></textarea></td>
			</tr>
			<tr>
				<td>BUMDES ASAL</td>
				<td>
				<select name="id_bumdes_asal" id="id_bumdes_asal" required>
            <?php
            $user_bumdes_id = 1; // Replace this with the actual method to get the logged-in user's BUMDES ID
            $data_bumdes_asal = mysqli_query($koneksi, "SELECT * FROM bumdes");
            while ($d_bumdes_asal = mysqli_fetch_array($data_bumdes_asal)) {
                $selected = ($d_bumdes_asal['id_bumdes'] == $user_bumdes_id) ? 'selected' : '';
                echo "<option value='{$d_bumdes_asal['id_bumdes']}' {$selected}>{$d_bumdes_asal['nm_bumdes']}</option>";
            }
            ?>
        </select>
				</td>
			</tr>
			<tr>
				<td>BUMDES TUJUAN</td>
				<td>
					<select name="id_bumdes_tujuan" id="id_bumdes_tujuan" required>
						<?php
						$data_bumdes_tujuan = mysqli_query($koneksi, "SELECT * FROM bumdes");
						while ($d_bumdes_tujuan = mysqli_fetch_array($data_bumdes_tujuan)) {
							echo "<option value='{$d_bumdes_tujuan['id_bumdes']}'> {$d_bumdes_tujuan['nm_bumdes']}</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>ALAMAT TUJUAN</td>
				<td><textarea name="alamat_tujuan" required></textarea></td>
			</tr>
			<tr>
				<td>NAMA PENERIMA</td>
				<td><input type="text" name="nm_penerima" required></td>
			</tr>
			<tr>
				<td>NO HP PENERIMA</td>
				<td><input type="number" name="no_hp_penerima" required></td>
			</tr>
			<tr>
				<td>STATUS KIRIM</td>
				<td>
				<select name="status_kirim" id="status_kirim" required onchange="updateWaktu()">
						<option value="Packing Barang">Packing Barang<span class="status-icon">
								<?php echo getStatusIcon('Packing Barang'); ?>
							</span></option>
						<option value="Penyortiran">Penyortiran<span class="status-icon">
								<?php echo getStatusIcon('Penyortiran'); ?>
							</span></option>
						<option value="Pengiriman">Pengiriman<span class="status-icon">
								<?php echo getStatusIcon('Pengiriman'); ?>
							</span></option>
						<option value="Barang Sampai">Barang Sampai<span class="status-icon">
								<?php echo getStatusIcon('Barang Sampai'); ?>
							</span></option>
					</select>
				</td>

			</tr>
			<tr>
    <td>WAKTU PACKING</td>
    <td>
        <?php
        // Cek apakah waktu packing sudah ada
        $waktu_packing = !empty($d['waktu_status_kirim_packing']) ? $d['waktu_status_kirim_packing'] : date('Y-m-d\TH:i:s');
        ?>
        <input type="datetime-local" name="waktu_status_kirim_packing" value="<?php echo $waktu_packing; ?>" required readonly>
    </td>
</tr>
<tr>
    <td>WAKTU PENYORTIRAN</td>
    <td>
        <?php
        // Cek apakah waktu penyortiran sudah ada
        $waktu_penyortiran = !empty($d['waktu_status_kirim_penyortiran']) ? $d['waktu_status_kirim_penyortiran'] : '';
        ?>
        <input type="datetime-local" name="waktu_status_kirim_penyortiran" required readonly>
    </td>
</tr>
<tr>
    <td>WAKTU PENGIRIMAN</td>
    <td>
        <?php
        // Cek apakah waktu pengiriman sudah ada
        $waktu_pengiriman = !empty($d['waktu_status_kirim_pengiriman']) ? $d['waktu_status_kirim_pengiriman'] : '';
        ?>
        <input type="datetime-local" name="waktu_status_kirim_pengiriman" required readonly>
    </td>
</tr>
<tr>
    <td>WAKTU BARANG SAMPAI</td>
    <td>
        <?php
        // Cek apakah waktu barang sampai sudah ada
        $waktu_barang_sampai = !empty($d['waktu_status_barang_sampai']) ? $d['waktu_status_barang_sampai'] : '';
        ?>
        <input type="datetime-local" name="waktu_status_barang_sampai" required readonly>
    </td>
</tr>



			<tr>
				<td>STATUS BAYAR</td>
				<td>
					<?php
					// Jika status bayar sudah "lunas", maka nonaktifkan dropdown
					$isLunas = (isset($d['status_bayar']) && $d['status_bayar'] == 'lunas');
					?>
					<select name="status_bayar" id="status_bayar" required <?php echo ($isLunas) ? 'disabled' : ''; ?>>
						<option value="lunas" <?php echo ($isLunas) ? 'selected' : ''; ?>>LUNAS</option>
						<option value="bayar_ditempat" <?php echo (isset($d['status_bayar']) && $d['status_bayar'] == 'bayar_ditempat') ? 'selected' : ''; ?>>BAYAR DI TEMPAT</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>NAMA KURIR</td>
				<td>
					<select name="id_kurir" id="id_kurir" required>
						<?php
						$data = mysqli_query($koneksi, "SELECT * FROM kurir");
						while ($d = mysqli_fetch_array($data)) {
							echo "<option value='{$d['id_kurir']}'> {$d['nm_kurir']}</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>TOTAL BAYAR</td>
				<td><input type="number" name="total_bayar" id="total_bayar" required readonly></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="simpan" value="SIMPAN"></td>
			</tr>
		</table>

		<table border="1">
			<tr>
				<th>NO</th>
				<th>ID Barang</th>
				<th>Nama Barang</th>
				<th>Jumlah Barang</th>
				<th>Kategori</th>
				<th>NO RESI</th>
				<th>Berat Barang</th>
				<th>Biaya</th>
				<th>Checklist</th>
			</tr>
			<?php
			$data_barang = mysqli_query($koneksi, "select * from barang b LEFT JOIN kategori k on b.id_kategori=k.id_kategori");
			$no = 1;
			while ($d_barang = mysqli_fetch_array($data_barang)) {
				echo "<tr>";
				echo "<td>{$no}</td>";
				echo "<td>{$d_barang['id_barang']}</td>";
				echo "<td>{$d_barang['nm_barang']}</td>";
				echo "<td>{$d_barang['jml_barang']}</td>";
				echo "<td>{$d_barang['nm_kategori']}</td>";
				echo "<td>{$d_barang['no_resi']}</td>";
				echo "<td>{$d_barang['brt_barang']}</td>";
				echo "<td>{$d_barang['biaya']}</td>";
				echo "<td><input type='checkbox' name='barang[]' value='{$d_barang['id_barang']}' data-biaya='{$d_barang['biaya']}' onchange='updateTotalBayar()'></td>";
				echo "</tr>";
				$no++;
			}
			?>
		</table>
	</form>
</body>

</html>