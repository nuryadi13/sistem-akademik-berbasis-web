<?php
session_start();

// Contoh pengaturan sesi setelah siswa login
$_SESSION['username'] = "username"; // Gantilah dengan username yang sesuai

// Cek apakah request menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir login
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Lakukan koneksi ke database (gantilah dengan informasi database Anda)
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "db_akademik_nh";

    // Membuat koneksi
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $database);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Escape input untuk mencegah SQL injection
    $username = $conn->real_escape_string($username);

    // Tentukan tabel berdasarkan peran
    $table_name = getTableName($role);

    // Buat query SQL untuk mendapatkan data user berdasarkan username
    $query = "SELECT * FROM $table_name WHERE username='$username'";
    $result = $conn->query($query);

    // Periksa apakah query berhasil dieksekusi
    if ($result === FALSE) {
        die("Error in query: " . $conn->error);
    }

    // Periksa apakah ada hasil data dari query
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password dengan password_verify
        if (password_verify($password, $row["password"])) {
            // Login berhasil
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;
            $_SESSION["nis"] = $row["nis"]; // Menyimpan NIS di sesi

            // Arahkan ke halaman dashboard sesuai peran
            redirectToDashboard($role);
        } else {
            // Password tidak cocok, tampilkan notifikasi menggunakan JavaScript
            showErrorMessage("Username atau password salah!");
            echo "window.Location: index.php";
        }
    } else {
        // Login gagal, tampilkan notifikasi menggunakan JavaScript
        showErrorMessage("Username atau password salah!");
    }
} else {
    // Jika bukan metode POST, redirect ke halaman login
    header("Location: login.php");
    exit(); // Pastikan untuk keluar setelah mengarahkan
}

// Pastikan koneksi database ditutup setelah semua pekerjaan selesai
$conn->close();

// Fungsi untuk mendapatkan nama tabel berdasarkan peran
function getTableName($role) {
    switch ($role) {
        case 'siswa':
            return 'siswa';
        case 'guru':
            return 'guru';
        case 'tu':
            return 'tu';
        // Tambahkan case untuk role lainnya jika diperlukan
        default:
            die("Peran tidak valid!");
    }
}

// Fungsi untuk mengarahkan ke halaman dashboard sesuai peran
function redirectToDashboard($role) {
    switch ($role) {
        case 'siswa':
            header("Location: dashboardSiswa.php");
            break;
        case 'guru':
            header("Location: dashboardGuru.php");
            break;
        case 'tu':
            header("Location: ./tatausaha/dashboardTu.php");
            break;
        // Tambahkan case untuk role lainnya jika diperlukan
        default:
            die("Peran tidak valid!");
    }
    exit(); // Pastikan untuk keluar setelah mengarahkan
}

// Fungsi untuk menampilkan pesan kesalahan menggunakan JavaScript
function showErrorMessage($message) {
    ?>
    <script>
        alert("<?php echo $message; ?>");
        window.location.href = "index.php";
    </script>
    <?php
    exit(); // Pastikan untuk keluar setelah mengarahkan
}
?>
