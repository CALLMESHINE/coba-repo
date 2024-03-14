<!DOCTYPE html>
<html>
<head>
	<title>EDIT ADMIN BUMDES</title>
</head>
<body>
	<h2>EDIT ADMIN BUMDES</h2>
	<br/>
	<a href="tampil_adminpemdesekspres.php" class="custom-button">KEMBALI</a>
	<br/>
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from admin_pemdes_ekspres where id_admin='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		    <form method="post" action="edit_adminpemdesekspres_aksi.php">
			<table>
			<tr>			
				<td>ID</td>
				<td>
				<input type="text" name="id_admin" value="<?php echo $d['id_admin']; ?>" readonly>
				</td>
			</tr>
			<tr>
				<td>NAMA ADMIN</td>
				<td>
                    <input type="text" name="nm_admin" value="<?php echo $d['nm_admin']; ?>">
				</td>
			</tr>
			<tr>
				<td>NO HANDPHONE</td>
				<td>
                    <input type="text" name="no_hp" value="<?php echo $d['no_hp']; ?>">
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