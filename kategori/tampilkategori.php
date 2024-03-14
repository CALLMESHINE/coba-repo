<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
</head>
<body>
<h2>DATA KATEGORI</h2>
	<br/>
	<a href="tambah_kategori.php">TAMBAH KATEGORI</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA KATEGORI</th>
			<th>DESKRIPSI</th>
			<th>HARGA KATEGORI</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from kategori");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_kategori']; ?></td>
				<td><?php echo nl2br(htmlspecialchars($d['deskripsi'])); ?></td>
				<td><?php echo $d['harga_kategori']; ?></td>
				<td>
					<a href="edit_kategori.php?id=<?php echo $d['id_kategori']; ?>">EDIT</a>
					<a href="hapus_kategori.php?id=<?php echo $d['id_kategori']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
