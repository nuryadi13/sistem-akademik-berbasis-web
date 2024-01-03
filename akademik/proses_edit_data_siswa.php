<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = htmlspecialchars($_POST['username']);
    $nis = htmlspecialchars($_POST['nis']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $no_whatsapp = htmlspecialchars($_POST['no_whatsapp']);

    // Koneksi ke database
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "db_akademik_nh";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Gunakan prepared statement untuk mencegah SQL injection
    $sql_update = "UPDATE siswa SET username=?, nis=?, kelas=?, no_whatsapp=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssi", $username, $nis, $kelas, $no_whatsapp, $id);

    if ($stmt->execute()) {
        // Pesan berhasil disimpan
        echo "<script>alert('Perubahan data siswa berhasil disimpan.'); window.location.href='edit_data_siswa.php?id=$id';</script>";
    } else {
        // Pesan error
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Tutup prepared statement
    $stmt->close();
    // Tutup koneksi
    $conn->close();
} else {
    echo "Invalid request";
}
?>
