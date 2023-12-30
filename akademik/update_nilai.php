<?php
// update_nilai.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari permintaan POST
    $siswaId = $_POST["siswaId"];
    $nis = $_POST["nis"];
    $mataPelajaran = $_POST["mataPelajaran"];
    $newValue = $_POST["newValue"];

    // Lakukan koneksi ke database dan query untuk memperbarui nilai
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "db_akademik_nh";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE penilaian SET nilai='$newValue' WHERE nis='$nis' AND mata_pelajaran='$mataPelajaran'";
    $result = $conn->query($sql);

    // Kirim respons ke klien
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika bukan permintaan POST, kembalikan respons dengan kesalahan
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
