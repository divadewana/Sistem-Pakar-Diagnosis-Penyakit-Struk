<?php

include 'koneksi.php';
session_start();
if ($_SESSION['id_pasien'] == NULL) {
    echo "<script>alert('Silakan isi form data diri terlebih dahulu!'); 
            window.location=('form-datadiri.php');
         </script>";
}

// Array yang menyimpan faktor keyakinan pengguna untuk setiap gejala.
$cfuser = array('0', '0', '0.4', '0.6', '0.8', '1');

// Array untuk menyimpan gejala-gejala yang dipilih oleh pengguna.
$gejala_array = array();
for ($no = 0; $no < count($_POST['kondisi']); $no++) {
    $kondisi = explode("_", $_POST['kondisi'][$no]);
    if (strlen($_POST['kondisi'][$no]) > 1) {
        $gejala_array += array($kondisi[0] => $kondisi[1]);
    }
}

// Memanggil kondisi dari database
$panggil_kondisi = mysqli_query($conn, "SELECT * FROM kondisi order by id_kondisi+0");
while ($row_kondisi = mysqli_fetch_array($panggil_kondisi)) {
    $array_kondisitext[$row_kondisi['id_kondisi']] = $row_kondisi['kondisi'];
}

// Memanggil stadium penyakit
$panggil_penyakit = mysqli_query($conn, "SELECT * FROM penyakit order by kd_penyakit+0");
while ($row_penyakit = mysqli_fetch_array($panggil_penyakit)) {
    $nama_penyakit[$row_penyakit['kd_penyakit']] = $row_penyakit['nama_penyakit'];
    $penjelasan_penyakit[$row_penyakit['kd_penyakit']] = $row_penyakit['penjelasan'];
    $solusi_penyakit[$row_penyakit['kd_penyakit']] = $row_penyakit['solusi'];
}

// PERHITUNGAN FORWARD CHAINING DAN CERTAINTY FACTOR
$sqlpenyakit = mysqli_query($conn, "SELECT * FROM penyakit order by kd_penyakit");
$penyakit = array();
while ($row_penyakit = mysqli_fetch_array($sqlpenyakit)) {
    $cf = 0;
    $sqlgejala = mysqli_query($conn, "SELECT * FROM basis_pengetahuan_detail where kd_penyakit = '$row_penyakit[kd_penyakit]'");
    $cf_rule = [];
    $cf_old = 0;

    while ($rgejala = mysqli_fetch_array($sqlgejala)) {
        for ($i = 0; $i < count($_POST['kondisi']); $i++) {
            $array_kondisi = explode("_", $_POST['kondisi'][$i]);
            $gejala = $array_kondisi[0];
            if ($rgejala['kd_gejala'] == $gejala) {
                $cf = ($rgejala['bobot_prio']) * $cfuser[$array_kondisi[1]];
                array_push($cf_rule, $cf);

                for ($j = 0; $j < count($cf_rule) - 1; $j++) {
                    $cf1 = $j == 0 ? $cf_rule[$j] : $cf_old;
                    $cf2 = $cf_rule[$j + 1];

                    if (($cf1 >= 0 && $cf2 > 0)) {
                        $cf_combine = $cf1 + $cf2 * (1 - $cf1);
                    } elseif ($cf1 < 0 || $cf2 < 0) {
                        $cf_combine = $cf1 + $cf2 / ((1 - abs($cf1)) + (1 - abs($cf2)));
                    } else {
                        $cf_combine = $cf1 + $cf2 * (1 + $cf1);
                    }

                    $cf_old = $cf_combine;
                }
            }
        }
    }

    if ($cf_old > 0) {
        $penyakit += array($row_penyakit['kd_penyakit'] => number_format($cf_old, 5));
        arsort($penyakit);
    } elseif ($cf_old == 0) {
        $penyakit += array($row_penyakit['kd_penyakit'] => number_format(0, 0));
    }
}

arsort($penyakit);

$input_gejala = serialize($gejala_array);
$input_penyakit = serialize($penyakit);

$no_pykt = 0;
foreach ($penyakit as $key1 => $value1) {
    $no_pykt++;
    $id_pykt[$no_pykt] = $key1;
    $vl_pykt[$no_pykt] = $value1;
}

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('m-d-Y H:i:s');
//dan kolom "penyakit" diisi dengan data penyakit yang telah di-serialize menjadi string.
$tambah_konsul = mysqli_query($conn, "INSERT INTO konsultasi(tanggal, gejala, penyakit) VALUES ('$tanggal','$input_gejala', '$input_penyakit')");

if ($tambah_konsul) {
    $id_pasien = $_SESSION['id_pasien'];
    $get_id_konsultasi = mysqli_query($conn, "SELECT id_konsultasi FROM konsultasi ORDER BY id_konsultasi DESC LIMIT 1");
    while ($row_id_konsul = mysqli_fetch_array($get_id_konsultasi)) {
        $id_konsultasi = $row_id_konsul['id_konsultasi'];
    }

    // Menyimpan hasil konsultasi utama
    mysqli_query($conn, "INSERT INTO hasil_konsultasi(id_konsultasi, id_pasien, kd_penyakit, nilai_akurasi) VALUES ('$id_konsultasi', '$id_pasien', '$id_pykt[1]', '$vl_pykt[1]')");

    // Menyimpan kemungkinan penyakit lain
    for ($i = 2; $i <= count($id_pykt); $i++) {
        mysqli_query($conn, "INSERT INTO hasil_konsultasi(id_konsultasi, id_pasien, kd_penyakit, nilai_akurasi) VALUES ('$id_konsultasi', '$id_pasien', '$id_pykt[$i]', '$vl_pykt[$i]')");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/user/hasil_konsul.css">
    <link rel="icon" type="img/png" href="assets/img/logostroke.png">
    <script src="https://kit.fontawesome.com/807ea63ce3.js" crossorigin="anonymous"></script>
    <title>Sistem Pakar Diagnosis Penyakit Stroke</title>
</head>

<body>
    <nav class="nav-custom navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container pt-2">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logostroke.png" alt="">
                <span style="font-family: Rockwell;">SIPADIPES</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    <div id="box-warning">
        <div class="container justify-content-center" style="padding-top: 10em">
            <div class="row justify-content-center">
                <div class="col-auto mt-5">
                    <h2 style="font-family: Rockwell; padding-top: 15px; padding-bottom: 10px; color: blue;">HASIL
                        DIAGNOSIS</h2>
                    <div class="card mt-3" style="background-color: ghostwhite; border-radius: 20px;">
                        <div class="card-header" style="display: flex;">
                            <i class="fa fa-newspaper-o" style="padding-top: 5px; padding-right: 8px;"
                                aria-hidden="true"></i>
                            <h4 style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: 500;">Penjelasan
                                Hasil Diagnosis</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text p-2" style="font-weight: 500; text-align: justify;">
                                Berikut adalah gejala atau keluhan penyakit stroke yang sudah anda pilih
                                sebelumnya saat di form konsultasi, dan dibawah juga akan ditampilkan hasil
                                diagnosis penyakit yang anda alami beserta penjelasan penyakit dan solusinya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="table-gejala">
        <div class="container">
            <div class="row justify-content-center" style="padding-top: 2em">
                <div class="col-md-9">
                    <br>
                    <table class="table table-responsive-md table-bordered table-hover p-2">
                        <thead>
                            <tr style="background-color: white; color: black; text-align: center; font-weight: 500;">
                                <th>No</th>
                                <th>Kode Gejala</th>
                                <th>Gejala atau Keluhan</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($gejala_array as $key => $value) {
                                $kondisi = $value;
                                $no++;

                                $gejala = $key;
                                $panggil_gejala = mysqli_query($conn, "SELECT * FROM gejala where kd_gejala = '$key'");
                                $row_gejala = mysqli_fetch_array($panggil_gejala);
                                ?>
                                <tr
                                    style="text-align: center; background-color: white; text-align: center; font-weight: 500;">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row_gejala['kd_gejala']; ?></td>
                                    <td style="text-align: justify;"><?php echo $row_gejala['nama_gejala'] ?></td>
                                    <td><?php echo $array_kondisitext[$kondisi] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="card mt-5" style="margin-top: 20px; background-color: white; border-color: black;">
                    <div class="card-header" style="background-color: black; color: white;">
                        <b>HASIL DIAGNOSIS</b>
                    </div>
                    <div class="card-body">
                        <?php
                        $no_pkt = 0;
                        foreach ($penyakit as $key => $value) {
                            $no_pkt++;
                            $id_pkt[$no_pkt] = $key;
                            $nama_pkt[$no_pkt] = $nama_penyakit[$key];
                            $vl_pkt[$no_pkt] = $value;
                        }

                        ?>

                        <p class="card-text " style="font-weight: 500; text-align: justify;">
                            <?php
                            if ($nama_pkt[1] != "Tidak Terindikasi Penyakit") {
                                echo "<p style='font-weight: 500; text-align: justify;'>Berdasarkan Gejala atau Keluhan dan kondisi yang telah anda pilih pada halaman konsultasi, maka dapat disimpulkan bahwa terdapat Kemungkinan Anda Terkena Penyakit berikut :</p>";
                                echo "<P style='font-size: 30px; font-weight: 500' class='fw-bolder'>$nama_pkt[1]</p> </p>";
                                echo "<h6 style='margin-top: 10px; font-weight: 500' >dengan nilai kepastian sebesar " . number_format($vl_pkt[1] * 100, 2) . "%</h6>";

                                // Menampilkan kemungkinan penyakit lain
                                echo "<h6 style='margin-top: 20px; font-weight: 500'>Kemungkinan Penyakit Lain:</h6>";
                                for ($i = 2; $i <= count($id_pkt); $i++) {
                                    echo "<p style='font-weight: 500; text-align: justify;'>$nama_pkt[$i] dengan nilai kepastian sebesar " . number_format($vl_pkt[$i] * 100, 2) . "%</p>";
                                }
                            } else {
                                echo "<p style='font-weight: 500; text-align: justify;'>Berdasarkan Gejala atau Keluhan dan kondisi yang telah anda pilih pada halaman konsultasi, maka dapat disimpulkan bahwa terdapat Kemungkinan Anda :</p>";
                                echo "<p style='font-size: 30px; font-weight: 500' class='fw-bolder'> $nama_pkt[1]</p>";
                            }
                            ?>
                        </p>
                    </div>
                </div>

                <div class="card mt-5"
                    style="margin-top: 20px; background-color: ghostwhite; border-color: darkslategray;">
                    <div class="card-header" style="background-color: darkslategray; color: white; font-weight: 500;">
                        <b>PENJELASAN PENYAKIT</b>
                    </div>
                    <div class="card-body" style="font-weight: 500; text-align: justify;">
                        <?php echo $penjelasan_penyakit[$id_pkt[1]] ?>
                    </div>
                </div>

                <div class="card mt-5" style="margin-top: 20px; background-color: ghostwhite; border-color: royalblue;">
                    <div class="card-header"
                        style="background-color: royalblue; color: white; font-weight: 500; text-align: justify;">
                        <b>SOLUSI</b>
                    </div>
                    <div class="card-body" style="font-weight: 500; text-align: justify;">
                        <p>Untuk hasil diagnosis yang lebih akurat, anda dapat menghubungi dokter terdekat untuk
                            melakukan pemeriksaan dan tindakan lebih lanjut.</p>
                        <?php echo $solusi_penyakit[$id_pkt[1]] ?>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="p-3" style="margin-top:50px">
        <p> Copyright ©️ 2024 || Created by <span style="color: #008cc1;"></span> <a
                href="https://www.instagram.com/divadewana/"> Diva Dewana </a> </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
</body>

<?php
unset($_SESSION['id_pasien']);
?>

</html>