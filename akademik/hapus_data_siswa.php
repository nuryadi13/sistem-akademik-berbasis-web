<?php
// Gantilah bagian berikut dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_akademik_nh";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Periksa apakah parameter id disertakan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data siswa berdasarkan ID
    $sql = "DELETE FROM siswa WHERE id = $id";
    $result = $conn->query($sql);

     if ($result === TRUE) {
        // Data siswa berhasil dihapus, alihkan ke halaman data_siswa.php
        header('Location: data_siswa.php');
        exit(); // Pastikan untuk keluar setelah menggunakan header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Parameter ID tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>
