<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        select.form-control {
            appearance: none;
            background: url('https://img.icons8.com/material/24/000000/expand-arrow--v2.png') no-repeat right 10px center;
            background-size: 20px;
        }

        button.btn-primary {
            background-color: #007bff;
            border: none;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="./tatausaha/dashboardTu.php"><button class="btn btn-warning"><< Kembali</button></a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h1 class="btn btn-success">TAMBAH DATA PEMBAYARAN</h1>
                </div>
                <div class="card-body">
                    <form action="proses_bayar.php" method="post">
                        <div class="form-group">
                            <label for="nis">NIS:</label>
                            <input type="text" class="form-control" name="nis" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_pembayaran">Jumlah Pembayaran:</label>
                            <input type="text" class="form-control" name="jumlah_pembayaran" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status" required>
                                <option value="" selected>Pilih Status</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                            <input type="date" class="form-control" name="tanggal_pembayaran" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
