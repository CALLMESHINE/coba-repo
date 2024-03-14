<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH KATEGORI</title>
</head>
<body>
 
	<h2>TAMBAH KATEGORI</h2>
	<br/>
	<br/>
	<form method="post" action="tambahkategori_aksi.php">
		<table>
        <tr>			
				<td>ID</td>
				<td>
					<?php
						include '../koneksi.php';
						$result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'kategori'");
						$row = mysqli_fetch_array($result);
						$id_kategori = $row['AUTO_INCREMENT'];
						echo '<input type="text" name="id" value="' . $id_kategori . '" readonly>';
					?>
				</td>
			</tr>
			<tr>
				<td>NAMA KATEGORI</td>
				<td><input type="text" name="nm_kategori" required></td>
			</tr>
            <tr>
				<td>DESKRIPSI KATEGORI</td>
				<td><textarea name="deskripsi" required></textarea></td>
			</tr>
			<tr>
				<td>HARGA KATEGORI</td>
				<td><input type="harga" name="harga_kategori" required></td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>