<?php
// Periksa apakah form telah disubmit
session_start();
$_SESSION['username'] = "username"; 
// login
// if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sertakan file koneksi ke database
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

    // Tangkap data dari form
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $mata_pelajaran = $_POST["mata_pelajaran"];
    $password = $_POST["password"];

    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query SQL untuk menyimpan data guru ke dalam tabel guru
    $sql = "INSERT INTO guru (nama, username, mata_pelajaran, password) VALUES ('$nama', '$username', '$mata_pelajaran', '$hashedPassword')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Notifikasi JavaScript dan pengalihan ke halaman login
        echo <<<EOT
            <script>
                alert('Pendaftaran berhasil. Silakan login');
                window.location.href='index.php';
            </script>
EOT;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>
