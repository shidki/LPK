<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('qrcode/html5-qrcode.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <meta http-equiv="Content-Security-Policy" content="geolocation 'self' https://*;">
    <style>
        .scanContainer{
            background-color: rgb(241, 241, 241);
            box-shadow: 0px 10px 10px rgb(224, 224, 224);
            margin: auto;
            height: auto;
            width: 500px;
        }
    </style>
</head>
<body onload="getLocation()">
    <div class="container text-center" >
        <div class="judul mt-5 mb-5">
            <h2>Absen Scanner LPK Genius</h2>
        </div>
        <div class="scanContainer">
            <div id="reader"></div>
        </div>
    </div>
    <script>
        function isMobile() {
            return /Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent);
        }
        function getLocation() {
            const center = [-6.9655218, 109.6364064]; // Koordinat pusat (latitude, longitude)
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        const distance = haversineDistance(center, [latitude, longitude]);
                        
                        if (!isMobile()) {
                            alert("Silakan absen melalui HP!");
                            window.location.href = "{{ route('viewAbsenSiswa', ['id' => $id]) }}";
                            return;
                        }
                        if (distance > 10) {
                            alert("Jarak tidak memenuhi batas absen");
                            return;
                        } else {
                            startQRScanner();
                        }
                    },
                    function (error) {
                        console.error("Gagal mendapatkan lokasi:", error.message);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            } else {
                console.error("Geolocation tidak didukung di browser ini.");
            }
        }

        // Fungsi untuk menghitung jarak menggunakan rumus Haversine
        function haversineDistance(coord1, coord2) {
            const R = 6371000; // Radius bumi dalam meter
            const lat1 = coord1[0] * Math.PI / 180;
            const lat2 = coord2[0] * Math.PI / 180;
            const deltaLat = (coord2[0] - coord1[0]) * Math.PI / 180;
            const deltaLon = (coord2[1] - coord1[1]) * Math.PI / 180;

            const a = Math.sin(deltaLat / 2) * Math.sin(deltaLat / 2) +
                      Math.cos(lat1) * Math.cos(lat2) *
                      Math.sin(deltaLon / 2) * Math.sin(deltaLon / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Jarak dalam meter
        }

        function startQRScanner() {
            let html5QRCodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 15, // Tingkatkan FPS untuk pemindaian lebih cepat
                    qrbox: { width: 300, height: 300 }, // Perbesar ukuran deteksi QR Code
                    rememberLastUsedCamera: true, // Mengingat kamera terakhir yang digunakan
                    aspectRatio: 1.0, // Memastikan area deteksi tetap proporsional
                    disableFlip: false // Mencegah pemindaian terbalik (default: false)
                }
            );
            html5QRCodeScanner.render(onScanSuccess);
        }

        function onScanSuccess(decodedText, decodeResult){
            window.location.href = decodedText;
        }

    </script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>