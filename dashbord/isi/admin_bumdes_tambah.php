<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN BUMDES</title>
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
              <h1>DataAdminBumdes</h1>
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
                  <h3 class="card-title">TAMBAH DATA ADMIN BUMDES</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="admin_bumdes_tambah_aksi.php">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID</label>
                      <?php
                      include '../../koneksi.php';
                      $result = mysqli_query($koneksi, "SHOW TABLE STATUS LIKE 'admin_bumdes'");
                      $row = mysqli_fetch_array($result);
                      $id_petugas = $row['Auto_increment'];
                      echo '<input type="text" name="id" value="' . $id_petugas . '" readonly>';
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">NAMA PETUGAS</label>
                      <input type="text" name="nm_petugas" class="form-control" required placeholder="nama petugas">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">NAMA BUMDES</label>
                      <select name="id_bumdes" id="id_bumdes" required>
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM bumdes");
                        while ($d = mysqli_fetch_array($data)) {
                          echo "<option value='{$d['id_bumdes']}' > {$d['nm_bumdes']}</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                                            <label for="alamat_asal">ALAMAT ASAL</label>
                                            <textarea name="alamat_asal" class="form-control" required></textarea>
                                        </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">USERNAME</label>
                      <input type="text" name="username" class="form-control" required placeholder="username">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">PASSWORD</label>
                      <input type="password" name="password" class="form-control" required placeholder="password">
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