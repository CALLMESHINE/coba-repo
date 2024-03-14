<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH Kecamatan</title>
</head>
<body>
 
	<h2>TAMBAH KECAMATAN</h2>
	<br/>
	<br/>
	<form method="post" action="tambahkecamatan_aksi.php">
		<table>
        <tr>			
				<td>ID</td>
				<td>
					<?php
						include '../koneksi.php';
						$result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'kecamatan'");
						$row = mysqli_fetch_array($result);
						$id_kecamatan = $row['AUTO_INCREMENT'];
						echo '<input type="text" name="id" value="' . $id_kecamatan . '" readonly>';
					?>
				</td>
			</tr>
			<tr>
				<td>KECAMATAN</td>
				<td><input type="text" name="nm_kecamatan" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>