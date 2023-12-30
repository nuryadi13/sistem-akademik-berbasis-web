<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ujian Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Form Ujian Online</h2>
    <form action="proses_ujian.php" method="POST">
        <div class="form-group">
            <label for="jenis_ujian">Jenis Ujian:</label>
            <select class="form-control" name="jenis_ujian" required>
                <option value="" selected>Pilih Jenis Ujian</option>
                <option value="UTS">Ujian Tengah Semester</option>
                <option value="UAS">Ujian Akhir Semester</option>
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
            <label for="durasi_ujian">Durasi Ujian (menit):</label>
            <input type="number" class="form-control" name="durasi_ujian" required>
        </div>

        <!-- Formulir dinamis untuk pertanyaan dan jawaban -->
        <div id="pertanyaan-container">
            <!-- Pertanyaan dan jawaban pertama -->
            <div class="pertanyaan">
                <div class="form-group">
                    <label for="pertanyaan">Pertanyaan 1:</label>
                    <textarea class="form-control" name="pertanyaan[]" rows="3" required></textarea>
                </div>
                <label>Opsi Jawaban:</label>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">A</span>
                        </div>
                        <input type="text" class="form-control" name="opsi_jawaban[1][A]" placeholder="Opsi Jawaban A" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="radio" name="jawaban[1]" value="A" required>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="keterangan[1][A]" placeholder="Keterangan Jawaban A" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">B</span>
                        </div>
                        <input type="text" class="form-control" name="opsi_jawaban[1][B]" placeholder="Opsi Jawaban B" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="radio" name="jawaban[1]" value="B" required>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="keterangan[1][B]" placeholder="Keterangan Jawaban B" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">C</span>
                        </div>
                        <input type="text" class="form-control" name="opsi_jawaban[1][C]" placeholder="Opsi Jawaban C" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="radio" name="jawaban[1]" value="C" required>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="keterangan[1][C]" placeholder="Keterangan Jawaban C" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">D</span>
                        </div>
                        <input type="text" class="form-control" name="opsi_jawaban[1][D]" placeholder="Opsi Jawaban D" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input type="radio" name="jawaban[1]" value="D" required>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="keterangan[1][D]" placeholder="Keterangan Jawaban D" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary" onclick="tambahPertanyaan()">Tambah Pertanyaan</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
function tambahPertanyaan() {
    var container = document.getElementById('pertanyaan-container');
    var nomorPertanyaan = container.childElementCount + 1;

    var pertanyaanDiv = document.createElement('div');
    pertanyaanDiv.className = 'pertanyaan';
    pertanyaanDiv.innerHTML = '<div class="form-group">' +
        '<label for="pertanyaan">Pertanyaan ' + nomorPertanyaan + ':</label>' +
        '<textarea class="form-control" name="pertanyaan[]" rows="3" required></textarea>' +
        '</div>' +
        '<label>Opsi Jawaban:</label>' +
        '<div class="form-group">' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text">A</span>' +
        '</div>' +
        '<input type="text" class="form-control" name="opsi_jawaban[' + nomorPertanyaan + '][A]" placeholder="Opsi Jawaban A" required>' +
        '<div class="input-group-append">' +
        '<div class="input-group-text">' +
        '<input type="radio" name="jawaban[' + nomorPertanyaan + ']" value="A" required>' +
        '</div>' +
        '</div>' +
        '<input type="text" class="form-control" name="keterangan[' + nomorPertanyaan + '][A]" placeholder="Keterangan Jawaban A" required>' +
        '</div>' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text">B</span>' +
        '</div>' +
        '<input type="text" class="form-control" name="opsi_jawaban[' + nomorPertanyaan + '][B]" placeholder="Opsi Jawaban B" required>' +
        '<div class="input-group-append">' +
        '<div class="input-group-text">' +
        '<input type="radio" name="jawaban[' + nomorPertanyaan + ']" value="B" required>' +
        '</div>' +
        '</div>' +
        '<input type="text" class="form-control" name="keterangan[' + nomorPertanyaan + '][B]" placeholder="Keterangan Jawaban B" required>' +
        '</div>' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text">C</span>' +
        '</div>' +
        '<input type="text" class="form-control" name="opsi_jawaban[' + nomorPertanyaan + '][C]" placeholder="Opsi Jawaban C" required>' +
        '<div class="input-group-append">' +
        '<div class="input-group-text">' +
        '<input type="radio" name="jawaban[' + nomorPertanyaan + ']" value="C" required>' +
        '</div>' +
        '</div>' +
        '<input type="text" class="form-control" name="keterangan[' + nomorPertanyaan + '][C]" placeholder="Keterangan Jawaban C" required>' +
        '</div>' +
        '<div class="input-group mb-3">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text">D</span>' +
        '</div>' +
        '<input type="text" class="form-control" name="opsi_jawaban[' + nomorPertanyaan + '][D]" placeholder="Opsi Jawaban D" required>' +
        '<div class="input-group-append">' +
        '<div class="input-group-text">' +
        '<input type="radio" name="jawaban[' + nomorPertanyaan + ']" value="D" required>' +
        '</div>' +
        '</div>' +
        '<input type="text" class="form-control" name="keterangan[' + nomorPertanyaan + '][D]" placeholder="Keterangan Jawaban D" required>' +
        '</div>' +
        '</div>' +
        '</div>';
    container.appendChild(pertanyaanDiv);
}
</script>

</body>
</html>
