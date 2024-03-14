<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tracking Pengiriman</title>
    <style>
 body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        .tracking-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            max-width: 600px;
            margin: 20px auto;
        }

        .tracking-info p {
            margin: 10px 0;
            font-size: 16px;
        }

        .status-label {
            font-weight: bold;
        }

        .status-in-transit {
            display: inline-block;
            padding: 8px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .status-in-transit-left {
            background-color: #ee4d2d;
            color: #fff;
            float: left;
        }

        .status-in-transit-right {
            background-color: #ee4d2d;
            color: #fff;
            float: right;
        }

        .status-delivered {
            color: #1a8e5f; /* Warna hijau seperti di Shopee */
        }

        .status-error {
            color: #999;
        }

        .timeline {
            position: relative;
            margin-top: 20px;
        }

        .timeline-dot {
            position: absolute;
            width: 16px;
            height: 16px;
            background: #ee4d2d; /* Warna merah seperti di Shopee */
            border-radius: 50%;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .timeline-line {
            position: absolute;
            width: 2px;
            height: 100%;
            background: #e0e0e0; /* Warna abu-abu seperti di Shopee */
            left: 50%;
            transform: translateX(-50%);
        }

        .timeline-event {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
            z-index: 1;
        }

        .timeline-event p {
            margin: 0;
        }

        .timeline-event:before {
            content: "";
            position: absolute;
            width: 12px;
            height: 12px;
            background-color: #ee4d2d; /* Warna merah seperti di Shopee */
            border-radius: 50%;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }

        .timeline-event-left {
            margin-left: 20px;
            text-align: left;
        }

    </style>
</head>
<body>
    <?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $no_resi = $_POST["no_resi"];

        // Gunakan prepared statement untuk menghindari SQL Injection
        $query = "SELECT b.*, p.*, p.waktu_status_kirim_packing, p.waktu_status_kirim_penyortiran,
                        p.waktu_status_kirim_pengiriman, p.waktu_status_barang_sampai,
                        a.nm_bumdes AS bumdes_asal, a2.nm_bumdes AS bumdes_tujuan
                FROM barang_kirim b
                JOIN pengiriman p ON b.id_pengiriman = p.id_pengiriman
                JOIN bumdes a ON p.id_bumdes_asal = a.id_bumdes
                JOIN bumdes a2 ON p.id_bumdes_tujuan = a2.id_bumdes
                WHERE b.no_resi = ?";

        $stmt = mysqli_prepare($koneksi, $query);

        // Bind parameter
        mysqli_stmt_bind_param($stmt, "s", $no_resi);

        // Eksekusi statement
        mysqli_stmt_execute($stmt);

        // Ambil hasil query
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Data ditemukan, tampilkan informasi
                $data = mysqli_fetch_assoc($result);
                ?>
                <div class="tracking-info">
                    <h2>Hasil Tracking Pengiriman</h2>
                    <p>ID Pengiriman: <?= isset($data['id_pengiriman']) ? $data['id_pengiriman'] : 'Data tidak tersedia' ?></p>
                    <p>Bumdes Asal: <?= isset($data['bumdes_asal']) ? $data['bumdes_asal'] : 'Data tidak tersedia' ?></p>
                    <p>Bumdes Tujuan: <?= isset($data['bumdes_tujuan']) ? $data['bumdes_tujuan'] : 'Data tidak tersedia' ?></p>
                    <p>Nama Pengirim: <?= isset($data['nama_pengirim']) ? $data['nama_pengirim'] : 'Data tidak tersedia' ?></p>
                    <p class="status-label">Status Kirim: 
                        <?php
                        if ($data['status_kirim'] == 'In Transit') {
                            $statusClass = ($data['id_pengiriman'] % 2 == 0) ? 'status-in-transit-right' : 'status-in-transit-left';
                            echo '<span class="status-in-transit ' . $statusClass . '">' . $data['status_kirim'] . '</span>';
                        } elseif ($data['status_kirim'] == 'Delivered') {
                            echo '<span class="status-delivered">' . $data['status_kirim'] . '</span>';
                        } else {
                            echo '<span class="status-error">' . $data['status_kirim'] . '</span>';
                        }
                        ?>
                    </p>
                    <div class="timeline">
                        <div class="timeline-event timeline-event-right">
                            <p>Waktu Packing: <?= isset($data['waktu_status_kirim_packing']) ? $data['waktu_status_kirim_packing'] : 'Data tidak tersedia' ?></p>
                        </div>
                        <div class="timeline-event timeline-event-right">
                            <p>Waktu Penyortiran: <?= isset($data['waktu_status_kirim_penyortiran']) ? $data['waktu_status_kirim_penyortiran'] : 'Data tidak tersedia' ?></p>
                        </div>
                        <div class="timeline-event timeline-event-right">
                            <p>Waktu Pengiriman: <?= isset($data['waktu_status_kirim_pengiriman']) ? $data['waktu_status_kirim_pengiriman'] : 'Data tidak tersedia' ?></p>
                        </div>
                        <div class="timeline-event timeline-event-right">
                            <p>Waktu Barang Sampai: <?= isset($data['waktu_status_barang_sampai']) ? $data['waktu_status_barang_sampai'] : 'Data tidak tersedia' ?></p>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                // Nomor resi tidak ditemukan
                echo "<p style='text-align: center; color: #dc3545;'>Nomor Resi tidak ditemukan.</p>";
            }
        } else {
            // Error saat menjalankan query
            echo "<p style='text-align: center; color: #dc3545;'>Error: " . mysqli_error($koneksi) . "</p>";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);

        // Tutup koneksi
        mysqli_close($koneksi);
    }
    ?>
</body>
</html>
