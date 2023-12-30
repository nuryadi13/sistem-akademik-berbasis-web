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
    <p class="text-center tag-head" style="margin-top: 50px">PENDAFTARAN</p>
    <div class="container d-flex justify-content-center">
        <form action="prosesRegister.php" method="post"> <!-- Menambahkan action dan method pada form -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control input" placeholder="masukkan username" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control input" placeholder="masukkan password" required />
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control input" placeholder="Konfirmasi Password" required />
            </div>
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" id="nis" name="nis" class="form-control input" placeholder="Masukkan NIS Anda" required />
            </div>
            <div class="form-group">
            <label for="kelas">Kelas:</label>
            <select class="form-control" id="kelas" name="kelas" required>
                <option value="" selected>Pilih Kelas</option>
                <option value="TKJ 1">TKJ 1</option>
                <option value="TKJ 2">TKJ 2</option>
                <option value="TKJ 3">TKJ 3</option>
                <option value="Akuntansi 1">Akuntansi 1</option>
                <option value="Akuntansi 2">Akuntansi 2</option>
                <option value="Akuntansi 2">Akuntansi 2</option>
                <option value="OTKP 1">OTKP 1</option>
                <option value="OTKP 2">OTKP 2</option>
                <option value="OTKP 3">OTKP 3</option>
            </select>
            </div>

            <div class="mb-3">
                <label for="whatsapp" class="form-label">No Whatsapp</label>
                <input type="text" id="whatsapp" name="no_whatsapp" class="form-control input" placeholder="masukkan kelas" value="+62" required />
            </div>
            <button type="submit" class="btn btn-primary bt">Register</button>
        </form>
    </div>
        <p class="text-center">sudah punya akun ? <a href="index.php">Login</a></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
