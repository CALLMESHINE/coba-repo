<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data kurir</title>
</head>
<body>
<h2>DATA KURIR</h2>
	<br/>
	<a href="tambah_kurir.php">TAMBAH KURIR</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NAMA KURIR</th>
			<th>ALAMAT</th>
			<th>NO HANDPHONE</th>
			<th>USERNAME</th>
			<th>PASSWORD</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from kurir");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['nm_kurir']; ?></td>
				<td><?php echo nl2br(htmlspecialchars($d['alamat'])); ?></td>
				<td><?php echo $d['no_hp']; ?></td>
				<td><?php echo $d['username']; ?></td>
				<td><?php echo $d['password']; ?></td>
				<td>
					<a href="edit_kurir.php?id=<?php echo $d['id_kurir']; ?>">EDIT</a>
					<a href="hapus_kurir.php?id=<?php echo $d['id_kurir']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>
