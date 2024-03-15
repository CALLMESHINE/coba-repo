<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KATEGORI</title>
  <?php
  include("head.php");
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <?php include("nav.php");
      ?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php
      include("sidebar.php");
      ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Kategori</h1>
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
                  <h3 class="card-title">EDIT DATA KATEGORI</h3>
                </div>
                <?php
                include("../../koneksi.php");

                // Mendapatkan nilai ID dari parameter URL
                $id = $_GET['id'];

                // Query SQL untuk mendapatkan data BUMDes berdasarkan ID
                $sql = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id'");

                // Periksa apakah query berhasil dijalankan
                if ($sql) {
                  // Ambil data BUMDes
                  $d = mysqli_fetch_array($sql);

                  // Lanjutkan dengan menampilkan atau menggunakan data sesuai kebutuhan
                  // Contoh: Tampilkan nama BUMDes
                } else {
                  // Jika query gagal, tampilkan pesan kesalahan
                  echo "Error: " . mysqli_error($koneksi);
                }
                ?>

                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="edit_kategori_aksi.php">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">NAMA KATEGORI</label>
                      <input type="text" name="nm_kategori" class="form-control"
                        value="<?php echo $d['nm_kategori']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">DESKRIPSI</label>
                      <!-- Perbarui bagian ini untuk menampilkan nilai alamat -->
                      <textarea name="deskripsi" class="form-control"><?php echo $d['deskripsi']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">HARGA KATEGORI</label>
                      <input type="text" name="harga_kategori" class="form-control"
                        value="<?php echo $d['harga_kategori']; ?>">
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
    <?php
    include("foot.php");
    ?>
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
  <!-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> -->
</body>

</html>