<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $nis = $_POST["nis"];
    $kelas = $_POST["kelas"];
    $no_whatsapp = $_POST["no_whatsapp"];

    // Lakukan validasi atau operasi lainnya sesuai kebutuhan

    // Contoh validasi sederhana, pastikan password dan konfirmasi password sama
    if ($password !== $confirm_password) {
        echo "<script>alert('Password dan konfirmasi password tidak sesuai.');</script>";
        echo "<script>window.location.href = 'register.php';</script>"; // Redirect kembali ke halaman pendaftaran
        exit;
    } else {
        // Lakukan hash password sebelum menyimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Lakukan koneksi ke database (ganti informasi koneksi sesuai dengan kebutuhan)
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $dbname = "db_akademik_nh";

        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Periksa koneksi database
        if ($conn->connect_error) {
            die("Koneksi database gagal: " . $conn->connect_error);
        }

        // Periksa apakah NIS sudah terdaftar
        $check_query = "SELECT * FROM siswa WHERE nis = '$nis'";
        $result = $conn->query($check_query);
        
        if ($result->num_rows > 0) {
            // NIS sudah terdaftar, tampilkan pesan kesalahan
            echo "<script>alert('Akun dengan NIS $nis sudah terdaftar.');</script>";
            echo "<script>window.location.href = 'register.php';</script>"; // Redirect kembali ke halaman pendaftaran
            exit;
        }

        // Siapkan query untuk menyimpan data
        $insert_query = "INSERT INTO siswa (username, password, nis, kelas, no_whatsapp) VALUES ('$username', '$hashed_password', '$nis', '$kelas', '$no_whatsapp')";

        // Eksekusi query
        if ($conn->query($insert_query) === TRUE) {
            echo "<script>alert('Registrasi berhasil!');</script> ";
            echo "<script>window.location.href = 'register.php';</script>";
        } else {
            echo "<script>alert('Error: " . $insert_query . "\\n" . $conn->error . "');</script>";
            echo "<script>window.location.href = 'register.php';</script>"; // Redirect kembali ke halaman pendaftaran
            exit;
        }

        // Tutup koneksi database
        $conn->close();
    }
} else {
    // Redirect jika form tidak diakses melalui metode POST
    header("Location: index.html");
    exit();
}
?>
