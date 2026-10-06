<?php

require 'controllers-penyakit.php';

$kd_penyakit = $_GET['kd_penyakit'];

if (hapus_penyakit($kd_penyakit) > 0) {
	echo "<script>
					alert('Data Penyakit Berhasil Dihapus');
					document.location.href ='../penyakit.php';
			</script>
		";
} else {
	echo " <script>
					alert('Data Penyakit Gagal Dihapus');
					document.location.href ='../penyakit.php';
			   </script>
			 ";
}
