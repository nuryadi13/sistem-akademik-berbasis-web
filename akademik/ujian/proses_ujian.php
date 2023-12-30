<?php
// ... (kode koneksi database tetap sama) ...
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_akademik_nh";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi berhasil";

// Ambil data dari form
$jenis_ujian = $_POST['jenis_ujian'];
$mata_pelajaran = $_POST['mata_pelajaran'];
$durasi_ujian = $_POST['durasi_ujian'];

// Simpan data ke dalam tabel ujian
$sqlUjian = "INSERT INTO ujian (jenis_ujian, mata_pelajaran, durasi_ujian) VALUES ('$jenis_ujian', '$mata_pelajaran', $durasi_ujian)";

if ($conn->query($sqlUjian) === TRUE) {
    // Ambil ID ujian yang baru saja dimasukkan
    $id_ujian = $conn->insert_id;

    // Simpan pertanyaan dan jawaban ke dalam tabel pertanyaan
    if (isset($_POST['pertanyaan']) && isset($_POST['opsi_jawaban']) && isset($_POST['jawaban'])) {
        $pertanyaanArray = $_POST['pertanyaan'];
        $opsiJawabanArray = $_POST['opsi_jawaban'];
        $jawabanArray = $_POST['jawaban'];

        // Pastikan jumlah pertanyaan, opsi jawaban, dan jawaban sama
        if (count($pertanyaanArray) == count($opsiJawabanArray) && count($pertanyaanArray) == count($jawabanArray)) {
            for ($i = 0; $i < count($pertanyaanArray); $i++) {
                $pertanyaan = $conn->real_escape_string($pertanyaanArray[$i]);

                // Simpan pertanyaan ke dalam tabel pertanyaan
                $sqlPertanyaan = "INSERT INTO pertanyaan (id_ujian, pertanyaan) VALUES ($id_ujian, '$pertanyaan')";

                if ($conn->query($sqlPertanyaan)) {
                    // Ambil ID pertanyaan yang baru saja dimasukkan
                    $id_pertanyaan = $conn->insert_id;

                    // Simpan opsi jawaban dan jawaban ke dalam tabel opsi_jawaban
                    if (isset($opsiJawabanArray[$i]) && isset($jawabanArray[$i])) {
                        foreach ($opsiJawabanArray[$i] as $key => $opsiJawaban) {
                            $opsiJawaban = $conn->real_escape_string($opsiJawaban);
                            $jawaban = ($key == $jawabanArray[$i]) ? 1 : 0;

                            $sqlOpsiJawaban = "INSERT INTO opsi_jawaban (id_pertanyaan, opsi_jawaban, jawaban) VALUES ($id_pertanyaan, '$opsiJawaban', $jawaban)";
                            $conn->query($sqlOpsiJawaban);
                        }
                    }
                } else {
                    echo "Error: " . $sqlPertanyaan . "<br>" . $conn->error;
                    break; // Hentikan loop jika terjadi kesalahan
                }
            }
            echo "Data berhasil disimpan.";
        } else {
            echo "Jumlah pertanyaan, opsi jawaban, dan jawaban tidak sama.";
        }
    }
} else {
    echo "Error: " . $sqlUjian . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
