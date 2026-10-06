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
        die("Maaf Database Tidak Terkoneksi : " . mysqli_connect_error());
    }
