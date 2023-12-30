<?php
include 'db.php'; // Sertakan file koneksi database

// Proses penambahan soal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = $_POST['question_text'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $correct_option = $_POST['correct_option'];

    $sql = "INSERT INTO questions (question_text, option_a, option_b, option_c, correct_option) 
            VALUES ('$question_text', '$option_a', '$option_b', '$option_c', '$correct_option')";

    if ($conn->query($sql) === TRUE) {
        // Tambahkan script JavaScript untuk alert
        echo "<script>alert('Soal berhasil ditambahkan!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Penambahan Soal</title>
    <!-- Tambahkan referensi Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-3">Tambah Soal Baru</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="question_text">Pertanyaan:</label>
                <textarea class="form-control" name="question_text" id="question_text" required></textarea>
            </div>

            <div class="form-group">
                <label for="option_a">Opsi A:</label>
                <input type="text" class="form-control" name="option_a" id="option_a" required>
            </div>

            <div class="form-group">
                <label for="option_b">Opsi B:</label>
                <input type="text" class="form-control" name="option_b" id="option_b" required>
            </div>

            <div class="form-group">
                <label for="option_c">Opsi C:</label>
                <input type="text" class="form-control" name="option_c" id="option_c" required>
            </div>

            <div class="form-group">
                <label>Pilih Jawaban Benar:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_option" id="correct_option_a" value="A" required>
                    <label class="form-check-label" for="correct_option_a">A</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_option" id="correct_option_b" value="B" required>
                    <label class="form-check-label" for="correct_option_b">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correct_option" id="correct_option_c" value="C" required>
                    <label class="form-check-label" for="correct_option_c">C</label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Tambah Soal</button>
        </form>
    </div>

    <!-- Tambahkan referensi Bootstrap JavaScript dan jQuery jika diperlukan -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
