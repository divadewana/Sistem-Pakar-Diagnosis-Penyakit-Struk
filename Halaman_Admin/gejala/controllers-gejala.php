<?php
$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'strokee';

// $host = 'sql111.infinityfree.com';
// $dbusername = 'if0_34490402';
// $dbpassword = 'RUzKO0OE9M5NA';
// $dbname = 'if0_34490402_db_sistempakarkandungan';

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Maaf Database Tidak Terkoneksi :" . mysqli_connect_error());
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_gejala($data)
{
    global $conn;
    //mengambil data dari tiap elemen form
    $kd_gejala = htmlspecialchars($data["kd_gejala"]);
    $nama_gejala = htmlspecialchars($data["nama_gejala"]);

    //query insert data
    $query = "INSERT INTO gejala
                VALUES
                ('$kd_gejala','$nama_gejala')
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_gejala($data)
{
    global $conn;
    //mengambil data dari tiap elemen form
    $kd_gejala = $data["kd_gejala"];
    $nama_gejala = htmlspecialchars($data["nama_gejala"]);
    //query insert data
    $query = "UPDATE gejala SET 
				nama_gejala = '$nama_gejala'

			  WHERE kd_gejala = '$kd_gejala'
			 ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_gejala($kd_gejala)
{
    global $conn;
    //query delete data
    mysqli_query($conn, "DELETE FROM gejala WHERE kd_gejala = '" . $kd_gejala . "'");
    return mysqli_affected_rows($conn);
}
