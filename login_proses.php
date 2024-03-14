<?php
session_start();

include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$role = $_POST['role']; // menangkap role (siswa, admin, atau guru)

$query = "";
$redirectPage = "";

if ($role == 'kurir') {
    $query = "SELECT * FROM kurir WHERE username=? AND password=?";
    $redirectPage = '../kurir/halaman_kurir.php';
} elseif ($role == 'admin_bumdes') {
    $query = "SELECT * FROM admin_bumdes WHERE username=? AND password=?";
    $redirectPage = 'dashbord/isi/index.php';
} elseif ($role == 'admin_pemdes_ekspres') {
    $query = "SELECT * FROM admin_pemdes_ekspres WHERE username=? AND password=?";
    $redirectPage = '../admin_pemdes_ekspres/halaman_admin_pemdes_ekspres.php';
}

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $_SESSION['id_petugas'] = $row['id_petugas']; // pastikan kolom ini sesuai dengan struktur tabel
    $_SESSION['id_bumdes'] = $row['id_bumdes']; // tambahkan ID Bumdes ke dalam session
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['status'] = "login";

    $_SESSION['notif'] = "Login berhasil";

    // Setelah login berhasil, arahkan ke halaman dashboard
    header("location: $redirectPage");

    // Check apakah user adalah admin_bumdes dan arahkan ke halaman pengiriman keluar
    if ($role == 'admin_bumdes') {
        header("location: dashbord/isi/pengiriman_tampil_keluar.php");
    } elseif ($role == 'kurir') {
        // Jika role adalah kurir, arahkan ke halaman pengiriman masuk
        header("location: ../kurir/halaman_kurir.php");
    }
} else {
    $_SESSION['notif'] = "Login gagal. Periksa kembali username, password, dan peran Anda.";
    header("location:login.php?pesan=gagal");
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
