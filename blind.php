<?php
include './config/database.php'; // Pastikan koneksi database sudah benar
session_start();

$account_type = isset($_SESSION['accountType']);
// Memeriksa apakah pengguna sudah login
if ($account_type != "blind") {
    header("Location: comp/error.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=O4BwsMp0"></script>
    <style>
        * {
            border: 1px, solid, red;
        }

        /* Tambahkan beberapa gaya untuk panel dan tombol */
        #statusPanel {
            height: 100vh;
            /* Panel status akan mengisi tinggi layar */
            overflow-y: auto;
            /* Jika konten lebih banyak, tambahkan scrollbar */
            padding: 20px;
            /* Beri sedikit padding untuk estetika */
        }

        .big-button {
            width: 100%;
            /* Tombol akan mengambil lebar penuh */
            height: 100px;
            /* Tinggi tombol */
            font-size: 1.5rem;
            /* Ukuran font yang lebih besar */
        }

        @media (max-width: 768px) {

            /* Di mobile, kita bisa menyesuaikan gaya lebih lanjut jika diperlukan */
            #statusPanel {
                height: auto;
                /* Panel tidak perlu mengisi tinggi layar */
            }
        }

        .row {
            height: 100vh;
        }

        .rounded-circle {
            width: 400px;
            height: 400px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #dc3545;
            /* Red background */
            border-radius: 50%;
            /* Make it circular */
            color: white;
            /* Text color */
            font-size: 2rem;
            /* Font size */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s, transform 0.3s;
            /* Smooth transition */
        }

        .rounded-circle:hover {
            background-color: #c82333;
            /* Darker red on hover */
            transform: scale(1.05);
            /* Slightly enlarge on hover */
        }

        .rounded-circle:active {
            transform: scale(0.95);
            /* Slightly shrink on click */
        }

        /* Flexbox untuk menempatkan tombol di tengah */
        .centered-container {
            display: flex;
            justify-content: center;
            /* Horizontal center */
            align-items: center;
            /* Vertical center */
            height: 100%;
            /* Full height of parent */
        }
    </style>
</head>

<body>
    <section class="container-fluid text-center">
        <div class="row">
            <div class="col-lg-2 col-md-12 bg-light-subtle" id="statusPanel">
                <h5>Status Online</h5>
                <p id="onlineCount">Jumlah Orang Online: <strong id="onlineNumber">5</strong></p>
            </div>
            <div class="col-lg-10 col-md-12 d-flex align-items-center bg-secondary">
                <div class="centered-container w-100">
                    <div class="rounded-circle" id="speakButton">
                        <form method="POST">
                            <button type="submit" name="call_volunteer">Call Volunteer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk berbicara
        function speak(text) {
            responsiveVoice.speak(text, "Indonesian Female");
        }

        // Event listener untuk bagian status
        document.getElementById('statusPanel').addEventListener('click', function() {
            const onlineCount = document.getElementById('onlineNumber').textContent;
            const text = `Jumlah orang online ada: ${onlineCount} pengguna`;
            speak(text);
        });

        // Event listener untuk tombol
        document.getElementById('speakButton').addEventListener('click', function() {
            const text = "Melakukan Panggilan. Silahkan Tunggu...!";
            speak(text);
        });
    </script>
</body>

</html>