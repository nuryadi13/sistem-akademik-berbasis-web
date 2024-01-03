<?php
// Mulai sesi jika belum dimulai
session_start();

// Gantilah ini dengan cara sesuai implementasi login Anda
// Contoh: Jika Anda menyimpan username dalam sesi, maka dapatkan nilai sesi tersebut
if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'guru') {
    $username = $_SESSION['username'];
} else {
    header("Location: index.php");
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
<div class="container mt-3 text-center">
    <div class="row justify-content-end">
        <div class="col-md-4">
            <!-- Tambahkan atribut name pada input untuk memudahkan mendapatkan nilai pencarian -->
            <form id="searchForm" method="GET" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari siswa..." name="search">
                    <!-- Tambahkan atribut form dan type="submit" pada button untuk menentukan formulir yang akan dikirimkan -->
                    <button class="btn btn-outline-secondary" type="submit" form="searchForm">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- tabel -->
<main class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Kelola Data
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="data_siswa.php">Kelola Data Siswa</a></li>
          <li><a class="dropdown-item" href="nilai.php">Nilai Siswa</a></li>
        </ul>
  </div><br>

  <a href="../quiz/tambah_soal.php"><button class="btn btn-success">Tambah Ujian</button></a>
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
            // Dapatkan nilai pencarian dari formulir
                $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                // Query untuk mendapatkan data siswa dengan pencarian
                $sql = "SELECT siswa.username, siswa.id AS siswa_id, siswa.kelas, penilaian.nis, penilaian.nilai, penilaian.mata_pelajaran 
                        FROM siswa
                        JOIN penilaian ON siswa.nis = penilaian.nis
                        WHERE siswa.username LIKE '%$searchTerm%'";

                $result = $conn->query($sql);


            // Menampilkan data dalam tabel
            // Menampilkan data dalam tabel
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["kelas"] . "</td>
                        <td>" . $row["mata_pelajaran"] . "</td>
                        <td>" . $row["nilai"] . "</td>
                        <td>
                            <button class='btn btn-info' data-siswa-id='" . $row["siswa_id"] . "' data-nis='" . $row["nis"] . "' data-mata-pelajaran='" . $row["mata_pelajaran"] ."'>Edit</button>
                            <button class='btn btn-danger' onclick='hapusData(" . $row["nis"] . ", \"" . $row["mata_pelajaran"] . "\")'>Hapus</button>
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
      var siswaId = button.getAttribute('data-siswa-id');
      if (siswaId) {
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
            window.location.href = 'edit_data_siswa.php?id=' + siswaId;
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
      } else {
        console.error("Attribute 'data-siswa-id' not found on the button.");
      }
    });
  });
</script>

<!-- ... (Kode HTML lainnya) ... -->

<script>
function hapusData(nis, mataPelajaran) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "hapus_data_nilai_siswa.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            Swal.fire('Sukses!', 'Data berhasil dihapus.', 'success');
                            location.reload();
                        } else {
                            Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                        }
                    } else {
                        Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                    }
                }
            };

            xhr.send("nis=" + nis + "&mataPelajaran=" + mataPelajaran);
        }
    });
}
</script>

<!-- ... (Kode HTML lainnya) ... -->

<script>
    // Tambahkan event listener untuk menangani pengiriman formulir pencarian
    document.getElementById("searchForm").addEventListener("submit", function (event) {
        // Cegah pengiriman formulir secara default
        event.preventDefault();

        // Dapatkan nilai pencarian dari formulir
        var searchTerm = document.querySelector("#searchForm input[name='search']").value;

        // Kirim permintaan AJAX ke server untuk mendapatkan hasil pencarian
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "dashboard_guru.php?search=" + encodeURIComponent(searchTerm), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Perbarui tabel dengan hasil pencarian
                document.querySelector("tbody").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


</body>
</html>
