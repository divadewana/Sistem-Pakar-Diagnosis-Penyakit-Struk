<?php

require 'controllers-pengguna.php';

$id_pasien = $_GET['id_pasien'];

if (hapus_pengguna($id_pasien) > 0) {
    echo " <script>
					alert('Data Pengguna atau Pasien Berhasil Dihapus');
					document.location.href ='../pengguna.php';
			   </script>
			 ";
} else {
    echo " <script>
					alert('Data Pengguna atau Pasien Gagal Dihapus');
					document.location.href ='../pengguna.php';
			   </script>
			 ";
}
