<?php
session_start();
include '../assets/conn/config.php';
include '../assets/conn/cek.php';

// deteksi halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);
$user_level = $_SESSION['level'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PENERAPAN METODE TOPSIS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/nav.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-uppercase" href="index.php">TOPSIS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php' ? 'active' : '') ?>" href="index.php">Home</a>
        </li>

        <?php if ($user_level == 'ADMIN') { ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'alternatif.php' ? 'active' : '') ?>" href="alternatif.php">Alternatif</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'kriteria.php' ? 'active' : '') ?>" href="kriteria.php">Kriteria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'nilai.php' ? 'active' : '') ?>" href="nilai.php">Nilai</a>
        </li>
        <?php } ?>

        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'metode.php' ? 'active' : '') ?>" href="metode.php">Metode Topsis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'hasil.php' ? 'active' : '') ?>" href="hasil.php">Hasil Analisa</a>
        </li>

        <?php if ($user_level == 'ADMIN') { ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'users.php' ? 'active' : '') ?>" href="users.php">Kelola Akun</a>
        </li>
        <?php } ?>

        <li class="nav-item">
          <span class="nav-link text-info">
            <small><?= $_SESSION['nama_lengkap'] ?? $_SESSION['username'] ?> (<?= $user_level ?>)</small>
          </span>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

</body>
</html>