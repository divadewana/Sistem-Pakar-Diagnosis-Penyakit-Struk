<?php
session_start();

// Tambahkan ini untuk menampilkan error
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["login"])) {
    header("Location: /../login.php");
    exit;
}
require 'controllers-pengetahuan.php';
require '../penyakit/controllers-penyakit.php';
require '../gejala/controllers-gejala.php';

$result = penyakit("SELECT * FROM penyakit");
$result_gejala = query("SELECT * FROM gejala");

if (isset($_POST["button"])) {
    $kd_penyakit = $_POST['nama_penyakit'];
    $gejala = $_POST['gejala'];

    $data = [
        'nama_penyakit' => $kd_penyakit,
        'gejala' => $gejala
    ];

    // Panggil fungsi untuk menambah data
    $result = tambah_pengetahuan($data);

    if ($result > 0) {
        echo "
            <script>
            alert('Data Basis Pengetahuan Berhasil Ditambahkan');
            document.location.href = '../basis-pengetahuan.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data Basis Pengetahuan Gagal Ditambahkan');
            document.location.href = '../basis-pengetahuan.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Administrator Sistem Pakar</title>
    <link rel="icon" type="img/png" href="../../assets/img/logostroke.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../assets/css/admin.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #008cc1;">
            <div style="padding: 20px;">
                <img class="img-profile rounded-circle"  src="../../assets/img/logostroke.png" style="width: 40px; height: 40px;">
                <a class="navbar-brand" href="#" style="margin-left: 10px; font-weight: bold; text-align: center; font-family: sans-serif;">SIPADIPES</a>
            </div>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" style="padding-right: 5rem;">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-secondary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>

        <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="../../assets/img/logostroke.png" style="width: 40px; height: 40px;">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="padding-right: 1rem; padding-left: 1rem;"><?php echo $_SESSION["username"]; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../../logout.php" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion " id="sidenavAccordion" style="background-color: #008cc1;"> 
                    <div class="sb-sidenav-menu">
                        <div class="nav" style="color: grey; font-family: sans-serif;">
                            <div class="sb-sidenav-menu-heading" style="color: orange; font-weight: bold;">Home</div>
                            <a class="nav-link" href="../home.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading" style="color: orange; font-weight: bold;">Data Users</div>
                                <a class="nav-link" href="../pengguna.php" style="color: white;">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></i>
                                    </div>Data Pasien
                                </a>
                                <a class="nav-link" href="../admin.php" style="color: white;">
                                    <div class="sb-nav-link-icon" style="padding-left: 2px; padding-right: 3px;"><i class="fa-solid fa-user-doctor"></i>
                                    </div>Data Admin
                                </a>
                            <div class="sb-sidenav-menu-heading" style="color: orange; font-weight: bold;">Data Penyakit</div>
                            <a class="nav-link" href="../penyakit.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase-medical"></i></div>
                                Penyakit
                            </a>
                            <a class="nav-link" href="../gejala.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-pager"></i></div>
                                Gejala
                            </a>
                            <a class="nav-link" href="../basis-pengetahuan.php" style="color: white;">
                                <div class="sb-nav-link-icon" style="margin-right: 10px;"><i class="fa-solid fa-book"></i></div>
                                Basis pengetahuan
                            </a>
                            <div class="sb-sidenav-menu-heading" style="color: orange;  font-weight: bold;">Data Konsultasi</div>
                            <a class="nav-link" href="../riwayat-konsultasi.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                Riwayat Konsultasi
                            </a>
                            
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah Data Basis Pengetahuan
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        
                                        <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                                        <select class="form-select" name="nama_penyakit" id="nama_penyakit" required>
                                            <option selected disabled value="">Pilih Penyakit</option>
                                            <?php foreach ($result as $row) : ?>
                                                <option value="<?php echo $row["kd_penyakit"]; ?>"><?php echo $row["nama_penyakit"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Replaced the select input with a table containing checkboxes -->
                                    <div class="mb-3">
                                        <label for="nama_gejala" class="form-label">Nama Gejala</label>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Gejala</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($result_gejala as $row_gejala) : ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $row_gejala["kd_gejala"] ?></th>
                                                        <td><?php echo $row_gejala["nama_gejala"] ?></td>
                                                        <td>
                                                            <input type="checkbox" name="gejala[]" value="<?php echo $row_gejala["kd_gejala"] ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- <div class="mb-3">
                                        <label for="bobot_prioritas" class="form-label">Nilai CF</label>
                                        <input type="text" class="form-control" name="bobot_prioritas" id="bobot_prioritas" required>
                                    </div> -->

                                    <div class="modal-footer">
                                        <a href="../basis-pengetahuan.php" type="button" class="btn btn-secondary">Batal</a>
                                        <button type="submit" name="button" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; SIPADIPES 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/js/datatables/datatables-simple-demo.js"></script>
        <script src="../../assets/js/admin.js"></script>
</body>

</html>
