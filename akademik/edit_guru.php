<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Edit Guru</title>
</head>
<body>
    <div class="container">
        <h2>Edit Guru</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_akademik_nh";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $guru_id = $_GET["id"];

            $sql = "SELECT * FROM guru WHERE id = $guru_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nama = $row["nama"];
                $username = $row["username"];
                $mata_pelajaran = $row["mata_pelajaran"];
            } else {
                echo "Guru tidak ditemukan.";
                exit();
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $guru_id = $_POST["id"];
            $nama = $_POST["nama"];
            $username = $_POST["username"];
            $mata_pelajaran = $_POST["mata_pelajaran"];

            $sql = "UPDATE guru SET nama='$nama', username='$username', mata_pelajaran='$mata_pelajaran' WHERE id=$guru_id";

            if ($conn->query($sql) === TRUE) {
                echo "Data guru berhasil diupdate. <a href='index.php'>Kembali</a>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $guru_id; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="form-group">
                <label for="mata_pelajaran">Mengajar:</label>
                <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" value="<?php echo $mata_pelajaran; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
