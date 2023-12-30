<?php
// File: edit_siswa.php

// Include koneksi database
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
// Mendapatkan ID siswa dari URL
$id = $_GET['id'];

// Query untuk mendapatkan data siswa berdasarkan ID
$query = "SELECT * FROM siswa WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Memproses form setelah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
    $kelas = $_POST['kelas'];
    $no_whatsapp = $_POST['no_whatsapp'];
    $nilai_Siswa = $_POST['nilai_Siswa'];

    // Update data siswa ke database
    $update_query = "UPDATE siswa SET username = '$username', password = '$hashed_password', kelas = '$kelas', no_whatsapp = '$no_whatsapp', nilai_Siswa = '$nilai_Siswa' WHERE id = $id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Redirect ke halaman daftar siswa setelah berhasil diupdate
        header('Location: daftar_siswa.php');
        exit;
    } else {
        echo 'Gagal mengupdate data siswa.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <style>
        .input-group-text {
            cursor: pointer;
        }

        .input-group-text.active {
            color: #007bff; /* Ganti warna ikon mata aktif sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Siswa</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>">
                    <div class="input-group-append">
                        <span class="input-group-text" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $row['kelas']; ?>">
            </div>
            <div class="form-group">
                <label for="no_whatsapp">No WhatsApp:</label>
                <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="<?php echo $row['no_whatsapp']; ?>">
            </div>
            <!-- <div class="form-group">
                <label for="nilai_Siswa">Nilai Siswa:</label>
                <input type="text" class="form-control" id="nilai_Siswa" name="nilai_Siswa" value="<?php echo $row['nilai_siswa']; ?>">
            </div> -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Tambahkan script JS Bootstrap dan jQuery -->
    <script>
        // Ambil elemen input password dan elemen ikon mata
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        // Tambahkan event listener untuk mengubah tipe input password
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('active');
        });
    </script>

    <!-- end -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
