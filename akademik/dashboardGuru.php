<?php
// Mulai sesi jika belum dimulai
session_start();

// Gantilah ini dengan cara sesuai implementasi login Anda
// Contoh: Jika Anda menyimpan username dalam sesi, maka dapatkan nilai sesi tersebut
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Jika tidak ada sesi, gantilah ini dengan cara lain sesuai implementasi login Anda
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <style>
    body {
      background-color: #5776E5;
    }
    .button{
        margin-left: 240px;
    }
    @media (max-width: 768px) {
      .button {
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
      padding: 10px;
    }
    /* footer {
      padding: 20px;
      background-color: #e9ecef;
      text-align: center;
    } */
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
  <h1 class="text-white header">Dashboard Guru</h1>
  <div class="d-flex align-items-center">
    <h2 class="user-name me-2 nama"><?php echo $_SESSION['username'];?>  &nbsp;<i class="fas fa-user"></i></h2>
  </div>
</header>
<div class="container mt-3">
  <div class="row justify-content-end">
    <div class="col-md-4">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari siswa...">
        <button class="btn btn-outline-secondary" type="button">Cari</button>
      </div>
    </div>
  </div>
</div>
<!-- tabel -->
<main class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="data_siswa.php"><button class="btn btn-warning"><li class="fas fa-eye"></li>  Lihat Data Siswa</button></a><br><br>
      <a href="nilai.php"><button class="btn btn-success">Nilai Siswa</button></a><br><br>
      <h3 class="text-center">Daftar Nilai Siswa</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- kode php -->
          <?php
            // Koneksi ke database
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $db_name = "db_akademik_nh";

            $conn = new mysqli($servername, $db_username, $db_password, $db_name);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Query untuk mendapatkan data siswa
            $sql = "SELECT siswa.username, siswa.id AS siswa_id, siswa.kelas, penilaian.nis, penilaian.nilai, penilaian.mata_pelajaran 
                    FROM siswa
                    JOIN penilaian ON siswa.nis = penilaian.nis";

            $result = $conn->query($sql);

            // Menampilkan data dalam tabel
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . $row["username"] . "</td>
                      <td>" . $row["kelas"] . "</td>
                      <td>" . $row["mata_pelajaran"] . "</td>
                      <td>" . $row["nilai"] . "</td>
                      <td>
                        <button class='btn btn-info' data-siswa-id='" . $row["siswa_id"] . "' data-nis='" . $row["nis"] . "' data-mata-pelajaran='" . $row["mata_pelajaran"] . "'>Edit</button>
                        <button class='btn btn-danger'>Hapus</button>
                      </td>
                    </tr>";
            }

            // Menutup koneksi
            $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<button class="button btn btn-dark logout" id="logoutButton">Logout</button>
<br><br>

<footer>
  <p class="text-center">All rights reserved by Nuryadi</p>
</footer>

<script>
  // Dapatkan referensi ke tombol logout menggunakan id
  var logoutButton = document.getElementById("logoutButton");

  // Tambahkan event listener untuk menangani klik pada tombol logout
  logoutButton.addEventListener("click", function() {
    // Tempatkan kode logout atau tindakan lainnya di sini
    // Contoh: Redirect ke halaman login
    window.location.href = "index.php";
  });
</script>

<script src="../assets/fontawesome/js/all.js"></script>

<!-- edit -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- edit -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- edit -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelectorAll('.btn-info').forEach(function(button) {
  button.addEventListener('click', function() {
    var nis = button.getAttribute('data-nis');
    var mataPelajaran = button.getAttribute('data-mata-pelajaran');
    Swal.fire({
      title: 'Pilih Edit',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Edit Siswa',
      cancelButtonText: 'Edit Nilai',
      cancelButtonColor: '#d33',
      showCloseButton: true,
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika user memilih Edit Siswa, redirect ke halaman data_siswa.php
        var siswaId = button.getAttribute('data-siswa-id');
        window.location.href = 'edit_siswa.php?id=' + siswaId;
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // Jika user memilih Edit Nilai, tampilkan dialog untuk memasukkan nilai baru
        Swal.fire({
          title: 'Edit Nilai',
          input: 'text',
          inputLabel: 'Masukkan Nilai Baru',
          inputPlaceholder: 'Nilai',
          showCancelButton: true,
          confirmButtonText: 'Simpan',
          cancelButtonText: 'Batal',
          inputValidator: (value) => {
            if (!value) {
              return 'Mohon masukkan nilai';
            }
          }
        }).then((result) => {
          if (result.isConfirmed) {
            var siswaId = button.getAttribute('data-siswa-id');
            var newValue = result.value; // Nilai yang dimasukkan oleh pengguna

            // Kirim permintaan AJAX ke halaman server-side untuk menyimpan nilai ke database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_nilai.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
              if (xhr.readyState == 4 && xhr.status == 200) {
                // Tanggapi dari server (misalnya: 'success' atau 'error')
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                  // Tampilkan pesan sukses jika nilai berhasil diubah
                  Swal.fire('Sukses!', 'Nilai berhasil diubah.', 'success');
                } else {
                  // Tampilkan pesan kesalahan jika terdapat masalah
                  Swal.fire('Error!', 'Gagal mengubah nilai.', 'error');
                }
              }
            };

            // Kirim data ke server-side
            xhr.send("siswaId=" + siswaId + "&nis=" + nis + "&mataPelajaran=" + mataPelajaran + "&newValue=" + newValue);
          }
        });
      }
    });
  });
});
</script>



</body>
</html>
