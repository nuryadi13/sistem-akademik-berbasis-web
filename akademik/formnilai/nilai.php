<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Siswa</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Form Nilai Siswa</h2>
    <form action="proses_nilai.php" method="post">
        <div class="form-group">
            <label for="nama">Nama Siswa:</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="form-group">
            <label for="nilai_matematika">Nilai Matematika:</label>
            <input type="number" class="form-control" name="nilai_matematika" required>
        </div>

        <div class="form-group">
            <label for="nilai_bahasa_indonesia">Nilai Bahasa Indonesia:</label>
            <input type="number" class="form-control" name="nilai_bahasa_indonesia" required>
        </div>

        <div class="form-group">
            <label for="nilai_ipa">Nilai IPA:</label>
            <input type="number" class="form-control" name="nilai_ipa" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Add Bootstrap JS and Popper.js if needed -->
    <!--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    -->
</body>
</html>
