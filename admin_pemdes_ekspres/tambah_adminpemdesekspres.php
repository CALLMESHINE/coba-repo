<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH ADMIN PEMDES EKSPRES</title>
</head>
<body>
 
	<h2>TAMBAH ADMIN PEMDES EKSPRES</h2>
	<br/>
	<br/>
	<form method="post" action="tambah_adminpemdesekspres_aksi.php">
		<table>
			<tr>			
				<td>ID</td>
				<td>
					<?php
						include '../koneksi.php';
						$result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'admin_pemdes_ekspres'");
						$row = mysqli_fetch_array($result);
						$id_admin = $row['AUTO_INCREMENT'];
						echo '<input type="text" name="id" value="' . $id_admin . '" readonly>';
					?>
				</td>
			</tr>
			<tr>
				<td>NAMA ADMIN</td>
				<td><input type="text" name="nm_admin" required></td>
			</tr>
			<tr>
				<td>NO HANDPHONE</td>
				<td><input type="number" name="no_hp" required></td>
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
