<?php include 'header.php'; ?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item active" aria-current="page">
            <h4 class="m-0">KRITERIA</h4>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <!-- Card -->
      <div class="card shadow-sm">
        <div class="card-body">
          <a href="kriteria-aksi.php?aksi=tambah" class="btn btn-success mb-3">TAMBAH DATA</a>

          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Kriteria</th>
                  <th>Bobot</th>
                  <th>Subkriteria</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td class="text-center"><?php echo $a['nama_kriteria'] ?></td>
                  <td class="text-center"><?php echo $a['bobot_kriteria'] ?></td>
                  <td class="text-center">
                    <a href="subkriteria.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&aksi=ubah" class="btn btn-warning btn-sm">SUBKRITERIA</a>
                  </td>
                  <td class="text-center">
                    <a href="kriteria-aksi.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&aksi=ubah" class="btn btn-primary btn-sm">UBAH</a>
                    <a href="kriteria-proses.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&proses=hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">HAPUS</a>
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
