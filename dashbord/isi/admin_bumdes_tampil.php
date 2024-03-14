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
              <h1>DATA ADMIN BUMDES</h1>
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
              <div class="card">
              </div>
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <a href="admin_bumdes_tambah.php"><button type="submit" class="btn btn-primary">TAMBAH</button></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NAMA BUMDES</th>
                        <th>ALAMAT ASAL</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                        <th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../../koneksi.php';
                      $no = 1;
                      $data = mysqli_query($koneksi, "select * from admin_bumdes s LEFT JOIN bumdes b ON s.id_bumdes=b.id_bumdes");
                      while ($d = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $no++; ?>
                          </td>
                          <td>
                            <?php echo $d['nm_petugas']; ?>
                          </td>
                          <td>
                            <?php echo $d['nm_bumdes']; ?>
                          </td>
                          <td>
                            <?php echo isset($d['alamat_asal']) ? $d['alamat_asal'] : ''; ?>
                          </td>
                          <td>
                            <?php echo $d['username']; ?>
                          </td>
                          <td>
                            <?php echo $d['password']; ?>
                          </td>
                          <td>
                            <a href="admin_bumdes_edit.php?id=<?php echo $d['id_petugas']; ?>"
                              class="custom-button"><button type="submit" class="btn btn-warning">EDIT</button></a>
                            <a href="admin_bumdes_hapus.php?id=<?php echo $d['id_petugas']; ?>"
                              class="custom-button"><button type="submit" class="btn btn-danger">HAPUS</button></a>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
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
</body>

</html>