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
                  while ($result=mysqli_fetch_array($query1)) { 
                    echo "<td class='text-center'>$result[nama_sub]</td>";
                  }
                  ?>

                  <td class="text-center">
                    <a href="nilai-aksi.php?id_alternatif=<?php echo $a['id_alternatif'] ?>&aksi=ubah" class="btn btn-primary btn-sm">UBAH</a>
                    <a href="nilai-proses.php?id_alternatif=<?php echo $a['id_alternatif'] ?>&proses=hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">HAPUS</a>
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
