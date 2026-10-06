<?php
    include('koneksi.php');
    $nama_pasien    = $_POST['nama_pasien'];
    $usia           = $_POST['usia'];
    $email          = $_POST['email'];
    $alamat         = $_POST['alamat'];

    $tambah  = mysqli_query($conn, "INSERT INTO pasien VALUES(NULL, '$nama_pasien', '$usia', '$email', '$alamat')");
    //mengecek apakah query tambah berhasil
    if ($tambah) {
        // jika berhasil maka akan mengambil id pasien yg tadi ditambahkan
        $get_id = mysqli_query($conn, "SELECT id_pasien FROM pasien ORDER BY id_pasien DESC LIMIT 1");
        while ($row_id = mysqli_fetch_array($get_id)) {
            // lalu akan menyimpan id pasien kedalam sesion
            session_start();
            $_SESSION['id_pasien'] = $row_id['id_pasien'];
    ?>
        <script>
            window.location = 'konsul.php'
        </script>
    <?php
        }
    } else {
        echo "<script>window.location='form-datadiri.php';</script>";
    }
?>