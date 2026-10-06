<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $penyakit = $_POST['penyakit'];
    
    echo "Anda telah memilih penyakit: " . htmlspecialchars($penyakit);
}

