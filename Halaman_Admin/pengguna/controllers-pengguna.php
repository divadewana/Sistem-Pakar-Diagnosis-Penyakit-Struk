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

function pengguna($pengguna)
{
    global $conn;
    $result = mysqli_query($conn, $pengguna);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_pengguna($data)
{
    global $conn;
    //mengambil data dari tiap elemen form
    $nama_pasien = htmlspecialchars($data["nama_pasien"]);
    $usia = htmlspecialchars($data["usia"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);

    //query insert data
    $query = "INSERT INTO pasien
			 VALUES
			 ('','$nama_pasien','$usia','$email','$alamat')
			 ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_pengguna($data)
{
    global $conn;

    //mengambil data dari tiap elemen form
    $id_pasien = $data["id_pasien"];
    $nama_pasien = htmlspecialchars($data["nama_pasien"]);
    $usia = htmlspecialchars($data["usia"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);

    //query insert data
    $query = "UPDATE pasien SET 
				nama_pasien = '$nama_pasien',
                usia = '$usia',
                email = '$email',
                alamat = '$alamat'

			  WHERE id_pasien = $id_pasien
			 ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_pengguna($id_pasien)
{
    global $conn;
    //query delete data
    mysqli_query($conn, "DELETE FROM pasien WHERE id_pasien = '$id_pasien'");
    return mysqli_affected_rows($conn);
}
