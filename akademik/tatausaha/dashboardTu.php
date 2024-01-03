<?php
// Mulai sesi jika belum dimulai
session_start();

// // Gantilah ini dengan cara sesuai implementasi login Anda
// // Contoh: Jika Anda menyimpan username dalam sesi, maka dapatkan nilai sesi tersebut
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Jika tidak ada sesi, gantilah ini dengan cara lain sesuai implementasi login Anda
    header("Location: ../index.php");
    exit();
}

// Sample database connection
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

// Sample SELECT query

$sql = "SELECT siswa.username, siswa.kelas, siswa.no_whatsapp, pembayaran.status FROM siswa INNER JOIN pembayaran ON siswa.nis = pembayaran.nis";
$sql2 = "SELECT username FROM tu";
$result = $conn->query($sql2);
$result = $conn->query($sql);

// Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
      background-color: #5776E5;
    }
        main {
            padding: 20px;
        }
        .btn-dark {
            background-color: #343a40;
            color: #fff;
        }
        .table {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f5f9;
        }
        
        .fas, .fab {
            font-size: 1.2rem;
            margin-right: 5px;
        }
    </style>
</head>
<body>
  <header class="container d-flex justify-content-between align-items-center">
  <h1 style="background-color: #68746E;" class="text-white header">Dashboard Tata Usaha</h1>
  <div class="d-flex align-items-center">
    <h2 class="user-name me-2 nama"><?php echo $username; ?>  &nbsp;<i class="fas fa-user"></i></h2>
    
  </div>
</header>

<main class="container">
    <div class="row">
        <div class="col-md-12">
           <!-- <a href="../data_siswa.php"><button class="btn btn-dark mb-3">Data Siswa</button></a> 
            <a href="../bayar_spp.php">
                <button class="btn btn-dark mb-3">Data Pembayaran Siswa</button>
            </a> -->
            
            <!-- dropdawn -->
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kelola Data
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../data_siswa_tu.php">Data Siswa</a></li>
                <li><a class="dropdown-item" href="../bayar_spp.php ">Data Pembayaran</a></li>
                <li><a class="dropdown-item" href="../guru.php">Data Guru</a></li>
            </ul>
        </div><br>
            <!-- end dropdawn -->
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Nomor WhatsApp</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="siswaTableBody">
        <?php
        // Periksa apakah ada baris yang dikembalikan dari query
        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-whatsapp-number='" . $row["no_whatsapp"] . "' data-username='" . $row["username"] . "'>";
                // echo "<td>" . $usernameSession . "</td>"; 
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["kelas"] . "</td>";
                echo "<td>" . $row["no_whatsapp"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo '<td><i class="fas fa-microphone btn btn-success me-2"></i>' .
                    '<i class="fab fa-whatsapp btn btn-info"></i></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data tersedia</td></tr>";
        }
        ?>
    </tbody>
</table>
        </div>
    </div>
    <a href="../logout.php"><button class="button btn btn-dark logout" type="submit" style="margin-left: 0px;">Logout</button></a>
</main>

<?php 
$conn->close();
?>
<!-- ... (your existing HTML code) ... -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    var googleVoice; // Variabel untuk menyimpan suara Google

    // Tunggu sampai suara diinisialisasi sepenuhnya
    window.speechSynthesis.onvoiceschanged = function () {
        // Dapatkan daftar suara yang tersedia
        var voices = window.speechSynthesis.getVoices();

        // Temukan suara Google wanita
        googleVoice = voices.find(function (voice) {
            return voice.name === 'Google Bahasa Indonesia'; // Sesuaikan dengan nama suara Google wanita yang tersedia
        });
    };

    function handleWhatsAppClick(id) {
        var whatsappNumber = document.querySelector('tr[data-whatsapp-number="' + id + '"]').dataset.whatsappNumber;
        // Ubah link menjadi format yang langsung membuka kolom obrolan "WhatsApp Me"
        window.location.href = 'https://api.whatsapp.com/send?phone=' + whatsappNumber + '&text=WhatsApp%20Me';
    }

    function handleMicrophoneClick(id) {
        var username = document.querySelector('tr[data-whatsapp-number="' + id + '"]').dataset.username;
        var text = "Halo, siswa, dengan nama, " + username + ". Anda, dipanggil, oleh bagian, tata usaha.";

        var utterance = new SpeechSynthesisUtterance(text);

        // Setel suara Google sebagai suara utterance
        utterance.voice = googleVoice;

        window.speechSynthesis.speak(utterance);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var whatsappIcons = document.querySelectorAll('.fa-whatsapp');
        var microphoneIcons = document.querySelectorAll('.fa-microphone');

        whatsappIcons.forEach(function (whatsappIcon) {
            whatsappIcon.addEventListener('click', function () {
                var id = this.closest('tr').dataset.whatsappNumber;
                handleWhatsAppClick(id);
            });
        });

        microphoneIcons.forEach(function (microphoneIcon) {
            microphoneIcon.addEventListener('click', function () {
                var id = this.closest('tr').dataset.whatsappNumber;
                handleMicrophoneClick(id);
            });
        });
    });
</script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
