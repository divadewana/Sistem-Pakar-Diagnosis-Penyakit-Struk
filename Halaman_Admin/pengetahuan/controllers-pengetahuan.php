<?php
$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'strokee';

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Maaf Database Tidak Terkoneksi: " . mysqli_connect_error());
}

function tambah_pengetahuan($data)
{
    global $conn;

    $kd_penyakit = mysqli_real_escape_string($conn, htmlspecialchars($data["nama_penyakit"]));
    $gejala = isset($data["gejala"]) ? $data["gejala"] : [];
    $bobot_prio = 0; // Set nilai default untuk bobot_prioritas

    // Insert into basis_pengetahuan
    $query1 = "INSERT INTO basis_pengetahuan (kd_penyakit) VALUES ('$kd_penyakit')";
    if (!mysqli_query($conn, $query1)) {
        echo 'Error: ' . mysqli_error($conn);
        return 0;
    }
    $id_pengetahuan = mysqli_insert_id($conn); // Get the last inserted ID

    // Insert into basis_pengetahuan_detail
    foreach ($gejala as $kd_gejala) {
        $kd_gejala = mysqli_real_escape_string($conn, htmlspecialchars($kd_gejala));
        $query2 = "INSERT INTO basis_pengetahuan_detail (id_pengetahuan, kd_penyakit, kd_gejala, bobot_prio) 
                   VALUES ('$id_pengetahuan', '$kd_penyakit', '$kd_gejala', '$bobot_prio')";
        if (!mysqli_query($conn, $query2)) {
            echo 'Error: ' . mysqli_error($conn);
            return 0;
        }
    }

    return mysqli_affected_rows($conn);
}


function pengetahuan($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo 'Error: ' . mysqli_error($conn);
    }
    return $result;
}

function update_pengetahuan($data)
{
    global $conn;

    // Retrieve and sanitize inputs
    $id_pengetahuan = mysqli_real_escape_string($conn, htmlspecialchars($data["id_pengetahuan"]));
    $kd_penyakit = mysqli_real_escape_string($conn, htmlspecialchars($data["nama_penyakit"]));
    $gejala = isset($data["gejala"]) ? $data["gejala"] : [];

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Update pengetahuan utama
        $query = "UPDATE basis_pengetahuan SET 
                    kd_penyakit = '$kd_penyakit'
                  WHERE id_pengetahuan = $id_pengetahuan";
        if (!mysqli_query($conn, $query)) {
            throw new Exception('Error updating basis_pengetahuan: ' . mysqli_error($conn));
        }

        // Hapus data gejala lama
        $delete_query = "DELETE FROM basis_pengetahuan_detail WHERE id_pengetahuan = $id_pengetahuan";
        if (!mysqli_query($conn, $delete_query)) {
            throw new Exception('Error deleting old gejala: ' . mysqli_error($conn));
        }

        // Masukkan data gejala baru
        foreach ($gejala as $kd_gejala) {
            $kd_gejala = mysqli_real_escape_string($conn, htmlspecialchars($kd_gejala));
            $query_detail = "INSERT INTO basis_pengetahuan_detail (id_pengetahuan, kd_penyakit, kd_gejala)
                             VALUES ('$id_pengetahuan', '$kd_penyakit', '$kd_gejala')";
            if (!mysqli_query($conn, $query_detail)) {
                throw new Exception('Error inserting new gejala: ' . mysqli_error($conn));
            }
        }

        // Commit transaction
        mysqli_commit($conn);

        return mysqli_affected_rows($conn);

    } catch (Exception $e) {
        // Rollback transaction in case of error
        mysqli_rollback($conn);
        echo $e->getMessage();
        return 0;
    }
}


function hapus_pengetahuan($id_pengetahuan)
{
    global $conn;

    // Hapus dari basis_pengetahuan_detail terlebih dahulu
    if (!mysqli_query($conn, "DELETE FROM basis_pengetahuan_detail WHERE id_pengetahuan = '$id_pengetahuan'")) {
        echo 'Error: ' . mysqli_error($conn);
    }

    // Hapus dari basis_pengetahuan
    if (!mysqli_query($conn, "DELETE FROM basis_pengetahuan WHERE id_pengetahuan = '$id_pengetahuan'")) {
        echo 'Error: ' . mysqli_error($conn);
    }

    return mysqli_affected_rows($conn);
}
?>

