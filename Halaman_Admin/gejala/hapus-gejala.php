<?php

require 'controllers-gejala.php';

$kd_gejala = $_GET['kd_gejala'];

if (hapus_gejala($kd_gejala) > 0) {
	echo " <script>
					alert('Data Gejala Berhasil Dihapus');
					document.location.href ='../gejala.php';
			   </script>
			 ";
} else {
	echo " <script>
					alert('Data Gejala Gagal Dihapus');
					document.location.href ='../gejala.php';
			   </script>
			 ";
}
