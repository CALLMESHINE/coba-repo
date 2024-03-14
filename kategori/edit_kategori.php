<!DOCTYPE html>
<html>
<head>
	<title>EDIT KATEGORI</title>
</head>
<body>
 
	<h2>EDIT KATEGORI</h2>
	<br/>
	<a href="tampilkategori.php">KEMBALI</a>
	<br/>
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from kategori where id_kategori='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		    <form method="post" action="editkategori_aksi.php">
			<table>
                 <tr>			
				<td>ID</td>
					<td>
					<input type="text" name="id_kategori" value="<?php echo $d['id_kategori']; ?>" readonly>
                	</td>
			    </tr>
				<tr>			
					<td>NAMA KATEGORI</td>
					<td>
                        <input type="text" name="nm_kategori" value="<?php echo $d['nm_kategori']; ?>">
					</td>
				</tr>
                <tr>
				<td>DESKRIPSI KATEGORI</td>
				<td><textarea name="deskripsi"><?php echo $d['deskripsi']; ?></textarea></td>
			    </tr>
				<tr>			
					<td>HARGA KATEGORI</td>
					<td>
                        <input type="text" name="harga_kategori" value="<?php echo $d['harga_kategori']; ?>">
					</td>
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