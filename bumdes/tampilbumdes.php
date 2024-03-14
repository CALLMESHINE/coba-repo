<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data BUMDES</title>
</head>
<body>
<h2>DATA BUMDES</h2>
	<br/>
	<a href="tambah_bumdes.php">TAMBAH BUMDES</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA BUMDES</th>
			<th>ALAMAT</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from bumdes");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_bumdes']; ?></td>
				<td><?php echo nl2br(htmlspecialchars($d['alamat'])); ?></td>
				<td>
					<a href="edit_bumdes.php?id=<?php echo $d['id_bumdes']; ?>">EDIT</a>
					<a href="hapus_bumdes.php?id=<?php echo $d['id_bumdes']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
