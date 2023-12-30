<?php
include 'db.php';

// Proses penilaian jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalQuestions = 0;
    $answeredQuestions = 0;
    $incorrectAnswers = 0;

    // Loop melalui data yang dikirimkan melalui formulir
    foreach ($_POST as $key => $value) {
        // Pastikan bahwa kunci pertanyaan dimulai dengan 'q' dan nilainya adalah 'A', 'B', atau 'C'
        if (strpos($key, 'q') === 0) {
            $question_id = substr($key, 1); // Ambil bagian setelah 'q' untuk mendapatkan ID pertanyaan

            // Ambil jawaban yang benar dari database
            $sql = "SELECT correct_option FROM questions WHERE id = ?";
            
            // Gunakan prepared statement untuk mencegah SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $question_id);
            $stmt->execute();
            
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $correct_option = $row['correct_option'];

                // Periksa apakah jawaban yang dikirimkan sama dengan jawaban yang benar
                if ($value === $correct_option) {
                    $answeredQuestions++;
                } elseif (!empty($value)) {
                    $incorrectAnswers++;
                }
            }

            $totalQuestions++;
        }
    }

    // Tambahkan penanganan kesalahan jika total pertanyaan nol
    if ($totalQuestions > 0) {
        // Hitung skor berdasarkan persentase jawaban yang benar
        $score = ($answeredQuestions - $incorrectAnswers) / $totalQuestions * 100;

        // Tampilkan skor dalam bilangan bulat
        echo "Skor Anda: " . round($score);

        // Tampilkan peringatan jika ada pertanyaan yang belum terjawab saat tombol "Submit" ditekan
        if ($answeredQuestions < $totalQuestions) {
            echo "<br>Penting: Ada pertanyaan yang belum terjawab. Harap lengkapi semua pertanyaan sebelum mengirimkan.";
        }
    } else {
        echo "Tidak ada pertanyaan yang dijawab. Silakan kembali ke halaman sebelumnya.";
    }
} else {
    // Jika formulir tidak dikirimkan, kembalikan ke halaman sebelumnya atau berikan pesan kesalahan
    echo "Terjadi kesalahan. Silakan kembali ke halaman sebelumnya.";
}

$conn->close();
?>
