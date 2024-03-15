<?php
include '../../koneksi.php';

// Ambil id_pengiriman dari URL
$id_pengiriman = isset($_GET['id']) ? $_GET['id'] : '';

// Query untuk mendapatkan data pengiriman dan barang kirim menggunakan JOIN
$query_detail_pengiriman = "SELECT pengiriman.*, barang_kirim.*
                            FROM pengiriman
                            LEFT JOIN barang_kirim ON pengiriman.id_pengiriman = barang_kirim.id_pengiriman
                            WHERE pengiriman.id_pengiriman = '$id_pengiriman'";
$result_detail_pengiriman = mysqli_query($koneksi, $query_detail_pengiriman);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengiriman</title>
    <?php include("head.php"); ?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .detail-section {
            margin-top: 30px;
        }
        .button-section {
            margin-top: 20px;
        }
        table {
        font-size: 9px; /* Adjust the font size as needed */
    }

    th, td {
        padding: 4px; /* Adjust the padding as needed */
    }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <?php include("nav.php"); ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php include("sidebar.php"); ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>DETAIL PENGIRIMAN</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail Pengiriman</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Informasi Pengiriman -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pengiriman</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php if ($result_detail_pengiriman && mysqli_num_rows($result_detail_pengiriman) > 0): ?>
                                    <?php $data_pengiriman = mysqli_fetch_assoc($result_detail_pengiriman); ?>
                                  
                                    <tr>
                                        <th>No Resi</th>
                                        <td><?php echo $data_pengiriman['no_resi']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pengirim</th>
                                        <td><?php echo $data_pengiriman['nama_pengirim']; ?></td>
                                    </tr>
                                    <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2">Data pengiriman tidak ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>

                    <!-- Barang yang Dikirim -->
                    <div class="card detail-section">
                        <div class="card-header">
                            <h3 class="card-title">Barang yang Dikirim</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>KATEGORI</th>
                                    <th>NO RESI</th>
                                    <th>BERAT BARANG</th>
                                    <th>Nama Petugas</th>
                                    <th>Nama Pengirim</th>
                                    <th>No. HP Pengirim</th>
                                    <th>Alamat Asal</th>
                                    <th>Bumdes Asal</th>
                                    <th>Bumdes Tujuan</th>
                                    <th>Kecamatan</th>
                                    <th>Alamat Tujuan</th>
                                    <th>Nama Penerima</th>
                                    <th>No. HP Penerima</th>
                                    <th>Status Bayar</th>
                                    <th>Nama Kurir</th>
                                    <th>Total Bayar</th>
                                    <th>CETAK RESI</th>
                                </tr>
                                <?php
                                // Loop untuk menampilkan data barang kirim
                                mysqli_data_seek($result_detail_pengiriman, 0); // Kembalikan pointer hasil query ke awal
                                while ($data_barang_kirim = mysqli_fetch_assoc($result_detail_pengiriman)) {
                                    echo "<tr>";
                                    echo "<td>{$data_barang_kirim['nm_barang']}</td>";
                                    echo "<td>{$data_barang_kirim['jml_barang']}</td>";
                                    echo "<td>{$data_barang_kirim['id_kategori']}</td>";
                                    echo "<td>{$data_barang_kirim['no_resi']}</td>";
                                    echo "<td>{$data_barang_kirim['brt_barang']}</td>";
                                    echo "<td>{$data_barang_kirim['id_petugas']}</td>";
                                    echo "<td>";
                                    if (isset($data_barang_kirim['nama_pengirim'])) {
                                        echo $data_barang_kirim['nama_pengirim'];
                                    } else {
                                        echo 'Data tidak tersedia';
                                    }
                                    echo "</td>";
                                    echo "<td>{$data_barang_kirim['no_hp_pengirim']}</td>";
                                    echo "<td>{$data_barang_kirim['alamat_asal']}</td>";
                                    echo "<td>{$data_barang_kirim['id_bumdes_asal']}</td>";
                                    echo "<td>{$data_barang_kirim['id_bumdes_tujuan']}</td>";
                                    echo "<td>{$data_barang_kirim['id_kecamatan']}</td>";
                                    echo "<td>{$data_barang_kirim['alamat_tujuan']}</td>";
                                    echo "<td>{$data_barang_kirim['nm_penerima']}</td>";
                                    echo "<td>{$data_barang_kirim['no_hp_penerima']}</td>";
                                    echo "<td>{$data_barang_kirim['status_bayar']}</td>";
                                    echo "<td>{$data_barang_kirim['id_kurir']}</td>";
                                    echo "<td>{$data_barang_kirim['total_bayar']}</td>";
                                    echo "<td><a href='../resi_cetak.php?id={$data_barang_kirim['id_pengiriman']}' class='btn btn-success'>CETAK RESI</a></td>";
                                    // Tambahkan kolom-kolom lainnya sesuai kebutuhan
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <!-- Cetak Resi Button -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <?php include("foot.php"); ?>
        </footer>
        <!-- /.footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- /.wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    
</body>
</html>
