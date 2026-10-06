<?php
// mengaktifkan session
session_start();

// menghapus semua session
session_destroy();

// mengalihkan halaman login
echo "<script>alert('Berhasil Logout dari Aplikasi Sistem Pakar !!!'); 
        window.location=('index.php');
    </script>";
