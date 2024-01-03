<?php
// Hapus data berdasarkan nis dan mata_pelajaran pada tabel penilaian
if (isset($_POST['nis']) && isset($_POST['mataPelajaran'])) {
    $nis = $_POST['nis'];
    $mataPelajaran = $_POST['mataPelajaran'];

    // Lakukan operasi penghapusan data di sini (gunakan prepared statement)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "db_akademik_nh";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Gunakan prepared statement untuk mencegah SQL injection
    $sql = "DELETE FROM penilaian WHERE nis = ? AND mata_pelajaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nis, $mataPelajaran);
    $stmt->execute();
    $stmt->close();

    // Setelah penghapusan berhasil
    $response = array('success' => true);
    echo json_encode($response);

    $conn->close();
} else {
    $response = array('success' => false, 'message' => 'Data tidak lengkap');
    echo json_encode($response);
}
?>
