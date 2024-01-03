<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "db_akademik_nh";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data siswa berdasarkan ID
    $sql_edit = "SELECT * FROM siswa WHERE id = $id";
    $result_edit = $conn->query($sql_edit);

    if ($result_edit->num_rows > 0) {
        $row_edit = $result_edit->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <title>Edit Data Siswa</title>
            <style>
                body {
                    background-color: #5776E5;
                }

                .container {
                    max-width: 400px;
                }

                .form-group {
                    margin-bottom: 1.5rem;
                }
            </style>
        </head>
        <body>

        <div class="container mt-5">
            <h2 class="text-center">Edit Data Siswa</h2>
            <form action="proses_edit_data_siswa.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row_edit['id']; ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row_edit['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="nis">NIS:</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $row_edit['nis']; ?>">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas:</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $row_edit['kelas']; ?>">
                </div>
                <div class="form-group">
                    <label for="no_whatsapp">No. WhatsApp:</label>
                    <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="<?php echo $row_edit['no_whatsapp']; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        </body>
        </html>
        <?php
    } else {
        echo "Data siswa tidak ditemukan.";
    }

    // Tutup koneksi
    $conn->close();
} else {
    echo "Invalid request";
}
?>
