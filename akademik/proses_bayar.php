<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_akademik_nh");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari formulir
$nis = $_POST['nis'];
$jumlah_pembayaran = $_POST['jumlah_pembayaran'];
$status = $_POST['status'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];

// Masukkan data ke database
$sql = "INSERT INTO pembayaran (nis, jumlah_pembayaran, status, tanggal_pembayaran) 
        VALUES ('$nis', '$jumlah_pembayaran', '$status', '$tanggal_pembayaran')";

if ($conn->query($sql) === TRUE) {
    echo "Pembayaran berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
