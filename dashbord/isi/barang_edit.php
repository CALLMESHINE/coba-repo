<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BARANG</title>
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
              <h1>DataTables</h1>
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
            <div class="col-6">
              <div class="card">
              </div>
              <!-- /.card -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">EDIT DATA BARANG</h3>
                </div>
                <?php
                include("../../koneksi.php");

                // Mendapatkan nilai ID dari parameter URL
                $id = $_GET['id'];

                // Query SQL untuk mendapatkan data barang berdasarkan ID
                $sql = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id'");

                // Periksa apakah query berhasil dijalankan
                if ($sql) {
                  // Ambil data barang
                  $d = mysqli_fetch_array($sql);

                  // Lanjutkan dengan menampilkan atau menggunakan data sesuai kebutuhan
                  // Contoh: Tampilkan nama barang
                } else {
                  // Jika query gagal, tampilkan pesan kesalahan
                  echo "Error: " . mysqli_error($koneksi);
                }
                ?>

                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="edit_barang_aksi.php">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="exampleInputEmail1">NAMA BARANG</label>
                      <input type="text" name="nm_barang" class="form-control" value="<?php echo $d['nm_barang']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">JUMLAH BARANG</label>
                      <input type="number" name="jml_barang" class="form-control" value="<?php echo $d['jml_barang']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">KATEGORI</label>
                      <select name="id_kategori" id="id_kategori" class="form-control" required>
                        <?php
                        $data_kategori = mysqli_query($koneksi, "select * from kategori");
                        while ($data_kat = mysqli_fetch_array($data_kategori)) {
                          $selected = ($data_kat['id_kategori'] == $d['id_kategori']) ? 'selected' : '';
                          echo "<option value='{$data_kat['id_kategori']}' {$selected}>{$data_kat['nm_kategori']}</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">NO RESI</label>
                      <input type="text" name="no_resi"  value="<?php echo "PEMDES" . $d['id_barang'] . rand(100000, 999999); ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">BERAT BARANG</label>
                      <input type="number" class="form-control name="brt_barang" id="brt_barang" value="<?php echo $d['brt_barang']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">BIAYA</label>
                      <input type="number" class="form-control name="biaya" value="<?php echo $d['biaya']; ?>">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>

              <div class="card-header">

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
</body>

</html>
