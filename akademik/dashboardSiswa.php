<?php
session_start();
$_SESSION['username'] = "username"; 
// login
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

// Tambahkan variabel NIS pada sesi jika ada
$nis = isset($_SESSION['nis']) ? $_SESSION['nis'] : '';

$servername = "localhost";
$db_username = "root";
$password = "";
$database = "db_akademik_nh";

// Membuat koneksi
$conn = new mysqli($servername, $db_username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// JOIN tabel siswa dan penilaian
$sql = "SELECT siswa.*, penilaian.*, siswa.username FROM siswa JOIN penilaian ON siswa.nis = penilaian.nis WHERE siswa.nis = '$nis'";
$result = $conn->query($sql);

// Ambil hasil query dan set variabel sesuai dengan data yang diperoleh
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username_siswa = $row['username'];
    $mata_pelajaran = $row['mata_pelajaran'];
    $jenis_ujian = $row['jenis_ujian'];
    $nilai = $row['nilai'];
} else {
    // Atur default jika data tidak ditemukan
    $mata_pelajaran = 'belum ada mata pelajaran';
    $jenis_ujian = 'belum ada jenis ujian';
    $nilai = 'belum ada nilai';
}
$sqlGetUsername = "SELECT username FROM siswa WHERE nis = '{$_SESSION['nis']}'";
$resultUsername = $conn->query($sqlGetUsername);

// Periksa apakah query berhasil dan hasilnya ada
if ($resultUsername && $resultUsername->num_rows > 0) {
    $rowUsername = $resultUsername->fetch_assoc();
    $authenticatedUsername = $rowUsername['username'];

    // Simpan nama pengguna ke dalam sesi
    $_SESSION['username'] = $authenticatedUsername;
} else {
    // Handle kesalahan jika tidak dapat mengambil nama pengguna dari database
    $_SESSION['username'] = 'Guest'; // Atur default jika tidak ditemukan
}
// Mengambil informasi pengguna dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <style>
    body {
      background-color: #5776E5;
    }
    .button{
        margin-left: 200px;
    }
    @media (max-width: 768px) {
  .button {

    margin-left: 10px; /* Menjadikan margin-left menjadi 0 pada tampilan mobile */
  }
}
   @media (max-width: 768px) {
  .logout {
    margin-left: 10px; /* Menjadikan margin-left menjadi 0 pada tampilan mobile */
  }
}
@media  (max-width: 768px){
    .header{
    font-size: 16px;
    display: inline;
    }
}
    .nama{
        color: #FFFFFF;
    }
    .header {
      padding: 20px;
      background-color: #68746E; /* Change to your desired gray background color */
      color: #333; /* Change to your desired text color */
    }
    main {
      padding: 20px;
    }
    footer {
      padding: 20px;
      text-align: center;
    }
    .list-group-item {
      border: none;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .list-group-item:hover {
      background-color: #f1f5f9;
    }
    .container {
      max-width: 900px;
    }
    .row {
      margin-top: 20px;
    }
    h1, h2, h3 {
      margin-bottom: 20px;
    }
    /* Add a new class for the user's name with a different style */
    .user-name {
      font-size: 24px;
      font-weight: bold;
      color: #ffff; /* Change to your desired color */
    }
  </style>
</head>
<body>


<header class="container d-flex justify-content-between align-items-center">
  <h1 class="text-white header">Dashboard Siswa</h1>
  <div class="d-flex align-items-center">
    <h2 class="user-name me-2 nama"><?php echo $username; ?> &nbsp;<i class="fas fa-user"></i></h2>

    
  </div>
</header>
<?php
// Tambahkan variabel pencarian
$search = isset($_POST['search']) ? $_POST['search'] : '';


// Modifikasi query SQL untuk mencari berdasarkan mata pelajaran
$sql = "SELECT siswa.*, penilaian.*, siswa.username 
        FROM siswa 
        JOIN penilaian ON siswa.nis = penilaian.nis 
        WHERE siswa.nis = '$nis'";

// Tambahkan kondisi pencarian jika ada kata kunci pencarian
if (!empty($search)) {
  $sql .= " AND penilaian.mata_pelajaran LIKE '%$search%'";
}

$result = $conn->query($sql);

?>
<div class="container mt-3">
  <div class="row justify-content-end">
    <div class="col-md-4">
      <form action="" method="post">
        <div class="input-group">
          <input type="text" class="form-control" name="search" placeholder="Cari nilai ujian...">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>
</div>

<main class="container">
  <div class="row">
    <div class="col-md-6">
      <p>Kerjakan Ujian Online <a href="../quiz/quiz.php"><button class="btn btn-success">UJIAN</button></a></p>
      <button style="background-color:#050DD0; color:#fff; margin-bottom:10px; font-family:inter; font-size: 20px">Nilai Ujian</button>
      <ul class="list-group list-group-flush">

        <?php
        // Periksa apakah ada nilai yang ditemukan
        if ($result->num_rows > 0) {
          // Gunakan while loop untuk menampilkan nilai ujian
          while ($row = $result->fetch_assoc()) {
            $mata_pelajaran = $row['mata_pelajaran'];
            $jenis_ujian = $row['jenis_ujian'];
            $nilai = $row['nilai'];

            echo '<li class="list-group-item">';
            echo '<h5 class="mb-1">' . $mata_pelajaran . '</h5>';
            echo '<span class="text-muted">' . $jenis_ujian . '</span>';
            echo '<p class="mb-1">Nilai = ' . $nilai . '</p>';
            echo '</li>';
          }
        } else {
          // Tampilkan pemberitahuan default jika tidak ada nilai ujian
          echo '<p>Belum ada nilai ujian</p>';
        }
        ?>

      </ul>
    </div>
  </div>
</main>


<!-- Sesuaikan sesuai kebutuhan, gunakan tombol logout untuk menghapus sesi dan mengarahkan pengguna ke halaman login -->
<form action="logout.php" method="post">
    <button class="button btn btn-dark logout" type="submit" style="margin-left: 240px;">Logout</button>
</form>
<br><br>

<footer>
    <p>All rights reserved by Nuryadi</p>
</footer>

<!-- ... Kode script yang sudah ada ... -->

</body>
</html>
