<?php
  session_start();

  if (isset($_SESSION["login"])) {
      header("Location: Halaman_Admin/home.php");
      exit;
  }

  require 'proseslogin.php';
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
      <link rel="stylesheet" href="assets/css/user/login_admin.css">
      <link rel="icon" type="img/png" href="assets/img/logostroke.png">
      <script src="https://kit.fontawesome.com/807ea63ce3.js" crossorigin="anonymous"></script>
      <title>Sistem Pakar Diagnosis Penyakit Stroke</title>
  </head>

  <body>
      <nav class="nav-custom navbar navbar-expand-lg navbar-light fixed-top" >
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

      <div id="login">
          <div class="container py-5" style="margin-top: 60px;">
              <div class="row d-flex justify-content-center align-items-center ">
              <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem; background-color: aliceblue;">
                  <div class="row g-0">
                      <div class="col-md-6 col-lg-5" style="display: block; margin: auto; padding-left: 80px;" >
                          <img src="assets/img/login.png"
                          alt="login form" class="img-fluid" style="height: 20rem; width: 20rem; border-radius: 15px;" />
                      </div>
                      <div class="col-md-6 col-lg-7 d-flex align-items-center">
                          <div class="card-body p-4 p-lg-5 text-black">
                              <form method="POST" action="">
                                  <div class="d-flex align-items-center mb-3 pb-1">
                                      <span class="h2 fw-bold mb-0 text-center">Sistem Pakar Diagnosis Penyakit Stroke</span>
                                  </div>

                                  <h5 class=" mb-3 pb-3 text-center" 
                                      style="letter-spacing: 1px; padding-top: 20px; font-weight: bold;">
                                      Login Admin
                                  </h5>

                                  <div class="container">
                                      <?php
                                      if (isset($_SESSION['status'])) {
                                      ?>
                                          <div class="alert alert-danger">
                                              <span class="fas fa-times-circle"></span>
                                              <span></span>
                                              <span class="msg"> <?= $_SESSION['status'] ?></span>
                                          </div>
                                      <?php
                                          unset($_SESSION['status']);
                                      }
                                      ?>
                                  </div>

                                  <div class="form-outline mb-4" style="font-weight: 400;">
                                      <label class="form-label" for="form2Example17" >Username</label>
                                      <input type="text" name="username" class="form-control" />
                                  </div>

                                  <div class="form-outline mb-4" style="font-weight: 400;">
                                      <label class="form-label" for="form2Example27">Password</label>
                                      <input type="password" name="password" class="form-control" />
                                  </div>

                                  <div class="pt-1 mb-4" style="font-weight: bold;">
                                      <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Login</button>
                                  </div style="font-weight: 400;">

                                  <div>
                                    <p class="mb-5 pb-lg-2" style="font-weight: 500;"> Anda Bukan Admin? 
                                      <a href="index.php" style="font-weight: 500; color: deepskyblue;">Silahkan Kembali</a>
                                    </p>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
              </div>
          </div>
      </div>

      <footer class="p-3">
      <p> Copyright © 2024 || Created by <span style="color: #e25555;"></span> 
        <a href="https://www.instagram.com/divadewana/">Diva Dewana</a> 
      </p>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>