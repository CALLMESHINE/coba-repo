<?php
include '../../koneksi.php';
// Fungsi untuk mendapatkan ikon status kirim
session_start();
// Mendapatkan ID Petugas atau ID Bumdes dari session
$id_petugas = isset($_SESSION['id_petugas']) ? $_SESSION['id_petugas'] : null;
$id_bumdes = isset($_SESSION['id_bumdes']) ? $_SESSION['id_bumdes'] : null;

// Jika ID Petugas atau ID Bumdes tidak terdefinisi, berikan pesan atau arahkan ke halaman login
if ($id_petugas === null && $id_bumdes === null) {
    echo "ID Petugas or ID Bumdes not set in session.";
    exit;
}
function getStatusIcon($status)
{
    switch ($status) {
        case 'Packing Barang':
        case 'Penyortiran':
        case 'Pengiriman':
            return '<i class="fas fa-clock"></i>'; // Ganti dengan ikon jam yang diinginkan (gunakan Font Awesome atau ikon lainnya)
        case 'Barang Sampai':
            return '<i class="fas fa-check"></i>'; // Ganti dengan ikon centang yang diinginkan (gunakan Font Awesome atau ikon lainnya)
        default:
            return '';
    }
}

?>
<?php
// Fungsi untuk mendapatkan ikon status kirim
if (!function_exists('getStatusIcon')) {
    function getStatusIcon($status)
    {
        switch ($status) {
            case 'Packing Barang':
            case 'Penyortiran':
            case 'Pengiriman':
                return '<i class="fas fa-clock"></i>'; // Ganti dengan ikon jam yang diinginkan (gunakan Font Awesome atau ikon lainnya)
            case 'Barang Sampai':
                return '<i class="fas fa-check"></i>'; // Ganti dengan ikon centang yang diinginkan (gunakan Font Awesome atau ikon lainnya)
            default:
                return '';
        }
    }
}

// Set zona waktu
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Pengiriman</title>
  <?php
  include("head.php");
  ?>
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
              <h1>PENGIRIMAN MASUK</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">DataTables</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card"></div>
              <!-- /.card -->

              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO</th>
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
                        <th>WAKTU PACKING</th>
                        <th>WAKTU PENYORTIRAN</th>
                        <th>WAKTU PENGIRIMAN</th>
                        <th>WAKTU BARANG SAMPAI</th>
                        <th>DETAIL</th>
                        <th>Status Kirim</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../../koneksi.php';
                      $no = 1;
                      $query = "SELECT *, (b.nm_bumdes) as nama_bumdes_asal, (b2.nm_bumdes) as nama_bumdes_tujuan 
          FROM pengiriman p 
          LEFT JOIN admin_bumdes a ON p.id_petugas = a.id_petugas 
          LEFT JOIN bumdes b ON p.id_bumdes_asal = b.id_bumdes 
          LEFT JOIN bumdes b2 ON p.id_bumdes_tujuan = b2.id_bumdes 
          LEFT JOIN kurir k ON p.id_kurir = k.id_kurir
          WHERE p.id_bumdes_tujuan = '$id_bumdes'";
                      $data = mysqli_query($koneksi, $query);
                      while ($d = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $no++; ?>
                          </td>
                          <td>
                            <?php echo isset($d['nm_petugas']) ? $d['nm_petugas'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['nama_pengirim']) ? $d['nama_pengirim'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['no_hp_pengirim']) ? $d['no_hp_pengirim'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['alamat_asal']) ? $d['alamat_asal'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['id_bumdes_asal']) ? $d['nama_bumdes_asal'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['id_bumdes_tujuan']) ? $d['nama_bumdes_tujuan'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['id_kecamatan']) ? $d['id_kecamatan'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['alamat_tujuan']) ? $d['alamat_tujuan'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['nm_penerima']) ? $d['nm_penerima'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['no_hp_penerima']) ? $d['no_hp_penerima'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['status_bayar']) ? $d['status_bayar'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['id_kurir']) ? $d['nm_kurir'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['total_bayar']) ? $d['total_bayar'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['waktu_status_kirim_packing']) ? $d['waktu_status_kirim_packing'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['waktu_status_kirim_penyortiran']) ? $d['waktu_status_kirim_penyortiran'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['waktu_status_kirim_pengiriman']) ? $d['waktu_status_kirim_pengiriman'] : ''; ?>
                          </td>
                          <td>
                            <?php echo isset($d['waktu_status_barang_sampai']) ? $d['waktu_status_barang_sampai'] : ''; ?>
                          </td>
                          <td>
                            <a href="pengiriman_detail.php?id=<?php echo $d['id_pengiriman']; ?>">DETAIL</a>
                          </td>
                          <td>
                            <?php echo isset($d['status_kirim']) ? getStatusIcon($d['status_kirim']) . ' ' . $d['status_kirim'] : ''; ?>
                          </td>
                          <td>
                            <a
                              href="pengiriman_edit.php?id=<?php echo isset($d['id_pengiriman']) ? $d['id_pengiriman'] : ''; ?>"><button type="submit" class="btn btn-warning">EDIT</button></a>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <?php include("foot.php"); ?>
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
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
  <!-- Add these styles to your <head> section -->
<style>
    table {
        font-size: 9px; /* Adjust the font size as needed */
    }

    th, td {
        padding: 4px; /* Adjust the padding as needed */
    }
</style>

</body>

</html>