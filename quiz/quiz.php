<?php
include 'db.php';

// Menampilkan pertanyaan dan opsi jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionNumber = isset($_POST['questionNumber']) ? (int)$_POST['questionNumber'] : 1;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
} else {
    $questionNumber = 1;
    $action = '';
}

// Setiap kali tombol "Next" atau "Previous" diklik, update $questionNumber
$questionsPerPage = 3;
if ($action === 'next') {
    $questionNumber += $questionsPerPage;
} elseif ($action === 'prev') {
    $questionNumber -= $questionsPerPage;
}

// Pastikan $questionNumber tidak kurang dari 1
$questionNumber = max(1, $questionNumber);

$sql = "SELECT * FROM questions LIMIT $questionNumber, $questionsPerPage"; // Limit the number of questions per page
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<form id="quizForm" action="submit_quiz.php" method="post">';

    while ($row = $result->fetch_assoc()) {
        echo '<div class="question">';
        echo '<p>' . htmlspecialchars($row['question_text'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<input type="radio" name="q'.$row['id'].'" value="A"> ' . htmlspecialchars($row['option_a'], ENT_QUOTES, 'UTF-8') . '<br>';
        echo '<input type="radio" name="q'.$row['id'].'" value="B"> ' . htmlspecialchars($row['option_b'], ENT_QUOTES, 'UTF-8') . '<br>';
        echo '<input type="radio" name="q'.$row['id'].'" value="C"> ' . htmlspecialchars($row['option_c'], ENT_QUOTES, 'UTF-8') . '<br>';
        echo '</div>';
    }

    echo '<input type="hidden" id="questionNumber" name="questionNumber" value="' . $questionNumber . '">';
    echo '<input type="hidden" name="action" id="action" value="">'; // Hidden field to store action value
    echo '<input type="button" id="submitBtn" value="Submit" onclick="submitForm()">';
    if ($questionNumber > 1) {
        echo '<button type="button" id="prevBtn" class="btn btn-primary" onclick="prevQuestion()">Previous</button>';
    }
    echo '<button type="button" id="nextBtn" class="btn btn-primary" onclick="nextQuestion()">Next</button>';
    echo '</form>';
} else {
    echo "Tidak ada pertanyaan.";
}
$conn->close();
?>

<script>
    function nextQuestion() {
        document.getElementById('action').value = 'next';
        document.getElementById('quizForm').submit();
    }

    function prevQuestion() {
        document.getElementById('action').value = 'prev';
        document.getElementById('quizForm').submit();
    }

    function submitForm() {
        document.getElementById('quizForm').submit();
    }
</script>
