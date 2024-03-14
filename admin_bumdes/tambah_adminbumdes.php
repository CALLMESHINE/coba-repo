<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH ADMIN BUMDES</title>
</head>
<body>
 
	<h2>TAMBAH ADMIN BUMDES</h2>
	<br/>
	<br/>
	<form method="post" action="tambah_adminbumdes_aksi.php">
		<table>
			<tr>			
				<td>ID</td>
				<td>
					<?php
						include '../koneksi.php';
						$result = mysqli_query($koneksi, "SHOW TABLE STATUS LIKE 'admin_bumdes'");
						$row = mysqli_fetch_array($result);
						$id_petugas = $row['Auto_increment'];
						echo '<input type="text" name="id" value="' . $id_petugas . '" readonly>';
					?>
				</td>
			</tr>
			<tr>
				<td>NAMA PETUGAS</td>
				<td><input type="text" name="nm_petugas" required></td>
			</tr>
            <tr>
				<td>BUMDES</td>
				<td>
					<select name="id_bumdes" id="id_bumdes" required>
					<?php
					$data = mysqli_query($koneksi, "SELECT * FROM bumdes");
					while ($d = mysqli_fetch_array($data)) {
						echo "<option value='{$d['id_bumdes']}'> {$d['nm_bumdes']}</option>";
					}
					?>
					</select>
				</td>
			</tr>
            <tr>
				<td>USERNAME</td>
				<td><input type="text" name="username" required></td>
			</tr>
            <tr>
				<td>PASSWORD</td>
				<td><input type="password" name="password" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>
