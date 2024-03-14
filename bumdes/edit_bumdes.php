<!DOCTYPE html>
<html>
<head>
	<title>EDIT BUMDES</title>
</head>
<body>
 
	<h2>EDIT BUMDES</h2>
	<br/>
	<a href="tampilbumdes.php">BUMDES</a>
	<br/>
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from bumdes where id_bumdes='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		    <form method="post" action="editbumdes_aksi.php">
			<table>
                 <tr>			
				<td>ID</td>
					<td>
					<input type="text" name="id_bumdes" value="<?php echo $d['id_bumdes']; ?>" readonly>
                	</td>
			    </tr>
				<tr>			
					<td>NAMA BUMDES</td>
					<td>
                        <input type="text" name="nm_bumdes" value="<?php echo $d['nm_bumdes']; ?>">
					</td>
				</tr>
                <tr>
				<td>ALAMAT</td>
				<td><textarea name="alamat"><?php echo $d['alamat']; ?></textarea></td>
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