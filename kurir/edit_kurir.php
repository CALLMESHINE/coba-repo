<!DOCTYPE html>
<html>
<head>
	<title>EDIT KURIR</title>
</head>
<body>
 
	<h2>EDIT KURIR</h2>
	<br/>
	<a href="tampilkurir.php">KEMBALI</a>
	<br/>
	<?php
	include '../koneksi.php';
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"select * from kurir where id_kurir='$id'");
	while($d = mysqli_fetch_array($data)){
		?>
		    <form method="post" action="editkurir_aksi.php">
			<table>
                 <tr>			
				<td>ID</td>
				<td>
				<input type="text" name="id_kurir" value="<?php echo $d['id_kurir']; ?>" readonly>
				</td>
			    </tr>
				<tr>
				<td>NAMA KURIR</td>
				<td>
                    <input type="text" name="nm_kurir" value="<?php echo $d['nm_kurir']; ?>">
				</td>
			</tr>
            <tr>
				<td>ALAMAT</td>
				<td>
                        <!-- Perbaikan: Menggunakan tag textarea tanpa atribut value -->
                        <textarea name="alamat"><?php echo $d['alamat']; ?></textarea>
                </td>
			</tr>
			<tr>
				<td>NO HANDPHONE</td>
				<td>
                    <input type="number" name="no_hp" value="<?php echo $d['no_hp']; ?>">
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