<?php include 'header.php'; ?>

<div class="container my-4">
  <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'akses_ditolak') { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Akses Ditolak!</strong> Anda tidak memiliki izin untuk mengakses halaman tersebut.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php } ?>

  <div class="text-center">
    <h2 class="hero-title">
      SISTEM PENDUKUNG KEPUTUSAN REKOMENDASI SUPPLIER
    </h2>
    
    <div class="mt-4">
      <div class="card bg-dark text-white shadow">
        <div class="card-body">
          <h5>Selamat Datang, <?= $_SESSION['nama_lengkap'] ?? $_SESSION['username'] ?>!</h5>
          <p class="mb-0">Anda login sebagai: <span class="badge bg-info"><?= $_SESSION['level'] ?></span></p>
        </div>
      </div>
    </div>

    <?php if ($_SESSION['level'] == 'OWNER') { ?>
    <div class="mt-4">
      <div class="alert alert-info">
        <strong>Info:</strong> Sebagai Owner, Anda dapat melihat perhitungan Metode TOPSIS dan Hasil Analisa, serta mencetaknya.
      </div>
    </div>
    <?php } ?>
  </div>
</div>