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
    <p class="text-center tag-head" style="margin-top: 50px">PENDAFTARAN TU</p>
    <div class="container d-flex justify-content-center">
        <form action="prosesRegisterTu.php" method="post"> <!-- Menambahkan action dan method pada form -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control input" placeholder="masukkan username" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control input" placeholder="masukkan password" required />
            </div>
            <button type="submit" class="btn btn-primary bt">Register</button>
        </form>
    </div>
        <p class="text-center">sudah punya akun ? <a href="index.html">Login</a></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
