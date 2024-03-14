<!DOCTYPE html>
<html>
<head>
	<title>TAMBAH ADMIN BUMDES</title>
</head>
<body>
	<h2>DATA ADMIN BUMDES</h2>
	<br/>
	<a href="tambah_adminbumdes.php" class="custom-button">TAMBAH ADMIN BUMDES</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA</th>
			<th>NAMA BUMDES</th>
			<th>USERNAME</th>
            <th>PASSWORD</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from admin_bumdes s LEFT JOIN bumdes b ON s.id_bumdes=b.id_bumdes");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_petugas']; ?></td>
				<td><?php echo $d['nm_bumdes']; ?></td>
				<td><?php echo $d['username']; ?></td>
                <td><?php echo $d['password']; ?></td>
				<td>
					<a href="edit_adminbumdes.php?id=<?php echo $d['id_petugas']; ?>" class="custom-button">EDIT</a>
					<a href="hapus_adminbumdes.php?id=<?php echo $d['id_petugas']; ?>" class="custom-button">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
