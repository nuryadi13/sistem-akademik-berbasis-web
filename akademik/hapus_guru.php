<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_akademik_nh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $guru_id = $_GET["id"];

    // JavaScript confirmation alert
    echo '<script>
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data?");
            if (confirmation) {
                window.location.href = "hapus_guru.php?confirmed=true&id=' . $guru_id . '";
            } else {
                window.location.href = "guru.php";
            }
          </script>';
}

// Actual deletion code
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["confirmed"]) && $_GET["confirmed"] == "true" && isset($_GET["id"])) {
    $guru_id = $_GET["id"];

    $sql = "DELETE FROM guru WHERE id = $guru_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Berhasil menghapus data!");</script>';
        header("Location: guru.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
