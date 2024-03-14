<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KECAMATAN</title>
</head>
<body>
<h2>DATA KECAMATAN</h2>
	<br/>
	<a href="tambah_kecamatan.php">TAMBAH KECAMATAN</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>KECAMATAN</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from kecamatan");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_kecamatan']; ?></td>
				<td>
					<a href="edit_kecamatan.php?id=<?php echo $d['id_kecamatan']; ?>">EDIT</a>
					<a href="hapus_kecamatan.php?id=<?php echo $d['id_kecamatan']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
