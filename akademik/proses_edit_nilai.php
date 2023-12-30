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


// Periksa koneksi
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data yang dikirimkan dari form edit
$id = $_POST['id'];
$jenis_ujian = $_POST['jenis_ujian'];
$mata_pelajaran = $_POST['mata_pelajaran'];
$nilai = $_POST['nilai'];

// Query SQL untuk update data
$query = "UPDATE nama_tabel SET jenis_ujian='$jenis_ujian', mata_pelajaran='$mata_pelajaran', nilai='$nilai' WHERE id='$id'";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dijalankan
if ($result) {
    // Jika berhasil, tampilkan alert berhasil
    echo '<script>alert("Data berhasil diubah."); window.location.href="halaman_utama.php";</script>';
} else {
    // Jika gagal, tampilkan alert gagal
    echo '<script>alert("Gagal mengubah data. Silakan coba lagi."); window.location.href="halaman_edit.php?id='.$id.'";</script>';
}

// Tutup koneksi
mysqli_close($koneksi);
?>
