<?php
include '../../koneksi.php';
session_start();
$id_petugas = isset($_SESSION['id_petugas']) ? $_SESSION['id_petugas'] : null;
if ($id_petugas === null) {
  // Handle case when id_petugas is not set
  echo "ID Petugas not set in session.";
  exit;
}

// Query untuk mendapatkan data admin berdasarkan id_petugas
$queryAdmin = "SELECT * FROM admin_bumdes WHERE id_petugas = ?";
$stmt = $koneksi->prepare($queryAdmin);
$stmt->bind_param("i", $id_petugas);
$stmt->execute();
$data_admin = $stmt->get_result();
$admin = $data_admin->fetch_assoc();
$stmt->close();

// Cek apakah data admin valid
if (!$admin) {
  echo "Invalid ID Petugas.";
  exit;
}

// Query untuk mendapatkan data "BUMDES ASAL"
$queryBumdesAsal = "SELECT id_bumdes FROM admin_bumdes WHERE id_petugas != ?";
$stmtBumdesAsal = $koneksi->prepare($queryBumdesAsal);
$stmtBumdesAsal->bind_param("i", $id_petugas);
$stmtBumdesAsal->execute();
$resultBumdesAsal = $stmtBumdesAsal->get_result();
$stmtBumdesAsal->close();

// Menyimpan alamat asal ke variabel $alamat_asal_default
$alamat_asal_default = isset($admin['alamat_asal']) ? $admin['alamat_asal'] : '';
$queryBumdesAsal = "SELECT * FROM admin_bumdes WHERE id_petugas = $id_petugas";
$dataBumdesAsal = mysqli_query($koneksi, $queryBumdesAsal);

// Tampilkan hasil query untuk debugging
while ($row = mysqli_fetch_assoc($dataBumdesAsal)) {

}
?>
<?php
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EDIT PENGIRIMAN</title>
  <?php include("head.php"); ?>
  <script>
    function updateWaktu() {
      var selectedStatus = document.getElementById('status_kirim').value;
      var waktuPacking = document.getElementById('waktu_status_kirim_packing');
      var waktuPenyortiran = document.getElementById('waktu_status_kirim_penyortiran');
      var waktuPengiriman = document.getElementById('waktu_status_kirim_pengiriman');
      var waktuBarangSampai = document.getElementById('waktu_status_barang_sampai');

      // Save existing values
      var existingWaktuPacking = waktuPacking.value;
      var existingWaktuPenyortiran = waktuPenyortiran.value;
      var existingWaktuPengiriman = waktuPengiriman.value;
      var existingWaktuBarangSampai = waktuBarangSampai.value;

      // Reset waktu fields
      waktuPacking.value = existingWaktuPacking;
      waktuPenyortiran.value = existingWaktuPenyortiran;
      waktuPengiriman.value = existingWaktuPengiriman;
      waktuBarangSampai.value = existingWaktuBarangSampai;

      // Set waktu fields based on selected status
      switch (selectedStatus) {
        case 'Packing Barang':
          // Jika status sebelumnya bukan 'Packing Barang', set waktuPacking
          if (existingWaktuPacking === '') {
            waktuPacking.value = getCurrentDateTime();
          }
          break;
        case 'Penyortiran':
          // Jika status sebelumnya bukan 'Penyortiran', set waktuPacking dan waktuPenyortiran
          if (existingWaktuPacking === '') {
            waktuPacking.value = getCurrentDateTime();
          }
          if (existingWaktuPenyortiran === '') {
            waktuPenyortiran.value = getCurrentDateTime();
          }
          break;
        case 'Pengiriman':
          // Jika status sebelumnya bukan 'Pengiriman', set waktuPacking, waktuPenyortiran, dan waktuPengiriman
          if (existingWaktuPacking === '') {
            waktuPacking.value = getCurrentDateTime();
          }
          if (existingWaktuPenyortiran === '') {
            waktuPenyortiran.value = getCurrentDateTime();
          }
          if (existingWaktuPengiriman === '') {
            waktuPengiriman.value = getCurrentDateTime();
          }
          break;
        case 'Barang Sampai':
          // Jika status sebelumnya bukan 'Barang Sampai', set semua waktu
          if (existingWaktuPacking === '') {
            waktuPacking.value = getCurrentDateTime();
          }
          if (existingWaktuPenyortiran === '') {
            waktuPenyortiran.value = getCurrentDateTime();
          }
          if (existingWaktuPengiriman === '') {
            waktuPengiriman.value = getCurrentDateTime();
          }
          if (existingWaktuBarangSampai === '') {
            waktuBarangSampai.value = getCurrentDateTime();
          }
          break;
        default:
          break;
      }
    }

    function getCurrentDateTime() {
      var now = new Date();
      var year = now.getFullYear();
      var month = (now.getMonth() + 1).toString().padStart(2, '0');
      var day = now.getDate().toString().padStart(2, '0');
      var hours = now.getHours().toString().padStart(2, '0');
      var minutes = now.getMinutes().toString().padStart(2, '0');

      return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    // Call updateWaktu() initially to set the correct values based on the selected status
    updateWaktu();
  </script>



  <script>
    function updateTotalBayar() {
      var checkboxes = document.getElementsByName('barang[]');
      var totalBayar = 0;

      checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          // Mendapatkan biaya dari data-biaya pada checkbox
          var biaya = parseFloat(checkbox.getAttribute('data-biaya'));

          // Menambahkan biaya ke totalBayar
          totalBayar += biaya;
        }
      });

      // Menyimpan nilai totalBayar ke input total_bayar
      document.getElementById('total_bayar').value = totalBayar;
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    .status-icon {
      margin-right: 5px;
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
              <h1>Data Pengiriman</h1>
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
                <!-- Card content goes here -->
              </div>
              <!-- /.card -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">EDIT DATA PENGIRIMAN</h3>
                </div>
                <?php
                include '../../koneksi.php';
                $id = $_GET['id'];
                $data = mysqli_query($koneksi, "select * from pengiriman where id_pengiriman='$id'");
                while ($d = mysqli_fetch_array($data)) {
                  ?>
                  <div>
                    <form method="post" action="edit_pengiriman_aksi.php">
                      <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="id_pengiriman" class="form-control"
                          value="<?php echo $d['id_pengiriman']; ?>" readonly>
                      </div>

                      <div class="form-group">
                        <label for="nm_petugas">Nama Petugas</label>
                        <input type="text" name="nm_petugas" class="form-control"
                          value="<?php echo $admin['nm_petugas']; ?>" readonly>
                      </div>

                      <div class="form-group">
                        <label>NAMA PENGIRIM</label>
                        <input type="text" name="nama_pengirim" class="form-control"
                          value="<?php echo $d['nama_pengirim']; ?>">
                      </div>

                      <div class="form-group">
                        <label>NO HP PENGIRIM</label>
                        <input type="number" name="no_hp_pengirim" class="form-control"
                          value="<?php echo $d['no_hp_pengirim']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="alamat_asal">ALAMAT ASAL</label>
                        <td><textarea name="alamat_asal"><?php echo $d['alamat_asal']; ?></textarea></td>
                      </div>
                      <div class="form-group">
                        <label for="id_bumdes_asal">BUMDES ASAL</label>
                        <select name="id_bumdes_asal" id="id_bumdes_asal" class="form-control" required readonly>
                          <?php
                          // Loop untuk menampilkan opsi BUMDES ASAL dari hasil query
                          while ($rowBumdesAsal = $resultBumdesAsal->fetch_assoc()) {
                            $id_bumdes_asal = $rowBumdesAsal['id_bumdes'];

                            echo "<option value='{$id_bumdes_asal}'>{$id_bumdes_asal}</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>BUMDES TUJUAN</label>
                        <select name="id_bumdes_tujuan" id="id_bumdes_tujuan" class="form-control" required>
                          <?php
                          $data_bumdes_tujuan = mysqli_query($koneksi, "SELECT * FROM bumdes");
                          while ($d_bumdes_tujuan = mysqli_fetch_array($data_bumdes_tujuan)) {
                            $selected = ($d['id_bumdes_tujuan'] == $d_bumdes_tujuan['id_bumdes']) ? 'selected' : '';
                            echo "<option value='{$d_bumdes_tujuan['id_bumdes']}' $selected> {$d_bumdes_tujuan['nm_bumdes']}</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>KECAMATAN</label>
                        <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
                          <?php
                          $data_kurir = mysqli_query($koneksi, "SELECT * FROM kecamatan");
                          while ($d_kurir = mysqli_fetch_array($data_kurir)) {
                            $selected = ($d['id_kecamatan'] == $d_kurir['id_kecamatan']) ? 'selected' : '';
                            echo "<option value='{$d_kurir['id_kecamatan']}' $selected> {$d_kurir['nm_kecamatan']}</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <!-- Tambahkan elemen div untuk setiap input dan label sesuai kebutuhan -->
                      <!-- ALAMAT TUJUAN -->
                      <div class="form-group">
                        <label>ALAMAT TUJUAN</label>
                        <textarea name="alamat_tujuan" class="form-control"><?php echo $d['alamat_tujuan']; ?></textarea>
                      </div>

                      <!-- NAMA PENERIMA -->
                      <div class="form-group">
                        <label>NAMA PENERIMA</label>
                        <input type="text" name="nm_penerima" class="form-control"
                          value="<?php echo $d['nm_penerima']; ?>">
                      </div>

                      <!-- NO HP PENERIMA -->
                      <div class="form-group">
                        <label>NO HP PENERIMA</label>
                        <input type="number" name="no_hp_penerima" class="form-control"
                          value="<?php echo $d['no_hp_penerima']; ?>">
                      </div>

                      <div class="form-group">
                        <label>STATUS KIRIM</label>
                        <select name="status_kirim" id="status_kirim" class="form-control" required
                          onchange="updateWaktu()">
                          <option value="Packing Barang" class="form-control" <?php echo ($d['status_kirim'] == 'Packing Barang') ? 'selected' : ''; ?>>
                            Packing Barang<span class="status-icon">
                              <?php echo getStatusIcon('Packing Barang'); ?>
                            </span></option>
                          <option value="Penyortiran" class="form-control" <?php echo ($d['status_kirim'] == 'Penyortiran') ? 'selected' : ''; ?>>
                            Penyortiran<span class="status-icon">
                              <?php echo getStatusIcon('Penyortiran'); ?>
                            </span></option>
                          <option value="Pengiriman" class="form-control" <?php echo ($d['status_kirim'] == 'Pengiriman') ? 'selected' : ''; ?>>
                            Pengiriman<span class="status-icon">
                              <?php echo getStatusIcon('Pengiriman'); ?>
                            </span></option>
                          <option value="Barang Sampai" class="form-control" <?php echo ($d['status_kirim'] == 'Barang Sampai') ? 'selected' : ''; ?>>
                            Barang Sampai<span class="status-icon">
                              <?php echo getStatusIcon('Barang Sampai'); ?>
                            </span></option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>WAKTU PACKING</label>
                        <?php
                        // Cek apakah waktu packing sudah ada
                        $waktuPacking = !empty($d['waktu_status_kirim_packing']) ? $d['waktu_status_kirim_packing'] : date('Y-m-d\TH:i:s');
                        ?>
                        <input type="datetime-local" name="waktu_status_kirim_packing" id="waktu_status_kirim_packing"
                          class="form-control" value="<?php echo $waktuPacking; ?>" required readonly>
                      </div>

                      <div class="form-group">
                        <label>WAKTU PENYORTIRAN</label>
                        <?php
                        // Cek apakah waktu penyortiran sudah ada
                        $waktuPenyortiran = !empty($d['waktu_status_kirim_penyortiran']) ? $d['waktu_status_kirim_penyortiran'] : '';
                        ?>
                        <input type="datetime-local" name="waktu_status_kirim_penyortiran"
                          id="waktu_status_kirim_penyortiran" class="form-control"
                          value="<?php echo $waktuPenyortiran; ?>" required readonly>
                      </div>

                      <div class="form-group">
                        <label>WAKTU PENGIRIMAN</label>
                        <?php
                        // Cek apakah waktu pengiriman sudah ada
                        $waktuPengiriman = !empty($d['waktu_status_kirim_pengiriman']) ? $d['waktu_status_kirim_pengiriman'] : '';
                        ?>
                        <input type="datetime-local" name="waktu_status_kirim_pengiriman"
                          id="waktu_status_kirim_pengiriman" class="form-control" value="<?php echo $waktuPengiriman; ?>"
                          required readonly>
                      </div>

                      <div class="form-group">
                        <label>WAKTU BARANG SAMPAI</label>
                        <?php
                        // Cek apakah waktu barang sampai sudah ada
                        $waktuBarangSampai = !empty($d['waktu_status_barang_sampai']) ? $d['waktu_status_barang_sampai'] : '';
                        ?>
                        <input type="datetime-local" name="waktu_status_barang_sampai" id="waktu_status_barang_sampai"
                          class="form-control" value="<?php echo $waktuBarangSampai; ?>" required readonly>
                      </div>


                      <div class="form-group">
                        <label>STATUS BAYAR</label>
                        <?php
                        $isLunas = ($d['status_bayar'] == 'lunas');
                        if ($isLunas) {
                          ?>
                          <select name="status_bayar" id="status_bayar" class="form-control" required>
                            <option value="lunas">LUNAS</option>
                          </select>
                          <?php
                        } else {
                          ?>
                          <select name="status_bayar" id="status_bayar" class="form-control" required>
                            <option value="lunas">LUNAS</option>
                            <option value="bayar_ditempat" <?php echo !$isLunas ? 'selected' : ''; ?>>Bayar di Tempat
                            </option>
                          </select>
                          <?php
                        }
                        ?>
                      </div>

                      <div class="form-group">
                        <label>NAMA KURIR</label>
                        <select name="id_kurir" id="id_kurir" class="form-control" required>
                          <?php
                          $data_kurir = mysqli_query($koneksi, "SELECT * FROM kurir");
                          while ($d_kurir = mysqli_fetch_array($data_kurir)) {
                            $selected = ($d['id_kurir'] == $d_kurir['id_kurir']) ? 'selected' : '';
                            echo "<option value='{$d_kurir['id_kurir']}' $selected> {$d_kurir['nm_kurir']}</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>TOTAL BAYAR</label>
                        <input type="number" name="total_bayar" class="form-control"
                          value="<?php echo $d['total_bayar']; ?>">
                      </div>

                      <div>
                        <label></label>
                        <input type="submit" value="SIMPAN">
                      </div>
                    </form>
                  </div>
                  <?php
                }
                ?>
              </div>

              <div class="card-header">
                <!-- Card header content goes here -->
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

</body>

</html>