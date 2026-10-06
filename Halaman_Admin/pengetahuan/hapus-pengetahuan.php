<?php

require 'controllers-pengetahuan.php';

$id_pengetahuan = $_GET['id_pengetahuan'];

if (hapus_pengetahuan($id_pengetahuan) > 0) {
	echo " <script>
					alert('Data Basis Pengetahuan Berhasil Dihapus');
					document.location.href ='../basis-pengetahuan.php';
			   </script>
			 ";
} else {
	echo " <script>
					alert('Data Basis Pengetahuan Gagal Dihapus');
					document.location.href ='../basis-pengetahuan.php';
			   </script>
			 ";
}
