<?php include 'header.php'; ?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item active" aria-current="page">
            <h4 class="m-0">NILAI</h4>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Notifikasi -->
  <?php if (isset($_GET['pesan'])) { ?>
    <div class="row">
      <div class="col-12">
        <?php if ($_GET['pesan'] == 'berhasil') { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Data nilai berhasil ditambahkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php } elseif ($_GET['pesan'] == 'gagal') { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Data nilai gagal ditambahkan. Pastikan semua kriteria terisi.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php } elseif ($_GET['pesan'] == 'sudah_ada') { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Alternatif ini sudah memiliki nilai. Gunakan menu UBAH untuk mengubah data.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php } elseif ($_GET['pesan'] == 'berhasil_ubah') { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Data nilai berhasil diubah.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php } elseif ($_GET['pesan'] == 'berhasil_hapus') { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Data nilai berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <div class="row">
    <div class="col-12">
      <!-- Card -->
      <div class="card shadow-sm">
        <div class="card-body">
          <a href="nilai-aksi.php?aksi=tambah" class="btn btn-success mb-3">TAMBAH DATA</a>

          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { 
                  $nomor = $no++;
                  $id_alternatif = $a['id_alternatif'];
                  $nama_alternatif = $a['nama_alternatif'];
                ?>
                <tr>
                  <td class="text-center"><?php echo $nomor ?></td>
                  <td class="text-center"><?php echo $nama_alternatif ?></td>

                  <?php
                  $query1 = mysqli_query($conn, "SELECT a.nama_subkriteria as nama_sub 
                  FROM tbl_subkriteria a, tbl_nilai b 
                  WHERE b.id_alternatif='$id_alternatif' 
                  AND a.id_subkriteria=b.id_subkriteria 
                  ORDER BY b.id_kriteria");
                  
                  $jumlah_nilai = mysqli_num_rows($query1);
                  
                  if ($jumlah_nilai > 0) {
                    while ($result=mysqli_fetch_array($query1)) { 
                      echo "<td class='text-center'>$result[nama_sub]</td>";
                    }
                  } else {
                    // Jika belum ada nilai, tampilkan kolom kosong
                    $jumlah_kriteria = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_kriteria"));
                    for ($i = 0; $i < $jumlah_kriteria; $i++) {
                      echo "<td class='text-center text-muted'>-</td>";
                    }
                  }
                  ?>

                  <td class="text-center">
                    <?php if ($jumlah_nilai > 0) { ?>
                      <a href="nilai-aksi.php?id_alternatif=<?php echo $a['id_alternatif'] ?>&aksi=ubah" class="btn btn-primary btn-sm">UBAH</a>
                      <a href="nilai-proses.php?id_alternatif=<?php echo $a['id_alternatif'] ?>&proses=hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">HAPUS</a>
                    <?php } else { ?>
                      <a href="nilai-aksi.php?aksi=tambah&id_alternatif=<?php echo $a['id_alternatif'] ?>" class="btn btn-warning btn-sm">TAMBAH NILAI</a>
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- End Card -->
    </div>
  </div>
</div>