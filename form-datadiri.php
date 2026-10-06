<?php
  include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="assets/css/user/konsultasi-form.css">
    <link rel="icon" type="img/png" href="assets/img/logostroke.png">
    <script src="https://kit.fontawesome.com/807ea63ce3.js" crossorigin="anonymous"></script>
    <title>Sistem Pakar Diagnosis Penyakit Saat Kehamilan</title>
  </head>

  <body>
    <nav class="nav-custom navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container pt-2">
        <a class="navbar-brand" href="#">
          <img src="assets/img/logostroke.png" alt="" >
          <span style="font-family: Rockwell;">SIPADIPES</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="form-datadiri.php">Konsultasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="blog.php">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-signup" href="login.php">Login Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="konsultasi" style="padding-top: 8em;">
      <div class="container">
        <div class="row-cols-auto">
          <div class="col" style="text-align: center;">
            <h2>Tahap Awal Konsultasi</h2>
            <h3 style="margin-top: 10px; margin-bottom: 20px;">Form Data Diri Pengguna</h3>
          </div>
          <div class="row mt-2" style="justify-content: center;">
            <div class="col-md-6">
              <form action="controllers-konsul.php" method="POST">
                <div class="mb-3">
                  <input type="hidden" class="form-control" id="kd_pasien" name="kd_pasien" aria-describedby="kd_pasien">
                </div>
                <div class="mb-3">
                  <label for="nama_pasien" class="form-label" style="font-weight: 500;">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" aria-describedby="nama_pasien" required>
                </div>
                <div class="mb-3">
                  <label for="usia" class="form-label" style="font-weight: 500;">Usia</label>
                  <input type="text" class="form-control" id="usia" name="usia" aria-describedby="usia" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label" style="font-weight: 500;">Email</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
                </div>
                <div class="mb-2">
                  <label for="alamat" class="form-label" style="font-weight: 500;">Alamat</label>
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="alamat" name="alamat" style="height: 100px" required></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" style="font-weight: 500;" name="user">Kirim</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="p-3" style="margin-top:50px">
      <p> Copyright © 2024 || Created by <span style="color: #008cc1;"></span> <a href="https://www.instagram.com/divadewana/">Diva Dewana </a> </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
      crossorigin="anonymous">
    </script>
    
  </body>
</html>