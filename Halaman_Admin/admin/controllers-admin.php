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

function admin($admin)
{
    global $conn;
    $result = mysqli_query($conn, $admin);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_admin($data)
{
    global $conn;
    //mengambil data dari tiap elemen form
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $nama = htmlspecialchars($data["nama"]);

    //query insert data
    $query = "INSERT INTO admin
		    VALUES
			('','$username','$password','$nama')
			";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_admin($data)
{
    global $conn;
    //mengambil data dari tiap elemen form
    $id_admin = $data["id_admin"];
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $nama = htmlspecialchars($data["nama"]);

    //query insert data
    $query = "UPDATE admin SET 
				username = '$username',
                password = '$password',
                nama = '$nama'
                
			WHERE id_admin = $id_admin
			";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_admin($id_admin)
{
    global $conn;
    //query delete data
    mysqli_query($conn, "DELETE FROM admin WHERE id_admin = '$id_admin'");

    return mysqli_affected_rows($conn);
}
