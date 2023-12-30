<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $nama = $_POST["nama"];
    $nilai_matematika = $_POST["nilai_matematika"];
    $nilai_bahasa_indonesia = $_POST["nilai_bahasa_inggris"];

    // Menghitung rata-rata nilai
    $rata_rata = ($nilai_matematika + $nilai_bahasa_indonesia + $nilai_ipa) / 3;

    // Menyimpan nilai dalam sesi
    $_SESSION['nama'] = $nama;
    $_SESSION['nilai_matematika'] = $nilai_matematika;
    $_SESSION['nilai_bahasa_inggris'] = $nilai_bahasa_indonesia;

    // Redirect ke halaman lain untuk menampilkan hasil
    header("Location: hasil_nilai.php");
    exit();
}
?>
