<?php
$host = "localhost"; // Ganti dengan nama host database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "pemdes"; // Ganti dengan nama database Anda

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Set charset untuk mendukung karakter khusus
$koneksi->set_charset("utf8");
?>
