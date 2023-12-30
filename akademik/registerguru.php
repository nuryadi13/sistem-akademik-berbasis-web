<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <title>Document</title>
    <style>
        body {
            background: rgba(87, 118, 229, 0.75);
        }

        .input {
            background: #7b6e6e;
        }

        .tag-head {
            color: #fff;
            text-align: center;
            font-family: Inter;
            font-size: 32px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
        }
    </style>
</head>
<body>
    <p class="text-center tag-head " style="margin-top: 50px">Tambah Data Guru</p>
    <div class="container d-flex justify-content-center">
        <form action="prosesRegisterGuru.php" method="post"> <!-- Menambahkan action dan method pada form -->
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" id="nama" name="nama" class="form-control input" placeholder="masukkan nama" required />
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" id="username" name="username" class="form-control input" placeholder="masukkan username" required />
            </div>
            <div class="form-group">
                <label for="mata_pelajaran">Mata Pelajaran Yang Di Ajar:</label>
                <select class="form-control" id="mata_pelajaran" name="mata_pelajaran" required>
                    <option value=""selected>Pilih Mapel</option>
                    <option value="Matematika">Matematika</option>
                    <option value="Fisika">Fisika</option>
                    <option value="Kimia">Kimia</option>
                    <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" id="password" name="password" class="form-control input" placeholder="masukkan password" required />
            </div>
            <button type="submit" class="btn btn-primary bt">Register</button>
        </form>
    </div>
        <p class="text-center">sudah punya akun ? <a href="index.html">Login</a></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
