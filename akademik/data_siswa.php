<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Data Siswa</title>
    <style>
        body {
      background-color: #5776E5;
    }
    </style>
</head>
<body>

<div class="container mt-5">
    <a href="dashboardGuru.php"><h2 class="btn btn-warning">< Kembali</h2></a><br>
    <h3 class="text-center" style="color:aliceblue">Pengelolaan Data Siswa</h3>
    <a href="register.php"><h2 class="btn btn-success">Tambah</h2></a>
    <table class="table" style="background-color: white;">
        <thead>
            <tr>
                <th>Username</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>No. WhatsApp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Gantilah bagian berikut dengan koneksi database Anda
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_akademik_nh";

                // Buat koneksi
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Tentukan jumlah data yang ditampilkan per halaman
                $limit = 10;

                // Tentukan halaman saat ini
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Hitung offset berdasarkan halaman saat ini
                $offset = ($page - 1) * $limit;

                // Query untuk mendapatkan data siswa dengan batasan jumlah
                $sql = "SELECT username, id, nis, kelas, no_whatsapp FROM siswa LIMIT $offset, $limit";
                $result = $conn->query($sql);

                // Tampilkan data dalam tabel
                if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["username"] . "</td>
                                <td>" . $row["nis"] . "</td>
                                <td>" . $row["kelas"] . "</td>
                                <td>" . $row["no_whatsapp"] . "</td>
                                <td><a href='edit_data_siswa.php?id=" . $row["id"] . "' class='btn btn-success'>Edit</a>
                                <a href='#' onclick='confirmDelete(" . $row["id"] . ")' class='btn btn-danger'>Delete</a>
                            </tr>";
                    }

                } else {
                    echo "<tr><td colspan='4'>Tidak ada data siswa</td></tr>";
                }

                // Tutup koneksi
            ?>
        </tbody>
    </table>

    <!-- Tambahkan navigasi Next -->
    <div class="pagination justify-content-center">
        <?php
            // Hitung total jumlah halaman
            $sql_count = "SELECT COUNT(*) AS total FROM siswa";
            $result_count = $conn->query($sql_count);
            $row_count = $result_count->fetch_assoc();
            $total_pages = ceil($row_count['total'] / $limit);

            // Tampilkan tombol Next jika halaman lebih dari 1
            if ($total_pages > 1) {
                echo "<a href='?page=".($page + 1)."' class='btn btn-primary'>Next</a>";
            }
                $conn->close();
        ?>
    </div>
</div>

<!-- hapus data -->

<script>
function confirmDelete(id) {
    // Tampilkan alert konfirmasi
    var confirmation = confirm("Apakah Anda yakin ingin menghapus data siswa ini?");

    // Jika pengguna mengonfirmasi, redirect ke halaman hapus_data_siswa.php dengan parameter ID
    if (confirmation) {
        window.location.href = 'hapus_data_siswa.php?id=' + id;
    }
}
</script>


<!-- end hapus -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
