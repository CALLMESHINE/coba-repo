<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH BUMDES</title>
</head>
<body>
 
	<h2>TAMBAH BUMDES</h2>
	<br/>
	<br/>
	<form method="post" action="tambahbumdes_aksi.php">
		<table>
        <tr>			
				<td>ID</td>
				<td>
					<?php
						include '../koneksi.php';
						$result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'bumdes'");
						$row = mysqli_fetch_array($result);
						$id_bumdes = $row['AUTO_INCREMENT'];
						echo '<input type="text" name="id" value="' . $id_bumdes . '" readonly>';
					?>
				</td>
			</tr>
			<tr>
				<td>NAMA BUMDES</td>
				<td><input type="text" name="nm_bumdes" required></td>
			</tr>
            <tr>
				<td>ALAMAT</td>
				<td><textarea name="alamat" required></textarea></td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>