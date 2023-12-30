<?php
session_start();
// Tambahkan variabel NIS pada sesi jika ada
$nis = isset($_SESSION['nis']) ? $_SESSION['nis'] : '';

// Contoh pengaturan sesi setelah siswa login
$_SESSION['username'] = "username";

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

// Ambil data dari formulir
$nis = $_POST['nis']; // Tambahkan baris ini untuk mengambil NIS dari formulir
// $nama = $_POST['nama'];
// $kelas = $_POST['kelas'];
$jenis_ujian = $_POST['jenis_ujian'];
$mata_pelajaran = $_POST['mata_pelajaran'];
$nilai = $_POST['nilai'];

// Gunakan prepared statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO penilaian (nis, jenis_ujian, mata_pelajaran, nilai) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $nis, $jenis_ujian, $mata_pelajaran, $nilai);

// Eksekusi statement
if ($stmt->execute()) {
    // Jika eksekusi berhasil, tampilkan notifikasi alert
    echo '<script>alert("Berhasil input data!");</script>';
} else {
    // Jika eksekusi gagal, tampilkan notifikasi alert
    echo '<script>alert("Gagal input data. Silakan coba lagi.");</script>';
}

// Tutup statement
$stmt->close();

// Tutup koneksi
$conn->close();
?>

<!-- Redirect ke halaman nilai.php setelah menampilkan notifikasi -->
<script>window.location.href = 'nilai.php';</script>
