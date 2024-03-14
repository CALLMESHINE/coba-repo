<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data BARANG</title>
</head>
<body>
<h2>DATA BARANG</h2>
	<br/>
	<a href="tambah_barang.php">TAMBAH BARANG</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA BARANG</th>
			<th>JUMLAH BARANG</th>
			<th>KATEGORI</th>
			<th>NO RESI</th>
			<th>BERAT BARANG</th>
			<th>BIAYA</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from barang b LEFT JOIN kategori k on b.id_kategori=k.id_kategori");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_barang']; ?></td>
				<td><?php echo $d['jml_barang']; ?></td>
				<td><?php echo $d['nm_kategori']; ?></td>
				<td><?php echo $d['no_resi']; ?></td>
				<td><?php echo $d['brt_barang']; ?></td>
				<td><?php echo $d['biaya']; ?></td>
				<td>
					<a href="edit_barang.php?id=<?php echo $d['id_barang']; ?>">EDIT</a>
					<a href="hapus_barang.php?id=<?php echo $d['id_barang']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
