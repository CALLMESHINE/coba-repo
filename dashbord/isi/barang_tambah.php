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
              <div class="card-header">
                  <a href="barang_tampil.php"><button type="submit" class="btn btn-primary">DATA BARANG</button></a>
                </div>
              <!-- /.card -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">TAMBAH DATA BARANG</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="barang_tambah_aksi.php">
                  <div class="card-body">
                      <?php
                      include '../../koneksi.php';
                      $result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'barang'");
                      $row = mysqli_fetch_array($result);
                      $id_barang = $row['AUTO_INCREMENT'];
                      ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1">NAMA BARANG</label>
                      <input type="text" name="nm_barang" class="form-control" required placeholder="nama barang">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">JUMLAH BARANG</label>
                      <input type="number" name="jml_barang" id="jml_barang" class="form-control" required placeholder="jumlah barang" oninput="updateBiaya()">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">KATEGORI</label>
                      <select name="id_kategori" id="id_kategori" class="form-control" required onchange="updateBiaya()">
                        <?php
                        include "../../koneksi.php";
                        $data = mysqli_query($koneksi, "select * from kategori");
                        while ($d = mysqli_fetch_array($data)) {
                          echo "<option value='$d[id_kategori]' data-harga='$d[harga_kategori]'> $d[nm_kategori]</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">NO RESI</label>
                      <?php
                      // Membuat nomor resi dengan kombinasi ID pengiriman dan beberapa karakter acak
                      $no_resi = "PEMDES-" . $id_barang . rand(100000, 999999);
                      echo '<input type="text" name="no_resi" value="' . $no_resi . '" class="form-control" readonly>';
                      ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">BERAT BARANG</label>
                      <input type="number" step="0.01" name="brt_barang" id="brt_barang" class="form-control" required placeholder="berat barang" oninput="updateBiaya()">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">BIAYA</label>
                      <input type="number" name="biaya" id="biaya" class="form-control" required readonly>
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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      function updateBiaya() {
        // Mendapatkan nilai jml_barang
        var jmlBarang = document.getElementById('jml_barang').value;

        // Mendapatkan nilai brt_barang
        var brtBarang = document.getElementById('brt_barang').value;

        // Mendapatkan nilai id_kategori
        var idKategori = document.getElementById('id_kategori').value;

        // Mendapatkan nilai harga_kategori dari opsi yang dipilih
        var selectedOption = document.getElementById('id_kategori').options[document.getElementById('id_kategori').selectedIndex];
        var hargaKategori = parseFloat(selectedOption.getAttribute('data-harga'));

        // Menghitung biaya berdasarkan rumus
        var biaya = jmlBarang * brtBarang * hargaKategori;

        // Menampilkan hasil perhitungan pada input biaya
        document.getElementById('biaya').value = biaya.toFixed(2); // Menyertakan dua desimal
      }

      // Memanggil updateBiaya saat halaman dimuat dan ketika ada perubahan pada input yang terkait
      updateBiaya();
      document.getElementById('jml_barang').addEventListener('input', updateBiaya);
      document.getElementById('brt_barang').addEventListener('input', updateBiaya);
      document.getElementById('id_kategori').addEventListener('change', updateBiaya);
    });
  </script>
</body>

</html>

