<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
} else {
    $action = '';
}

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quiz Form</title>
        <style>
            body {
                font-family: "Arial", sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }

            #quizForm {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .question {
                margin-bottom: 15px;
                opacity: 0;
                transform: translateY(-20px);
                transition: opacity 0.5s, transform 0.5s;
            }

            .question.show {
                opacity: 1;
                transform: translateY(0);
            }

            #submitBtn {
                background-color: #4caf50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <form id="quizForm" action="submit_quiz.php" method="post">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="question" data-correct-option="<?= htmlspecialchars($row['correct_option'], ENT_QUOTES, 'UTF-8') ?>">
                    <p><?= htmlspecialchars($row['question_text'], ENT_QUOTES, 'UTF-8') ?></p>
                    <input type="radio" name="q<?= $row['id'] ?>" value="A"> <?= htmlspecialchars($row['option_a'], ENT_QUOTES, 'UTF-8') ?><br>
                    <input type="radio" name="q<?= $row['id'] ?>" value="B"> <?= htmlspecialchars($row['option_b'], ENT_QUOTES, 'UTF-8') ?><br>
                    <input type="radio" name="q<?= $row['id'] ?>" value="C"> <?= htmlspecialchars($row['option_c'], ENT_QUOTES, 'UTF-8') ?><br>
                </div>
                <?php
            }
            ?>
            <input type="hidden" id="action" name="action" value="">
            <input type="button" id="submitBtn" value="Submit" onclick="submitForm()">
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var questions = document.querySelectorAll(".question");
                questions.forEach(function (question) {
                    question.classList.add("show");
                });
            });

            function submitForm() {
                var totalQuestions = document.querySelectorAll('.question').length;
                var correctAnswers = 0;

                var questions = document.querySelectorAll('.question');
                questions.forEach(function (question) {
                    var radioButtons = question.querySelectorAll('input[type="radio"]');
                    var correctOption = question.getAttribute('data-correct-option');
                    var answeredCorrectly = false;

                    radioButtons.forEach(function (radioButton) {
                        if (radioButton.checked && radioButton.value === correctOption) {
                            correctAnswers++;
                            answeredCorrectly = true;
                        }
                    });

                    // Set skor menjadi 0 jika tidak ada jawaban yang benar
                    if (!answeredCorrectly) {
                        correctAnswers = 0;
                    }
                });

                var percentage = (correctAnswers / totalQuestions) * 100;
                percentage = Math.min(100, percentage); // Maksimum persentase 100

                alert("Jawaban benar: " + correctAnswers + "/" + totalQuestions + "\nPersentase Benar: " + percentage + "%");

                document.getElementById("action").value = "submit";
                document.getElementById('quizForm').submit();
            }
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Tidak ada pertanyaan.";
}
$conn->close();
?>
