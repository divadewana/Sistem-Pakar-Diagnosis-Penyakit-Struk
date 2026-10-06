<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION["login"])) {
    header("Location: /../login.php");
    exit;
}

require 'controllers-pengetahuan.php';
require '../penyakit/controllers-penyakit.php';
require '../gejala/controllers-gejala.php';

$servername = "localhost";
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$database = "strokee"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


// Ambil data di URL
$id_pengetahuan = mysqli_real_escape_string($conn, $_GET['id_pengetahuan']);

// Query menampilkan data
$result = penyakit("SELECT * FROM penyakit");
$result_gejala = query("SELECT * FROM gejala");
$pengetahuan = pengetahuan("SELECT * FROM basis_pengetahuan WHERE id_pengetahuan = $id_pengetahuan")->fetch_assoc();

// Fetch existing symptoms for the current knowledge entry
$existing_gejala = [];
$query_existing_gejala = "SELECT kd_gejala FROM basis_pengetahuan_detail WHERE id_pengetahuan = $id_pengetahuan";
$result_existing_gejala = mysqli_query($conn, $query_existing_gejala);
while ($row = mysqli_fetch_assoc($result_existing_gejala)) {
    $existing_gejala[] = $row['kd_gejala'];
}

// Cek tombol submit ditekan
if (isset($_POST["button"])) {
    // Cek data berhasil ditambahkan atau tidak
    if (update_pengetahuan($_POST) > 0) {
        echo " <script>
					alert('Data Basis Pengetahuan Berhasil Diubah');
					document.location.href ='../basis-pengetahuan.php';
			   </script>
			 ";
    } else {
        echo " <script>
					alert('Data Basis Pengetahuan Gagal Diubah');
					document.location.href ='../basis-pengetahuan.php';
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
            <img class="img-profile rounded-circle" src="../../assets/img/logostroke.png"
                style="width: 40px; height: 40px;">
            <a class="navbar-brand" href="#"
                style="margin-left: 10px; font-weight: bold; text-align: center; font-family: sans-serif;">SIPADIPES</a>
        </div>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
            style="padding-right: 5rem;">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-secondary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img class="img-profile rounded-circle" src="../../assets/img/logostroke.jpg"
                        style="width: 40px; height: 40px;">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                        style="padding-right: 1rem; padding-left: 1rem;"><?php echo $_SESSION["username"]; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!"><?php echo $_SESSION["username"]; ?></a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion " id="sidenavAccordion" style="background-color: #008cc1;">
                    <div class="sb-sidenav-menu">
                        <div class="nav" style="color: grey; font-family: sans-serif;">
                            <div class="sb-sidenav-menu-heading" style="color: orange; font-weight: bold;">Home</div>
                            <a class="nav-link" href="../home.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading" style="color: orange; font-weight: bold;">Data Users
                            </div>
                            <a class="nav-link" href="../pengguna.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></i>
                                </div>Data Pasien
                            </a>
                            <a class="nav-link" href="../admin.php" style="color: white;">
                                <div class="sb-nav-link-icon" style="padding-left: 2px; padding-right: 3px;"><i
                                        class="fa-solid fa-user-doctor"></i>
                                </div>Data Admin
                            </a>
                            <div class="sb-sidenav-menu-heading" style="color: orange; font-weight: bold;">Data Penyakit
                            </div>
                            <a class="nav-link" href="../penyakit.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase-medical"></i></div>
                                Penyakit
                            </a>
                            <a class="nav-link" href="../gejala.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-pager"></i></div>
                                Gejala
                            </a>
                            <a class="nav-link" href="../basis-pengetahuan.php" style="color: white;">
                                <div class="sb-nav-link-icon" style="margin-right: 10px;"><i
                                        class="fa-solid fa-book"></i></div>
                                Basis Pengetahuan
                            </a>
                            
                            <div class="sb-sidenav-menu-heading" style="color: orange;  font-weight: bold;">Data
                                Konsultasi</div>
                            <a class="nav-link" href="../riwayat-konsultasi.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                Riwayat Konsultasi
                            </a>
                            
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Perhitungan AHP
                        </div>
                        <div class="card-body">
                            <h2>Perhitungan AHP</h2>
                            <form id="ahpForm" action="proses_ahp.php" method="post">
                                <input type="hidden" name="id_pengetahuan"
                                    value="<?php echo htmlspecialchars($_GET['id_pengetahuan'], ENT_QUOTES, 'UTF-8'); ?>">

                                <!-- Input Prioritas Gejala
                                <?php foreach ($existing_gejala as $gejala): ?>
                                    <input type="hidden"
                                        name="gejala[<?php echo htmlspecialchars($gejala, ENT_QUOTES, 'UTF-8'); ?>][prioritas]"
                                        value="0.1">
                                <?php endforeach; ?> -->

                                <!-- Table Matriks Perbandingan -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header">Tabel Matriks Perbandingan</div>
                                        <table class="table table-success table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama Gejala</th>
                                                    <?php foreach ($existing_gejala as $gejala): ?>
                                                        <th
                                                            data-code="<?php echo htmlspecialchars($gejala, ENT_QUOTES, 'UTF-8'); ?>">
                                                            <?php echo htmlspecialchars($gejala, ENT_QUOTES, 'UTF-8'); ?>
                                                        </th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($existing_gejala as $gejala1): ?>
                                                    <tr>
                                                        <th><?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>
                                                        </th>
                                                        <?php foreach ($existing_gejala as $gejala2): ?>
                                                            <td>
                                                                <?php
                                                                $value = '';
                                                                $disabled = false;
                                                                if ($gejala1 === $gejala2) {
                                                                    $value = '1';
                                                                    $disabled = true;
                                                                }
                                                                ?>
                                                                <input type="text" class="form-control basis-input"
                                                                    data-row="<?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>"
                                                                    data-col="<?php echo htmlspecialchars($gejala2, ENT_QUOTES, 'UTF-8'); ?>"
                                                                    value="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>"
                                                                    <?php echo $disabled ? 'disabled' : ''; ?>
                                                                    onchange="updateMatrix(this)">
                                                            </td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Jumlah</th>
                                                    <?php foreach ($existing_gejala as $gejala): ?>
                                                        <th><input type="text"
                                                                id="sum-<?php echo htmlspecialchars($gejala, ENT_QUOTES, 'UTF-8'); ?>"
                                                                class="form-control" value="" disabled></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tabel Matriks Normalisasi -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header">Tabel Matriks Normalisasi</div>
                                        <table class="table table-success table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama Gejala</th>
                                                    <?php foreach ($existing_gejala as $gejala): ?>
                                                        <th><?php echo htmlspecialchars($gejala, ENT_QUOTES, 'UTF-8'); ?>
                                                        </th>
                                                    <?php endforeach; ?>
                                                    <th>Jumlah</th>
                                                    <th>Prioritas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($existing_gejala as $gejala1): ?>
                                                    <tr>
                                                        <th><?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>
                                                        </th>
                                                        <?php foreach ($existing_gejala as $gejala2): ?>
                                                            <td><input type="text"
                                                                    id="normalisasi-<?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>-<?php echo htmlspecialchars($gejala2, ENT_QUOTES, 'UTF-8'); ?>"
                                                                    class="form-control" value="" disabled></td>
                                                        <?php endforeach; ?>
                                                        <td><input type="text"
                                                                id="sum-normalisasi-<?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>"
                                                                class="form-control" value="" disabled></td>
                                                        <td><input type="text"
                                                                id="prioritas-<?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>"
                                                                name="gejala[<?php echo htmlspecialchars($gejala1, ENT_QUOTES, 'UTF-8'); ?>][prioritas]"
                                                                class="form-control" value="" ></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tabel Lambda, CI, CR -->
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-success table-striped">
                                            <tr>
                                                <th>λ Maks</th>
                                                <td><input type="text" id="lambda-max" name="lambda_max"
                                                        class="form-control" value="" disabled></td>
                                            </tr>
                                            <tr>
                                                <th>CI (Consistency Index)</th>
                                                <td><input type="text" id="ci" name="ci" class="form-control" value=""
                                                        disabled></td>
                                            </tr>
                                            <tr>
                                                <th>CR (Consistency Ratio)</th>
                                                <td><input type="text" id="cr" name="cr" class="form-control" value=""
                                                        disabled></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; SIPADIPES  2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script src="../../assets/js/datatables-simple-demo.js"></script>
    <script>
        document.getElementById('ahpForm').addEventListener('submit', function(event) {
        const crValue = parseFloat(document.getElementById('cr').value);

        if (isNaN(crValue)) {
            alert('Silakan hitung nilai CR terlebih dahulu.');
            event.preventDefault();
            return;
        }

        if (crValue > 0.1) {
            alert('Consistency Ratio (CR) lebih dari 0.1. Silakan periksa kembali input Anda.');
            event.preventDefault();
            return;
        }
    });
        function updateMatrix(input) {
            const rowId = input.dataset.row;
            const colId = input.dataset.col;
            const value = parseFloat(input.value);

            // Ensure value is valid
            if (isNaN(value) || value <= 0) {
                return;
            }

            // Update reciprocal value
            const reciprocalInput = document.querySelector(`[data-row="${colId}"][data-col="${rowId}"]`);
            if (reciprocalInput) {
                reciprocalInput.value = value ? (1 / value).toFixed(3) : '';
            }

            // Update all sums and calculate results
            updateAllSums();
            calculateNormalization();
            calculateMetrics();
        }

        function updateAllSums() {
            const inputs = document.querySelectorAll('input.basis-input');
            const columnSums = {};

            inputs.forEach(input => {
                const col = input.dataset.col;
                const value = parseFloat(input.value) || 0;
                columnSums[col] = (columnSums[col] || 0) + value;
            });

            // Update sum columns
            Object.keys(columnSums).forEach(col => {
                const sumInput = document.querySelector(`#sum-${col}`);
                if (sumInput) {
                    sumInput.value = columnSums[col].toFixed(3);
                }
            });
        }

        function calculateNormalization() {
            const inputs = document.querySelectorAll('input.basis-input');
            const columnSums = {};
            const matrix = {};

            // Build the matrix and calculate column sums
            inputs.forEach(input => {
                const row = input.dataset.row;
                const col = input.dataset.col;
                const value = parseFloat(input.value) || 0;

                if (!matrix[row]) {
                    matrix[row] = {};
                }
                matrix[row][col] = value;

                columnSums[col] = (columnSums[col] || 0) + value;
            });

            // Normalize the matrix and update the inputs
            Object.keys(matrix).forEach(row => {
                Object.keys(matrix[row]).forEach(col => {
                    const normalizedValue = matrix[row][col] / (columnSums[col] || 1);
                    const normInput = document.querySelector(`#normalisasi-${row}-${col}`);
                    if (normInput) {
                        normInput.value = normalizedValue.toFixed(3);
                    }
                });
            });

            // Update row sums in normalization matrix
            Object.keys(matrix).forEach(row => {
                let rowSum = 0;
                Object.keys(matrix[row]).forEach(col => {
                    rowSum += matrix[row][col] / (columnSums[col] || 1);
                });
                const sumNormInput = document.querySelector(`#sum-normalisasi-${row}`);
                if (sumNormInput) {
                    sumNormInput.value = rowSum.toFixed(3);
                }
                const priorityInput = document.querySelector(`#prioritas-${row}`);
                if (priorityInput) {
                    priorityInput.value = (rowSum / Object.keys(matrix[row]).length).toFixed(3);
                }
            });
        }

        function calculateMetrics() {
            const inputs = document.querySelectorAll('input.basis-input');
            const matrix = {};
            const priorities = {};
            const numOfGejala = document.querySelectorAll('th[data-code]').length;

            // Build the matrix
            inputs.forEach(input => {
                const row = input.dataset.row;
                const col = input.dataset.col;
                const value = parseFloat(input.value) || 0;

                if (!matrix[row]) {
                    matrix[row] = {};
                }
                matrix[row][col] = value;
            });

            // Get priority vector from the priority input fields
            const priorityInputs = document.querySelectorAll('input[id^="prioritas-"]');
            priorityInputs.forEach(input => {
                const gejala = input.id.replace('prioritas-', '');
                priorities[gejala] = parseFloat(input.value) || 0;
            });

            // Calculate λ max (lambdaMax)
            let lambdaMax = 0;
            Object.keys(matrix).forEach(row => {
                let rowSum = 0;
                Object.keys(matrix[row]).forEach(col => {
                    rowSum += matrix[row][col] * (priorities[col] || 0);
                });
                lambdaMax += rowSum / (priorities[row] || 1);
            });
            lambdaMax /= numOfGejala;

            // Calculate CI and CR
            const ci = (lambdaMax - numOfGejala) / (numOfGejala - 1);
            const ri = getRI(numOfGejala);
            const cr = ci / ri;

            // Update the results
            document.getElementById('lambda-max').value = lambdaMax.toFixed(3);
            document.getElementById('ci').value = ci.toFixed(3);
            document.getElementById('cr').value = cr.toFixed(3);
        }

        function getRI(n) {
            const riValues = {
                1: 0.00, 2: 0.00, 3: 0.58, 4: 0.90, 5: 1.12,
                6: 1.24, 7: 1.32, 8: 1.41, 9: 1.45, 10: 1.49
            };
            return riValues[n] || 1.49;  // Default to 1.49 for larger matrices
        }

    </script>



</body>

</html>