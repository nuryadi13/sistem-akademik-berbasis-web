<?php
session_start();

// Set username pada sesi (harap dihapus di produksi)
// $_SESSION['username'] = "username";

// // Pemeriksaan login
// if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
//     header("Location: login.php");
//     exit();
// }

// Penanganan pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sambungkan ke database
    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $database = "db_akademik_nh";

    // Membuat koneksi
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Tangkap data dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query SQL untuk menyimpan data ke dalam tabel 'tu'
    $sql = "INSERT INTO tu (username, password) VALUES ('$username', '$hashedPassword')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil. Silakan <a href='../index.php'>login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>
