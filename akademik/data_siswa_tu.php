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
            color: #fff;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .btn-back {
            background-color: #ffc107;
            color: #212529;
            margin-bottom: 20px;
        }

        .table {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="./tatausaha/dashboardTu.php" class="btn btn-back">&lt;&lt; Kembali</a>
        <h2 class="text-center"  style="color:black; font-family:'Courier New', Courier, monospace;">DATA SISWA</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>No. WhatsApp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_akademik_nh";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $limit = 10;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $sql = "SELECT username, nis, kelas, no_whatsapp FROM siswa LIMIT $offset, $limit";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["username"] . "</td>
                                <td>" . $row["nis"] . "</td>
                                <td>" . $row["kelas"] . "</td>
                                <td>" . $row["no_whatsapp"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data siswa</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="pagination justify-content-center">
            <?php
            $sql_count = "SELECT COUNT(*) AS total FROM siswa";
            $result_count = $conn->query($sql_count);
            $row_count = $result_count->fetch_assoc();
            $total_pages = ceil($row_count['total'] / $limit);

            if ($total_pages > 1) {
                echo "<a href='?page=" . ($page + 1) . "' class='btn btn-primary'>Next</a>";
            }
            ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
