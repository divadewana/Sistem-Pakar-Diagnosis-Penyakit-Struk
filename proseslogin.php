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
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $get_admin = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $login = $conn->query($get_admin);
    if (!$login) {
        die("Query Error: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    }
    $masuk = $login->fetch_assoc();
    //cek jika terdapat data admin yg login dan sesuai
    if ($login->num_rows > 0) {
        $_SESSION["login"] = true;

        $_SESSION['username'] = $username;
        header("Location: Halaman_Admin/home.php");
    } else {
        $_SESSION['status'] = "Maaf Username atau Password Anda Salah";
    }
}