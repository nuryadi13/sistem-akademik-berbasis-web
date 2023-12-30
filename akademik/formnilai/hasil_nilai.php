<?php
session_start();

// Mengambil nilai dari sesi
$nama = $_SESSION['nama'];
$nilai_matematika = $_SESSION['nilai_matematika'];
$nilai_bahasa_indonesia = $_SESSION['nilai_bahasa_indonesia'];
$nilai_ipa = $_SESSION['nilai_ipa'];
$rata_rata = $_SESSION['rata_rata'];

// Hapus data sesi
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Nilai Siswa</title>
</head>
<body>
    <h2>Hasil Nilai Siswa</h2>
    <p>Nama Siswa: <?php echo $nama; ?></p>
    <p>Nilai Matematika: <?php echo $nilai_matematika; ?></p>
    <p>Nilai Bahasa Indonesia: <?php echo $nilai_bahasa_indonesia; ?></p>
    <p>Nilai IPA: <?php echo $nilai_ipa; ?></p>
    <p>Rata-rata Nilai: <?php echo $rata_rata; ?></p>
</body>
</html>
