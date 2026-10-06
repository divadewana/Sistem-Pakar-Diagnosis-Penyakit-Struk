<?php
  include 'koneksi.php';
?>

<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/user/blog.css">
    <link rel="icon" type="img/png" href="assets/img/logostroke.png">
    <script src="https://kit.fontawesome.com/807ea63ce3.js" crossorigin="anonymous"></script>
    <title>Sistem Pakar Diagnosis Penyakit Stroke</title>
  </head>

<body id="home" style="color: black;">
  <nav class="nav-custom navbar navbar-expand-lg navbar-light fixed-top" >
    <div class="container pt-2">
      <a class="navbar-brand" href="#">
        <img src="assets/img/logostroke.png" alt="" >
        <span style="font-family: Rockwell;">SIPADIPES</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav" style="font-weight: 600;">
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

  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 100px;">
      <div class="container" style="font-weight: 600;">
        <ol>
          <li>Home</li>
          <li>Blog</li>
        </ol>
        <h2>Sistem Pakar Diagnosis Penyakit Stroke 
          Menggunakan Metode Forward Chaining Dan Analytical Hierarchy Process</h2>
      </div>
    </section>

    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
              <div class="entry-img">
                <img src="assets/img/hero.png" alt="" class="img-fluid" style="width: 150rem;">
              </div>
              <div class="entry-meta" style="font-weight: 600;">
                <ul>
                  <li class="d-flex align-items-center"><i class="fa fa-user"></i> <a href="#">Diva Dewana</a></li>
                  <li class="d-flex align-items-center"><i class="fa fa-clock"></i> <a href="#"><time datetime="2020-01-01"> Juli, 2023</time></a></li>
                  <li class="d-flex align-items-center"><i class="fa fa-address-card-o" aria-hidden="true"></i><a href="#">Universitas Muhammadiyah Cirebon</a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p style="font-weight: 600;">
                Menjaga kondisi kesehatan adalah sesuatu yang sangat penting bagi mereka yang berisiko stroke. Stroke dapat memiliki konsekuensi serius bagi kesehatan, bahkan bisa berujung fatal. Gejala-gejala awal stroke seringkali tampak sepele, tetapi sebenarnya merupakan tanda bahaya yang harus segera diatasi.
                </p>
                <blockquote>
                  <p style="font-weight: 600;">
                  Mengetahui tanda-tanda awal stroke sangat penting karena memungkinkan Anda untuk melakukan tindakan pencegahan sedini mungkin, atau segera merespons dengan tepat jika gejala stroke mulai terjadi. Menyadari gejala tersebut dapat menyelamatkan nyawa dan mengurangi risiko komplikasi yang serius.</p>
                </blockquote>

                <h3>Penjelasan 6 Jenis Penyakit Stroke</h3>
                <h3>1. TIA (Transient Ischemic Attack)</h3>
                <p style="font-weight: 600;">
                TIA (Transient Ischemic Attack) adalah kondisi sementara yang mirip dengan stroke, namun gejalanya berlangsung singkat (biasanya kurang dari satu jam) dan tidak menyebabkan kerusakan permanen pada otak. TIA sering kali dianggap sebagai peringatan sebelum terjadinya stroke iskemik yang sebenarnya.
                </p>

                <h3>2. RIND (Reversible Ischemic Neurologic Deficits)</h3>
                <p style="font-weight: 600;">
                RIND (Reversible Ischemic Neurologic Deficits) juga merupakan kondisi yang mirip dengan TIA, tetapi gejala neurologisnya lebih berat dan berlangsung lebih lama (biasanya antara 24 jam hingga beberapa minggu), namun tidak meninggalkan kerusakan permanen.
                </p>

                <h3>3. Stroke Progresif</h3>
                <p style="font-weight: 600;">
                Stroke Progresif adalah jenis stroke iskemik di mana gejalanya berkembang secara bertahap dan memburuk seiring waktu, berbeda dengan stroke iskemik biasa yang terjadi tiba-tiba.
                </p>
                
                <h3>4. Stroke Komplet</h3>
                <p style="font-weight: 600;">
                Stroke Komplet: Ini mengacu pada jenis stroke iskemik atau hemoragik yang menyebabkan kerusakan otak yang luas dan permanen, karena suplai darah ke otak terputus atau terganggu sepenuhnya.
                </p>

                <h3>5. Hemoragik Intraserebral</h3>
                <p style="font-weight: 600;">
                Hemoragik Intraserebral adalah jenis stroke hemoragik di mana terjadi perdarahan di dalam otak akibat pecahnya pembuluh darah di dalam jaringan otak.
                </p>

                <h3>6. Hemoragik Subaraknoid</h3>
                <p style="font-weight: 600;">
                Hemoragik Subaraknoidadalah jenis stroke hemoragik di mana terjadi perdarahan di ruang subaraknoid, yaitu ruang antara otak dan tengkorak, biasanya disebabkan oleh pecahnya aneurisma (pembengkakan pembuluh darah) di otak.
                </p>
              </div>

              <div class="entry-footer">
                <i class="fa fa-folder"></i>
                <ul class="cats" style="font-weight: 600;">
                  <li><a href="#">Sistem Pakar </a></li>
                </ul>

                <i class="fa fa-tags"></i>
                <ul class="tags" style="font-weight: 600;">
                  <li><a href="#">TIA (Transient Ischemic Attack)</a></li>
                  <li><a href="#">RIND (Reversible Ischemic Neurologic Deficits)</a></li>
                  <li><a href="#">Stroke Progresif</a></li>
                  <li><a href="#">Stroke Komplet</a></li>
                  <li><a href="#">Hemoragik Intraserebral</a></li>
                  <li><a href="#">Hemoragik Subaraknoid</a></li>
                </ul>
              </div>
            </article>
          </div>

          <div class="col-lg-4">
            <div class="sidebar" style="font-weight: 600;">
              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div>

              <h3 class="sidebar-title">Jenis Penyakit</h3>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <img src="assets/img/blog-ft1.jpg" alt="">
                  <h4><a target="_blank" href="https://www.halodoc.com/kesehatan/tia-transient-ischaemic-attack?utm_source=google&utm_medium=cpc&utm_campaign=&utm_content=151268030042&utm_term=&gad_source=1&gbraid=0AAAAApd_cxY4KsFv594IrrF7RyEFMzUaz&gclid=EAIaIQobChMInvf5zuW_hwMVoy6DAx3RgzY_EAAYASAAEgL4n_D_BwE">TIA (Transient Ischemic Attack)</a></h4>
                  <time datetime="2020-01-01">Sumber : www.halodoc.com</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-ft2.jpg" alt="">
                  <h4><a target="_blank" href="https://pubmed.ncbi.nlm.nih.gov/3290358/">RIND (Reversible Ischemic Neurologic Deficits)</a></h4>
                  <time datetime="2020-01-01">Sumber : www.pubmed.ncbi.nlm.nih.gov</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-ft3.jpg" alt="">
                  <h4><a target="_blank" href="https://www-ncbi-nlm-nih-gov.translate.goog/pmc/articles/PMC4221651/?_x_tr_sl=en&_x_tr_tl=id&_x_tr_hl=id&_x_tr_pto=tc"></a>Stroke hemoragik progresif</h4>
                  <time datetime="2020-01-01">Sumber : www.pubmed.ncbi.nlm.nih.gov</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-ft1.jpg" alt="">
                  <h4><a target="_blank" href="https://www.alodokter.com/stroke-hemoragik">Stroke Komplate</a></h4>
                  <time datetime="2020-01-01">Sumber : www.alodokter.com</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-ft5.jpg" alt="">
                  <h4><a target="_blank" href="https://www-ncbi-nlm-nih-gov.translate.goog/pmc/articles/PMC6188453/?_x_tr_sl=en&_x_tr_tl=id&_x_tr_hl=id&_x_tr_pto=tc">Hemoragik Intraserebral</a></h4>
                  <time datetime="2020-01-01">Sumber : www.pubmed.ncbi.nlm.nih.gov</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-ft6.png" alt="">
                  <h4><a target="_blank" href="https://www.alodokter.com/perdarahan-subarachnoid">
                  Hemoragik Subaraknoid</a></h4>
                  <time datetime="2020-01-01">Sumber : www.alodokter.com</time>
                </div>

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Tags Penyakit Saat Kehamilan</h3>
              <div class="sidebar-item tags" >
                <ul >
                  <li><a style="font-weight: 600;" target="_blank" href="https://www.halodoc.com/kesehatan/tia-transient-ischaemic-attack?utm_source=google&utm_medium=cpc&utm_campaign=&utm_content=151268030042&utm_term=&gad_source=1&gbraid=0AAAAApd_cxY4KsFv594IrrF7RyEFMzUaz&gclid=EAIaIQobChMInvf5zuW_hwMVoy6DAx3RgzY_EAAYASAAEgL4n_D_BwE">TIA (Transient Ischemic Attack)</a></li>
                  <li><a style="font-weight: 600;" target="_blank" href="https://pubmed.ncbi.nlm.nih.gov/3290358/">RIND (Reversible Ischemic Neurologic Deficits)</a></li>
                  <li><a style="font-weight: 600;" target="_blank" href="https://www-ncbi-nlm-nih-gov.translate.goog/pmc/articles/PMC4221651/?_x_tr_sl=en&_x_tr_tl=id&_x_tr_hl=id&_x_tr_pto=tc">Stroke Progresif</a></li>
                  <li><a style="font-weight: 600;" target="_blank" href="https://www.alodokter.com/stroke-hemoragik">Stroke Komplet</a></li>
                  <li><a style="font-weight: 600;" target="_blank" href="https://www-ncbi-nlm-nih-gov.translate.goog/pmc/articles/PMC6188453/?_x_tr_sl=en&_x_tr_tl=id&_x_tr_hl=id&_x_tr_pto=tc">Hemoragik Intraserebral</a></li>
                  <li><a style="font-weight: 600;" target="_blank" href="https://www.alodokter.com/perdarahan-subarachnoid">
                  Hemoragik Subaraknoid</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="p-3">
    <p> Copyright © 2024 || Created by <span style="color: #e25555;"></span> 
      <a href="https://www.instagram.com/divadewana/">Diva Dewana</a> 
    </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>