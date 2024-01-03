<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Data Guru</title>
    <style>
        body {
            background-color: #007bff;
            color: #fff;
        }

        .container {
            margin-top: 50px;
            text-align: center;
        }

        .add {
            text-align: left;
        }

        .table-container {
            margin-top: 20px;
        }

        .table thead {
            background-color: #fff;
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #e9ecef;
        }

        .table-striped th,
        .table-striped td {
            color: #000;
        }

        .table-hover tbody tr:hover {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>INFORMASI DATA GURU</h2>
        <div class="add">
            <a href="./tatausaha/dashboardTu.php"><button class="btn btn-warning">Kembali</button></a>
            <a href="../akademik/registerguru.php"><button class="btn btn-success">Tambah</button></a>
        </div>
        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Mengajar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "db_akademik_nh";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT id, nama, username, mata_pelajaran FROM guru";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["nama"] . "</td>
                                        <td>" . $row["username"] . "</td>
                                        <td>" . $row["mata_pelajaran"] . "</td>
                                        <td>
                                            <a href='edit_guru.php?id=" . $row["id"] . "'><button class='btn btn-warning'>Edit</button></a>
                                            <a href='hapus_guru.php?id=" . $row["id"] . "'><button class='btn btn-danger'>Hapus</button></a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data guru</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
