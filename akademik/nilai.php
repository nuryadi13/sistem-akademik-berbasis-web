<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Form Input Nilai</title>
  <style>
    body {
        background-color: #5776E5;
    }
    .form-control {
        width: 300px; /* Sesuaikan panjang yang diinginkan */
    }
  </style>
</head>
<body>
    <br>
<h1 class="text-center" style="font-family :'Times New Roman', Times, serif; margin-bottom: 10px;"><b>PENILAIAN SISWA</b></h1>
  <div class="container mt-5 d-flex justify-content-center"" >
    <form action="proses_nilai.php" method="post">
       <div class="form-group">
        <label for="nis">NIS:</label>
        <input type="text" class="form-control" id="nis" name="nis" required placeholder="masukkan NIS">
      </div>

      <div class="form-group">
        <label for="jenis_ujian">Jenis Ujian:</label>
        <select class="form-control" id="jenis_ujian" name="jenis_ujian" required>
          <option value="" selected >Pilih Ujian</option>
          <option value="Ujian Tengah Semester">Ujian Tengah Semester</option>
          <option value="Ujian Akhir Semester">Ujian Akhir Semester</option>
        </select>
      </div>
      <div class="form-group">
        <label for="mata_pelajaran">Mata Pelajaran:</label>
        <select class="form-control" id="mata_pelajaran" name="mata_pelajaran" required>
          <option value="" selected>Pilih Mata Pelajaran</option>
          <option value="Matematika">Matematika</option>
          <option value="Fisika">Fisika</option>
          <option value="Kimia">Kimia</option>
          <option value="Biologi">Pendidikan Agama Islam</option>
          <option value="Bahasa Indonesia">Bahasa Indonesia</option>
          <option value="Bahasa Inggris">Bahasa Inggris</option>
        </select>
      </div>

      <div class="form-group">
        <label for="nilai">Nilai:</label>
        <input type="number" class="form-control" id="nilai" name="nilai"  placeholder="masukkan nilai" required>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
