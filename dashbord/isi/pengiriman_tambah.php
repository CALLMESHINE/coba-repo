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

// ...

// Query untuk mendapatkan data admin dan Bumdes Asal berdasarkan id_petugas
$queryAdmin = "SELECT a.*, b.id_bumdes, b.nm_bumdes AS nm_bumdes_asal
               FROM admin_bumdes a
               LEFT JOIN bumdes b ON a.id_bumdes = b.id_bumdes
               WHERE a.id_petugas = ?";
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


// Query untuk mendapatkan data Bumdes Asal berdasarkan id_bumdes_asal (diubah sesuai kebutuhan)
$queryBumdesAsal = "SELECT * FROM bumdes WHERE id_bumdes = ?";
$stmtBumdesAsal = $koneksi->prepare($queryBumdesAsal);
$stmtBumdesAsal->bind_param("i", $admin['id_bumdes']);
$stmtBumdesAsal->execute();
$resultBumdesAsal = $stmtBumdesAsal->get_result();
$stmtBumdesAsal->close();

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
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAMBAH PENGIRIMAN</title>
    <?php include("head.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .status-icon {
            margin-right: 15px;
        }



        /* Menyesuaikan lebar kolom tabel agar sesuai dengan kontennya */
        #example1 th,
        #example1 td {
            white-space: nowrap;
        }

        /* Memberikan scrollbar horizontal pada tabel jika diperlukan */
        #example1 {
            overflow-x: auto;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <?php
    date_default_timezone_set('Asia/Bangkok');
    ?>
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
                            <h1>INPUT PENGIRIMAN</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Input Pengiriman</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Input Pengiriman -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">TAMBAH PENGIRIMAN</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- Form start -->
                                <form method="post" action="pengiriman_tambah_aksi.php">
                                    <div class="card-body">
                                        <!-- Formulir Pengiriman -->
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <?php
                                            include '../../koneksi.php';
                                            $result = mysqli_query($koneksi, "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'pemdes' AND TABLE_NAME = 'pengiriman'");
                                            $row = mysqli_fetch_array($result);
                                            $id_pengiriman = $row['AUTO_INCREMENT'];
                                            // Input readonly untuk menampilkan ID pengiriman
                                            echo '<input type="text" name="id" value="' . $id_pengiriman . '" readonly class="form-control">';
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_petugas">Nama Petugas</label>
                                            <input type="text" name="nm_petugas" class="form-control"
                                                value="<?php echo $admin['nm_petugas']; ?>" readonly>
                                        </div>

                                        <!-- Formulir lainnya -->
                                        <div class="form-group">
                                            <label for="nama_pengirim">Nama Pengirim</label>
                                            <input type="text" name="nama_pengirim" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp_pengirim">NO HP PENGIRIM</label>
                                            <input type="number" name="no_hp_pengirim" class="form-control" required>
                                        </div>
                                        <div class="form-group">
    <label for="alamat_asal">ALAMAT ASAL</label>
    <textarea name="alamat_asal" class="form-control" required></textarea>
</div>

                                        <div class="form-group">
                                            <label for="id_bumdes_asal">BUMDES ASAL</label>
                                            <select name="id_bumdes_asal" id="id_bumdes_asal" class="form-control"
                                                required readonly>
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
                                            <label for="id_bumdes_tujuan">BUMDES TUJUAN</label>
                                            <select name="id_bumdes_tujuan" id="id_bumdes_tujuan" class="form-control"
                                                required>
                                                <?php
                                                $data_bumdes_tujuan = mysqli_query($koneksi, "SELECT * FROM bumdes");
                                                while ($d_bumdes_tujuan = mysqli_fetch_array($data_bumdes_tujuan)) {
                                                    echo "<option value='{$d_bumdes_tujuan['id_bumdes']}'> {$d_bumdes_tujuan['nm_bumdes']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_kurir">KECAMATAN</label>
                                            <!-- Pilihan nama kurir dari tabel kurir -->
                                            <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
                                                <?php
                                                $data = mysqli_query($koneksi, "SELECT * FROM kecamatan");
                                                while ($d = mysqli_fetch_array($data)) {
                                                    echo "<option value='{$d['id_kecamatan']}'> {$d['nm_kecamatan']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_tujuan">ALAMAT TUJUAN</label>
                                            <textarea name="alamat_tujuan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_penerima">NAMA PENERIMA</label>
                                            <input type="text" name="nm_penerima" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp_penerima">NO HP PENERIMA</label>
                                            <input type="number" name="no_hp_penerima" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_kirim">STATUS KIRIM</label>
                                            <select name="status_kirim" id="status_kirim" class="form-control" required
                                                onchange="updateWaktu()">
                                                <option value="Packing Barang">Packing Barang
                                                    <span class="status-icon">
                                                        <?php echo getStatusIcon('Packing Barang'); ?>
                                                    </span>
                                                </option>
                                                <option value="Penyortiran">Penyortiran
                                                    <span class="status-icon">
                                                        <?php echo getStatusIcon('Penyortiran'); ?>
                                                    </span>
                                                </option>
                                                <option value="Pengiriman">Pengiriman
                                                    <span class="status-icon">
                                                        <?php echo getStatusIcon('Pengiriman'); ?>
                                                    </span>
                                                </option>
                                                <option value="Barang Sampai">Barang Sampai
                                                    <span class="status-icon">
                                                        <?php echo getStatusIcon('Barang Sampai'); ?>
                                                    </span>
                                                </option>
                                            </select>
                                        </div>
                                        <!-- Waktu untuk setiap status -->
                                        <div class="form-group">
                                            <label for="waktu_status_kirim_packing">WAKTU PACKING</label>
                                            <?php
                                            // Cek apakah waktu packing sudah ada
                                            $waktu_packing = !empty($d['waktu_status_kirim_packing']) ? $d['waktu_status_kirim_packing'] : date('Y-m-d\TH:i:s');
                                            ?>
                                            <input type="datetime-local" name="waktu_status_kirim_packing"
                                                value="<?php echo $waktu_packing; ?>" required readonly
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu_status_kirim_penyortiran">WAKTU PENYORTIRAN</label>
                                            <?php
                                            // Cek apakah waktu penyortiran sudah ada
                                            $waktu_penyortiran = !empty($d['waktu_status_kirim_penyortiran']) ? $d['waktu_status_kirim_penyortiran'] : '';
                                            ?>
                                            <input type="datetime-local" name="waktu_status_kirim_penyortiran"
                                                value="<?php echo $waktu_penyortiran; ?>" required readonly
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu_status_kirim_pengiriman">WAKTU PENGIRIMAN</label>
                                            <?php
                                            // Cek apakah waktu pengiriman sudah ada
                                            $waktu_pengiriman = !empty($d['waktu_status_kirim_pengiriman']) ? $d['waktu_status_kirim_pengiriman'] : '';
                                            ?>
                                            <input type="datetime-local" name="waktu_status_kirim_pengiriman"
                                                value="<?php echo $waktu_pengiriman; ?>" required readonly
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu_status_barang_sampai">WAKTU BARANG SAMPAI</label>
                                            <?php
                                            // Cek apakah waktu barang sampai sudah ada
                                            $waktu_barang_sampai = !empty($d['waktu_status_barang_sampai']) ? $d['waktu_status_barang_sampai'] : '';
                                            ?>
                                            <input type="datetime-local" name="waktu_status_barang_sampai"
                                                value="<?php echo $waktu_barang_sampai; ?>" required readonly
                                                class="form-control">
                                        </div>
                                        <!-- Formulir lainnya -->
                                        <div class="form-group">
                                            <label for="status_bayar">STATUS BAYAR</label>
                                            <?php
                                            // Jika status bayar sudah "lunas", maka nonaktifkan dropdown
                                            $isLunas = (isset($d['status_bayar']) && $d['status_bayar'] == 'lunas');
                                            ?>
                                            <select name="status_bayar" id="status_bayar" class="form-control" required
                                                <?php echo ($isLunas) ? 'disabled' : ''; ?>>
                                                <option value="lunas" <?php echo ($isLunas) ? 'selected' : ''; ?>>LUNAS
                                                </option>
                                                <option value="bayar_ditempat" <?php echo (isset($d['status_bayar']) && $d['status_bayar'] == 'bayar_ditempat') ? 'selected' : ''; ?>>BAYAR DI
                                                    TEMPAT</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_kurir">NAMA KURIR</label>
                                            <!-- Pilihan nama kurir dan alamat dari tabel kurir -->
                                            <select name="id_kurir" id="id_kurir" class="form-control" required>
                                                <?php
                                                $data = mysqli_query($koneksi, "SELECT * FROM kurir");
                                                while ($d = mysqli_fetch_array($data)) {
                                                    echo "<option value='{$d['id_kurir']}'> {$d['nm_kurir']} - {$d['alamat']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_bayar">TOTAL BAYAR</label>
                                            <input type="number" name="total_bayar" id="total_bayar" required readonly
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>


                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
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
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../../koneksi.php';
                                            $no = 1;
                                            $data = mysqli_query($koneksi, "select * from barang b LEFT JOIN kategori k on b.id_kategori=k.id_kategori");
                                            while ($d = mysqli_fetch_array($data)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $no++; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $d['nm_barang']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $d['jml_barang']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $d['nm_kategori']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $d['no_resi']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $d['brt_barang']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $d['biaya']; ?>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="barang[]"
                                                            value="<?php echo $d['id_barang']; ?>"
                                                            data-biaya="<?php echo $d['biaya']; ?>"
                                                            onchange="updateTotalBayar()">
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <?php include("foot.php"); ?>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    <!-- Additional scripts if needed -->

    <head>
        <title>TAMBAH PENGIRIMAN</title>
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
        <script>
            function updateWaktu() {
                var statusKirim = document.getElementById('status_kirim').value;

                // Get the elements for WAKTU PENYORTIRAN, WAKTU PENGIRIMAN, and WAKTU BARANG SAMPAI
                var waktuPacking = document.getElementsByName('waktu_status_kirim_packing')[0];
                var waktuPenyortiran = document.getElementsByName('waktu_status_kirim_penyortiran')[0];
                var waktuPengiriman = document.getElementsByName('waktu_status_kirim_pengiriman')[0];
                var waktuBarangSampai = document.getElementsByName('waktu_status_barang_sampai')[0];

                // Disable all date fields
                waktuPacking.disabled = true;
                waktuPenyortiran.disabled = true;
                waktuPengiriman.disabled = true;
                waktuBarangSampai.disabled = true;

                // Enable the date field based on the selected status
                if (statusKirim === 'Packing Barang') {
                    waktuPacking.disabled = false;
                } else if (statusKirim === 'Penyortiran') {
                    waktuPenyortiran.disabled = false;
                } else if (statusKirim === 'Pengiriman') {
                    waktuPengiriman.disabled = false;
                } else if (statusKirim === 'Barang Sampai') {
                    waktuBarangSampai.disabled = false;
                }
            }
        </script>
</body>

</html>