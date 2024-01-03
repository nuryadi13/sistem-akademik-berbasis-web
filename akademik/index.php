<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/style.css" />
    <style>
      @media (min-width: 992px) {
        /* Style untuk layar dengan lebar minimal 992px (desktop) */
        .logo {
          margin-left: 580px;
        }
      }
      @media (max-width: 768px) {
  .logo {
    margin-left: 98px; /* Menjadikan margin-left menjadi 0 pada tampilan mobile */
  }
}
    </style>
    <title>Document</title>
  </head>
  <body><div>
    <p class="text-center tag-head" style="margin-top: 50px">SISTEM AKADEMIK SMK NURUL HIKMAH</p>
    <img class="logo" src="../assets/img/logo.png" alt="" /><br /><br />
    <div class="container d-flex justify-content-center">
      <form action="proseslogin.php" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" style="background: #7b6e6e" name="username" placeholder="Masukkan username" required />
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" style="background: #7b6e6e" placeholder="Masukkan password" required />
        </div>
        <div class="mb-3">
        <label for="role" class="form-label">Pilih Peran</label>
            <select id="role" name="role">
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="tu">Tata Usaha</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success bt">Login</button>
      </form>
    </div>
  </div>
    
    <p class="text-center">Belum Punya Akun? <a href="register.php">Register</a></p>
    <!-- <p class="text-center">Belum Punya Akun guru ? <a href="registerguru.php">Register</a></p>
    <p class="text-center">Belum Punya Akun guru ? <a href="./tatausaha/registerTu.php">Register Tata Usaha</a></p> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
