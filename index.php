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
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/user/home.css">
    <link rel="icon" type="img/png" href="assets/img/logostroke.png">
    <script src="https://kit.fontawesome.com/807ea63ce3.js" crossorigin="anonymous"></script>
    <title>Sistem Pakar Diagnosis Penyakit stroke</title>
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
              <a class="nav-link" href="#konsultasi">Diagnosis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
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

    <div id="home">
      <div class="container" style="margin-bottom: 6em;">
        <div class="row custom-section">
          <div class="col-12 col-lg-4 mt-5 mb-4">
            <h2 >Sistem Pakar</h2>
            <h3 style="margin-top: 15px; font-family: Rockwell;">Diagnosis Penyakit</h3>
            <h3 style="margin-top: 25px; font-family: Rockwell;">Stroke</h3>
            <p style="text-align: justify; margin-top: 3em;">
            Stroke adalah kondisi medis serius yang terjadi ketika suplai darah ke bagian otak terganggu atau berkurang, 
            sehingga jaringan otak tidak mendapatkan oksigen dan nutrisi yang cukup. Hal ini menyebabkan sel-sel otak mulai mati dalam hitungan menit.
            </p>
            <p style="text-align: justify; margin-top: 0.5em;">
            Mengenali gejala stroke dan mendapatkan bantuan medis dengan cepat sangat penting untuk meminimalkan kerusakan otak dan meningkatkan peluang pemulihan.
            Sistem pakar diagnosa stroke dapat membantu dalam mengenali gejala awal dan memberikan panduan yang tepat untuk tindakan selanjutnya.
            </p>
            <a style="margin-top: 2em;" class="mb-5" href="#konsultasi">Mulai Konsultasi
            <img src="assets/img/next.png" alt="" style="width: 30px; height: 30px; margin-left: 10px; ">
            </a>
          </div>
        </div>
      </div>
    </div>
    

    <div id="about">
      <div class="container mt-5" style="padding-top: 100px; padding-bottom: 5em;">
        <div class="row justify-content-center">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-2" style="padding-top: 40px; padding-left: 50px;">
                <center>
                  <img src="assets/img/logostroke.png" alt="" style="width: 10rem; height: 10rem;">
                </center>
              </div>
              <div class="col-sm-10">
                <h3 style="font-weight: bold; font-family: Rockwell; padding-top: 30px;">
                  <center>
                    Sistem Pakar Diagnosis Penyakit Berdasarkan Keluhan Saat Kehamilan
                    Menggunakan Metode Forward Chaining Dan Certainty Factor 
                  </center>
                </h3>
                <br>
                <div class="row justify-content-center">
                  <div class="col-sm-10">
                    <center>
                    <p style="font-weight: 600;">Sistem Pakar ini dapat melakukan diagnosis dini penyakit Stroke  dengan cara 
                      menerapkan pengetahuan yang diperoleh dari seorang pakar dan beberapa studi literatur. 
                      Sistem ini hanya dapat melakukan sampai tahap diagnosis awal, untuk tindakan selanjutnya
                      pasien diharapkan datang langsung ke layanan kesehatan Terdekatt untuk mendapatkan tindakan perawatan medis.
                    </p>
                    </center>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section id="alur">
      <!--Content2-->
      
    </section>

    <div id="konsultasi" style="padding-top: 80px; padding-bottom: 50px;" >
      <div class="container" >
        <div class="row-cols-auto">
        <div class="col" style="text-align: center;">
            <h2>Tahap Awal Diagnosis</h2>
            <h3 style="margin-top: 10px; margin-bottom: 20px;">Form Data Diri Pengguna</h3>
          </div>
          <div class="row mt-2" style="justify-content: center;">
            <div class="col-md-6">
              <form action="controllers-konsul.php" method="POST">
                <div class="mb-3">
                  <input type="hidden" class="form-control" id="id_pasien" name="id_pasien" aria-describedby="id_pasien">
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
                <button type="submit" class="btn btn-primary" style="font-weight: 600;" name="user">Kirim</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

   
      
   
    <footer class="p-3">
    <div class="container p-4">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Kontak Kami</h5>
            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white">Alamat: Jalan-jalan kemana saja No.123</a>
              </li>
              <li>
                <a href="mailto:info@namawebsiteanda.com" class="text-white">Email: infostroke.com</a>
              </li>
              <li>
                <a href="mailto:info@namawebsiteanda.com" class="text-white">Telpon: 08123456789</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <li>
              <h5 class="text-uppercase">Sosial Media</h5>
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#!" class="text-white">Instagram: info_stroke</a>
                </li>
                <li>
                  <a href="mailto:info@namawebsiteanda.com" class="text-white">Facebook: infostroke_</a>
                </li>
                <li>
                  <a href="mailto:info@namawebsiteanda.com" class="text-white">Twiter: infostroke123</a>
                </li>
              </ul>
            </li>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase">Cirebon</h5>
            <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63395.53798943833!2d108.51275319269693!3d-6.742860865588333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee2649e6e5bbb%3A0x70a07638a7fe12fe!2sCirebon%2C%20Kota%20Cirebon%2C%20Jawa%20Barat%2C%20Indonesia!5e0!3m2!1sid!2sus!4v1715951655845!5m2!1sid!2sus" width=100" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
      <p> Copyright © 2024 || Created by <span style="color: #e25555;"9829;</span> 
        <a href="https://www.instagram.com/divadewana/">Diva Dewana</a> 
      </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
      crossorigin="anonymous">
    </script>

  </body>
</html>