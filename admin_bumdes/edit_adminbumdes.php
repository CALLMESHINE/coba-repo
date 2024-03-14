<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH ADMIN BUMDES</title>
</head>
<body>
	<h2>EDIT ADMIN BUMDES</h2>
	<br/>
	<a href="tampil_adminbumdes.php" class="custom-button">KEMBALI</a>
	<br/>
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from admin_bumdes where id_petugas='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		    <form method="post" action="edit_adminbumdes_aksi.php">
			<table>
			<tr>			
				<td>ID</td>
				<td>
				<input type="text" name="id_petugas" value="<?php echo $d['id_petugas']; ?>" readonly>
				</td>
			</tr>
			<tr>
				<td>NAMA PETUGAS</td>
				<td>
                    <input type="text" name="nm_petugas" value="<?php echo $d['nm_petugas']; ?>">
				</td>
			</tr>
            <tr>
				<td>BUMDES</td>
				<td>
				<select name="id_bumdes" id="id_bumdes" required>
					<?php
					include "../koneksi.php";
					$data_bumdes = mysqli_query($koneksi, "select * from bumdes");
					while ($tampil_data = mysqli_fetch_array($data_bumdes)) {
						echo "<option value='$tampil_data[id_bumdes]'> $tampil_data[nm_bumdes]</option>";
					}
					?>
					</select>
				</td>
			</tr>
            <tr>
					<td>USERNAME</td>
					<td><input type="text" name="username" value="<?php echo $d['username']; ?>"></td>
				</tr>
				<tr>
					<td>PASSWORD</td>
					<td><input type="password" name="password" value="<?php echo $d['password']; ?>"></td>
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