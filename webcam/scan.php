<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.0.1/dist/jsQR.js"></script>
</head>
<body>
    <h2>QR Code Scanner</h2>
    <video id="video" width="300" height="200" autoplay></video>
    <script>
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();

                var canvas = document.createElement('canvas');
                canvas.width = 300;
                canvas.height = 200;
                var context = canvas.getContext('2d');

                setInterval(function () {
                    context.drawImage(video, 0, 0, 300, 200);
                    var imageData = context.getImageData(0, 0, 300, 200);
                    var code = jsQR(imageData.data, imageData.width, imageData.height, {
                        inversionAttempts: "dontInvert",
                    });

                    if (code) {
                        alert("QR Code Detected: " + code.data);
                        // Ambil data barang dari server dan tampilkan
                        fetchDataAndDisplay(code.data);
                    }
                }, 1000);
            })
            .catch(function (err) {
                console.error('Error accessing webcam:', err);
            });

        // Fungsi untuk mengambil data barang dari server dan menampilkannya
        function fetchDataAndDisplay(qrCodeData) {
            // Ganti URL endpoint sesuai dengan kebutuhan
            var url = "fetch_barang_data.php?qrCodeData=" + qrCodeData;

            // Lakukan request AJAX
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Tampilkan data barang di sini (misalnya dalam alert)
                    alert("Data Barang: " + JSON.stringify(data));

                    // Jika perlu, Anda dapat mengirim data ke server untuk mengubah status kirim
                    // sendDataToServer(qrCodeData);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Fungsi untuk mengirim data ke server PHP
        function sendDataToServer(qrCodeData) {
            // Ganti URL endpoint sesuai dengan kebutuhan
            var url = "update_status_kirim.php";
            var data = { qrCodeData: qrCodeData, newStatus: "status_baru" };

            // Lakukan request AJAX dengan metode POST
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                // Tampilkan respons dari server (misalnya dalam alert)
                alert("Response from Server: " + JSON.stringify(data));
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });
        }
    </script>
</body>
</html>
