<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_akademik_nh";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi berhasil";

// Jangan lupa untuk menutup koneksi setelah selesai digunakan
$conn->close();
?>
