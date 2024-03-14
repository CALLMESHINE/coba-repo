<!DOCTYPE html>
<html>
<head>
	<title>EDIT KECAMATAN</title>
</head>
<body>
 
	<h2>EDIT KECAMATAN</h2>
	<br/>
	<a href="tampilkecamatan.php">KEMBALI</a>
	<br/>
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from kecamatan where id_kecamatan='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		    <form method="post" action="editkecamatan_aksi.php">
			<table>
                 <tr>			
				<td>ID</td>
				<td>
				<input type="text" name="id_kecamatan" value="<?php echo $d['id_kecamatan']; ?>" readonly>
				</td>
			    </tr>
				<tr>			
					<td>KECAMATAN</td>
					<td>
                        <input type="text" name="nm_kecamatan" value="<?php echo $d['nm_kecamatan']; ?>">
					</td>
				</tr>
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