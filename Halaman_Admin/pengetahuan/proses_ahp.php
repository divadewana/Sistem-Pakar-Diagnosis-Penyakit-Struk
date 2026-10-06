<?php
session_start();

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

// Cek apakah parameter id_pengetahuan ada dan valid
if (!isset($_POST['id_pengetahuan']) || !is_numeric($_POST['id_pengetahuan'])) {
    die("Parameter id_pengetahuan tidak valid atau tidak ditemukan.");
}

$id_pengetahuan = mysqli_real_escape_string($conn, $_POST['id_pengetahuan']);

// Ambil kd_penyakit berdasarkan id_pengetahuan
$query_kd_penyakit = "SELECT kd_penyakit FROM basis_pengetahuan WHERE id_pengetahuan = ?";
$stmt_kd_penyakit = $conn->prepare($query_kd_penyakit);
$stmt_kd_penyakit->bind_param("i", $id_pengetahuan);
$stmt_kd_penyakit->execute();
$result_kd_penyakit = $stmt_kd_penyakit->get_result();

if ($result_kd_penyakit->num_rows === 0) {
    die("kd_penyakit tidak ditemukan untuk id_pengetahuan yang diberikan.");
}

$row_kd_penyakit = $result_kd_penyakit->fetch_assoc();
$kd_penyakit = $row_kd_penyakit['kd_penyakit'];

$stmt_kd_penyakit->close();

// Fetch existing symptoms for the current knowledge entry
$existing_gejala = [];
$query_existing_gejala = "SELECT kd_gejala FROM basis_pengetahuan_detail WHERE id_pengetahuan = ?";
$stmt_existing_gejala = $conn->prepare($query_existing_gejala);
$stmt_existing_gejala->bind_param("i", $id_pengetahuan);
$stmt_existing_gejala->execute();
$result_existing_gejala = $stmt_existing_gejala->get_result();

if (!$result_existing_gejala) {
    die("Query failed: " . $stmt_existing_gejala->error);
}

while ($row = $result_existing_gejala->fetch_assoc()) {
    $existing_gejala[] = $row['kd_gejala'];
}

$stmt_existing_gejala->close();

// Cek tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Debug: print all POST data
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Validasi dan sanitasi input POST
    if (isset($_POST['gejala']) && is_array($_POST['gejala'])) {
        $gejala_data = $_POST['gejala'];
        foreach ($gejala_data as $gejala => $input) {
            $input_value = mysqli_real_escape_string($conn, htmlspecialchars($input['prioritas']));
            echo "Inserting gejala $gejala with value $input_value\n"; // Debug line
            $query_detail = "INSERT INTO basis_pengetahuan_detail (id_pengetahuan, kd_penyakit, kd_gejala, bobot_prio)
                             VALUES ('$id_pengetahuan', '$kd_penyakit', '$gejala', '$input_value')";
            if (!mysqli_query($conn, $query_detail)) {
                throw new Exception('Error inserting new gejala: ' . mysqli_error($conn));
            }
        }

        // Begin transaction
        mysqli_begin_transaction($conn);

        try {
            // Hapus data gejala lama
            $delete_query = "DELETE FROM basis_pengetahuan_detail WHERE id_pengetahuan = $id_pengetahuan";
            if (!mysqli_query($conn, $delete_query)) {
                throw new Exception('Error deleting old gejala: ' . mysqli_error($conn));
            }

            // Masukkan data gejala baru
            foreach ($gejala_data as $gejala => $input) {
                $input_value = mysqli_real_escape_string($conn, htmlspecialchars($input['prioritas']));
                $query_detail = "INSERT INTO basis_pengetahuan_detail (id_pengetahuan, kd_penyakit, kd_gejala, bobot_prio)
                         VALUES ('$id_pengetahuan', '$kd_penyakit', '$gejala', '$input_value')";
                if (!mysqli_query($conn, $query_detail)) {
                    throw new Exception('Error inserting new gejala: ' . mysqli_error($conn));
                }
            }

            // Commit transaction
            mysqli_commit($conn);

            echo "<script>alert('Data basis pengetahuan berhasil diperbarui.'); window.history.back();</script>";

        } catch (Exception $e) {
            // Rollback transaction in case of error
            mysqli_rollback($conn);
            echo $e->getMessage();
        }
    } else {
        echo "Data gejala tidak ditemukan atau tidak valid.";
    }
}

$conn->close();
?>