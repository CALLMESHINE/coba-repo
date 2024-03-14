<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH ADMIN PEMDES EKSPRES</title>
</head>
<body>
	<h2>DATA ADMIN PEMDES EKSPRES</h2>
	<br/>
	<a href="tambah_adminpemdesekspres.php" class="custom-button">TAMBAH ADMIN PEMDES EKSPRES</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA</th>
			<th>NO HANDPHONE</th>
			<th>USERNAME</th>
            <th>PASSWORD</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from admin_pemdes_ekspres");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_admin']; ?></td>
				<td><?php echo $d['no_hp']; ?></td>
				<td><?php echo $d['username']; ?></td>
                <td><?php echo $d['password']; ?></td>
				<td>
					<a href="edit_adminpemdesekspres.php?id=<?php echo $d['id_admin']; ?>" class="custom-button">EDIT</a>
					<a href="hapus_adminpemdesekspres.php?id=<?php echo $d['id_admin']; ?>" class="custom-button">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
