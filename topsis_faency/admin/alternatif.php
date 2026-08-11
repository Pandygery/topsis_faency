<?php include 'header.php'; ?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item active" aria-current="page">
            <h4 class="m-0">ALTERNATIF</h4>
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
          <a href="alternatif-aksi.php?aksi=tambah" class="btn btn-success mb-3">TAMBAH DATA</a>
          
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td class="text-center"><?php echo $a['nama_alternatif'] ?></td>
                  <td class="text-center">
                    <a href="alternatif-aksi.php?id_alternatif=<?php echo $a['id_alternatif'] ?>&aksi=ubah" class="btn btn-primary btn-sm">UBAH</a>
                    <a href="alternatif-proses.php?id_alternatif=<?php echo $a['id_alternatif'] ?>&proses=hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">HAPUS</a>
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
