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
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>EDIT PENGIRIMAN</title>
	<script>
    function updateWaktu() {
        var selectedStatus = document.getElementById('status_kirim').value;
        var waktuPacking = document.getElementById('waktu_status_kirim_packing');
        var waktuPenyortiran = document.getElementById('waktu_status_kirim_penyortiran');
        var waktuPengiriman = document.getElementById('waktu_status_kirim_pengiriman');
        var waktuBarangSampai = document.getElementById('waktu_status_barang_sampai');

        // Save existing values
        var existingWaktuPacking = waktuPacking.value;
        var existingWaktuPenyortiran = waktuPenyortiran.value;
        var existingWaktuPengiriman = waktuPengiriman.value;
        var existingWaktuBarangSampai = waktuBarangSampai.value;

        // Reset waktu fields
        waktuPacking.value = existingWaktuPacking;
        waktuPenyortiran.value = existingWaktuPenyortiran;
        waktuPengiriman.value = existingWaktuPengiriman;
        waktuBarangSampai.value = existingWaktuBarangSampai;

        // Set waktu fields based on selected status
        switch (selectedStatus) {
            case 'Packing Barang':
                // Jika status sebelumnya bukan 'Packing Barang', set waktuPacking
                if (existingWaktuPacking === '') {
                    waktuPacking.value = getCurrentDateTime();
                }
                break;
            case 'Penyortiran':
                // Jika status sebelumnya bukan 'Penyortiran', set waktuPacking dan waktuPenyortiran
                if (existingWaktuPacking === '') {
                    waktuPacking.value = getCurrentDateTime();
                }
                if (existingWaktuPenyortiran === '') {
                    waktuPenyortiran.value = getCurrentDateTime();
                }
                break;
            case 'Pengiriman':
                // Jika status sebelumnya bukan 'Pengiriman', set waktuPacking, waktuPenyortiran, dan waktuPengiriman
                if (existingWaktuPacking === '') {
                    waktuPacking.value = getCurrentDateTime();
                }
                if (existingWaktuPenyortiran === '') {
                    waktuPenyortiran.value = getCurrentDateTime();
                }
                if (existingWaktuPengiriman === '') {
                    waktuPengiriman.value = getCurrentDateTime();
                }
                break;
            case 'Barang Sampai':
                // Jika status sebelumnya bukan 'Barang Sampai', set semua waktu
                if (existingWaktuPacking === '') {
                    waktuPacking.value = getCurrentDateTime();
                }
                if (existingWaktuPenyortiran === '') {
                    waktuPenyortiran.value = getCurrentDateTime();
                }
                if (existingWaktuPengiriman === '') {
                    waktuPengiriman.value = getCurrentDateTime();
                }
                if (existingWaktuBarangSampai === '') {
                    waktuBarangSampai.value = getCurrentDateTime();
                }
                break;
            default:
                break;
        }
    }

    function getCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth() + 1).toString().padStart(2, '0');
        var day = now.getDate().toString().padStart(2, '0');
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');

        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    // Call updateWaktu() initially to set the correct values based on the selected status
    updateWaktu();
</script>



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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<style>
		.status-icon {
			margin-right: 5px;
		}
	</style>
</head>

<body>
	<?php
	date_default_timezone_set('Asia/Bangkok');
	?>
	<h2>EDIT PENGIRIMAN</h2>
	<br />
	<a href="tampil_pengiriman.php">KEMBALI</a>
	<br />
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi, "select * from pengiriman where id_pengiriman='$id'");
	while ($d = mysqli_fetch_array($data)) {
		?>
		<form method="post" action="editpengiriman_aksi.php">
			<table>
				<tr>
					<td>ID</td>
					<td>
						<input type="text" name="id_pengiriman" value="<?php echo $d['id_pengiriman']; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>NAMA PETUGAS</td>
					<td>
						<select name="id_petugas" id="id_petugas" required>
							<?php
							$data_petugas = mysqli_query($koneksi, "SELECT * FROM admin_bumdes");
							while ($d_petugas = mysqli_fetch_array($data_petugas)) {
								$selected = ($d['id_petugas'] == $d_petugas['id_petugas']) ? 'selected' : '';
								echo "<option value='{$d_petugas['id_petugas']}' $selected> {$d_petugas['nm_petugas']}</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>NAMA PENGIRIM</td>
					<td><input type="text" name="nama_pengirim" value="<?php echo $d['nama_pengirim']; ?>"></td>
				</tr>
				<tr>
					<td>NO HP PENGIRIM</td>
					<td><input type="number" name="no_hp_pengirim" value="<?php echo $d['no_hp_pengirim']; ?>"></td>
				</tr>
				<tr>
					<td>ALAMAT ASAL</td>
					<td><textarea class="form-select" name="alamat_asal"><?php echo $d['alamat_asal']; ?></textarea></td>
				</tr>
				<tr>
					<td>BUMDES ASAL</td>
					<td>
						<select name="id_bumdes_asal" id="id_bumdes_asal" required>
							<?php
							$data_bumdes_asal = mysqli_query($koneksi, "SELECT * FROM bumdes");
							while ($d_bumdes_asal = mysqli_fetch_array($data_bumdes_asal)) {
								$selected = ($d['id_bumdes_asal'] == $d_bumdes_asal['id_bumdes']) ? 'selected' : '';
								echo "<option value='{$d_bumdes_asal['id_bumdes']}' $selected> {$d_bumdes_asal['nm_bumdes']}</option>";
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
								$selected = ($d['id_bumdes_tujuan'] == $d_bumdes_tujuan['id_bumdes']) ? 'selected' : '';
								echo "<option value='{$d_bumdes_tujuan['id_bumdes']}' $selected> {$d_bumdes_tujuan['nm_bumdes']}</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>ALAMAT TUJUAN</td>
					<td><textarea name="alamat_tujuan"><?php echo $d['alamat_tujuan']; ?></textarea></td>
				</tr>
				<tr>
					<td>NAMA PENERIMA</td>
					<td><input type="text" name="nm_penerima" value="<?php echo $d['nm_penerima']; ?>"></td>
				</tr>
				<tr>
					<td>NO HP PENERIMA</td>
					<td><input type="number" name="no_hp_penerima" value="<?php echo $d['no_hp_penerima']; ?>"></td>
				</tr>
				<tr>
					<td>STATUS KIRIM</td>
					<td>
					<select name="status_kirim" id="status_kirim" required onchange="updateWaktu()">
            <option value="Packing Barang" <?php echo ($d['status_kirim'] == 'Packing Barang') ? 'selected' : ''; ?>>
                Packing Barang<span class="status-icon">
                    <?php echo getStatusIcon('Packing Barang'); ?>
                </span></option>
            <option value="Penyortiran" <?php echo ($d['status_kirim'] == 'Penyortiran') ? 'selected' : ''; ?>>
                Penyortiran<span class="status-icon">
                    <?php echo getStatusIcon('Penyortiran'); ?>
                </span></option>
            <option value="Pengiriman" <?php echo ($d['status_kirim'] == 'Pengiriman') ? 'selected' : ''; ?>>
                Pengiriman<span class="status-icon">
                    <?php echo getStatusIcon('Pengiriman'); ?>
                </span></option>
            <option value="Barang Sampai" <?php echo ($d['status_kirim'] == 'Barang Sampai') ? 'selected' : ''; ?>>
                Barang Sampai<span class="status-icon">
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
						$waktuPacking = !empty($d['waktu_status_kirim_packing']) ? $d['waktu_status_kirim_packing'] : date('Y-m-d\TH:i:s');
						?>
						<input type="datetime-local" name="waktu_status_kirim_packing" id="waktu_status_kirim_packing" value="<?php echo $waktuPacking; ?>" required readonly>
					</td>
				</tr>
				<tr>
					<td>WAKTU PENYORTIRAN</td>
					<td>
						<?php
						// Cek apakah waktu penyortiran sudah ada
						$waktuPenyortiran = !empty($d['waktu_status_kirim_penyortiran']) ? $d['waktu_status_kirim_penyortiran'] : '';
						?>
						<input type="datetime-local" name="waktu_status_kirim_penyortiran" id="waktu_status_kirim_penyortiran" value="<?php echo $waktuPenyortiran; ?>" required readonly>
					</td>
				</tr>
				<tr>
					<td>WAKTU PENGIRIMAN</td>
					<td>
						<?php
						// Cek apakah waktu pengiriman sudah ada
						$waktuPengiriman = !empty($d['waktu_status_kirim_pengiriman']) ? $d['waktu_status_kirim_pengiriman'] : '';
						?>
						<input type="datetime-local" name="waktu_status_kirim_pengiriman" id="waktu_status_kirim_pengiriman" value="<?php echo $waktuPengiriman; ?>" required readonly>
					</td>
				</tr>
				<tr>
					<td>WAKTU BARANG SAMPAI</td>
					<td>
						<?php
						// Cek apakah waktu barang sampai sudah ada
						$waktuBarangSampai = !empty($d['waktu_status_barang_sampai']) ? $d['waktu_status_barang_sampai'] : '';
						?>
						<input type="datetime-local" name="waktu_status_barang_sampai" id="waktu_status_barang_sampai" value="<?php echo $waktuBarangSampai; ?>" required readonly>
					</td>
				</tr>

				<tr>
					<td>STATUS BAYAR</td>
					<td>
						<?php
						// Jika status bayar sudah "lunas", maka nonaktifkan dropdown
						$isLunas = ($d['status_bayar'] == 'lunas');
						if($isLunas){
						?>
						<select name="status_bayar" id="status_bayar"  required>
							<option value="lunas">LUNAS
							</option>
						</select>
						<?php 
						}else{
							?>
							<select name="status_bayar" id="status_bayar"  required>
								<option value="lunas">LUNAS
								</option>
								<option value="bayar_ditempat" <?php echo !$isLunas ? 'selected' : ''; ?>>bayar ditempat
								</option>
							</select>
						<?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td>NAMA KURIR</td>
					<td>
						<select name="id_kurir" id="id_kurir" required>
							<?php
							$data_kurir = mysqli_query($koneksi, "SELECT * FROM kurir");
							while ($d_kurir = mysqli_fetch_array($data_kurir)) {
								$selected = ($d['id_kurir'] == $d_kurir['id_kurir']) ? 'selected' : '';
								echo "<option value='{$d_kurir['id_kurir']}' $selected> {$d_kurir['nm_kurir']}</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>TOTAL BAYAR</td>
					<td><input type="number" name="total_bayar" value="<?php echo $d['total_bayar']; ?>"></td>
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