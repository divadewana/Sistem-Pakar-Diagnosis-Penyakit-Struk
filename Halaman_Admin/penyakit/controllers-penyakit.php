<?php
$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'strokee';

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Maaf Database Tidak Terkoneksi :" . mysqli_connect_error());
}

function penyakit($penyakit)
{
    global $conn;
    $result = mysqli_query($conn, $penyakit);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_penyakit($data)
{
    global $conn;
    //mengambil data dari tiap elemen form
    $kd_penyakit = htmlspecialchars($data["kd_penyakit"]);
    $nama_penyakit = htmlspecialchars($data["nama_penyakit"]);
    $penjelasan = htmlspecialchars($data["penjelasan"]);
    $solusi = htmlspecialchars($data["solusi"]);

    // Handle file upload
    $foto = $_FILES['foto'];
    $foto_name = $foto['name'];
    $foto_tmp = $foto['tmp_name'];
    $foto_error = $foto['error'];

    // Check if there was an error uploading the file
    if ($foto_error === 0) {
        // Create uploads directory if it doesn't exist
        $upload_dir = '../../uploads/penyakit/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Generate unique filename
        $foto_ext = pathinfo($foto_name, PATHINFO_EXTENSION);
        $foto_new_name = uniqid('foto_') . '.' . $foto_ext;
        $foto_destination = $upload_dir . $foto_new_name;

        // Move uploaded file
        if (move_uploaded_file($foto_tmp, $foto_destination)) {
            //query insert data
            $query = "INSERT INTO penyakit
                    VALUES
                    ('$kd_penyakit','$nama_penyakit','$penjelasan','$solusi','$foto_new_name')
                    ";

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        } else {
            echo "<script>
                alert('Gagal mengunggah foto');
                document.location.href = '../penyakit.php';
            </script>";
            return 0;
        }
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat mengunggah foto');
            document.location.href = '../penyakit.php';
        </script>";
        return 0;
    }
}

function update_penyakit($data)
{
    global $conn;

    //mengambil data dari tiap elemen form
    $kd_penyakit = $data["kd_penyakit"];
    $nama_penyakit = htmlspecialchars($data["nama_penyakit"]);
    $penjelasan = htmlspecialchars($data["penjelasan"]);
    $solusi = htmlspecialchars($data["solusi"]);

    //query insert data
    $query = "UPDATE penyakit SET 
				nama_penyakit = '$nama_penyakit',
                penjelasan = '$penjelasan',
                solusi = '$solusi'
			    WHERE kd_penyakit = '$kd_penyakit'
			";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_penyakit($kd_penyakit)
{
    global $conn;
    //query delete data
    mysqli_query($conn, "DELETE FROM penyakit WHERE kd_penyakit = '" . $kd_penyakit . "'");
    return mysqli_affected_rows($conn);
}
