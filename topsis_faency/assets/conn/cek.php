<?php
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Fungsi cek akses halaman berdasarkan level
function cekAksesAdmin() {
    if ($_SESSION['level'] != 'ADMIN') {
        header("Location: index.php?pesan=akses_ditolak");
        exit();
    }
}
?>