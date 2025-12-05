<?php include 'header.php'; ?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item active" aria-current="page">
            <h4 class="m-0">KELOLA AKUN</h4>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <a href="users-aksi.php?aksi=tambah" class="btn btn-success mb-3">TAMBAH AKUN</a>

          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Nama Lengkap</th>
                  <th>Level</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_akun ORDER BY id_akun");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td class="text-center"><?php echo $a['username'] ?></td>
                  <td class="text-center"><?php echo $a['nama_lengkap'] ?></td>
                  <td class="text-center">
                    <span class="badge <?php echo ($a['level'] == 'ADMIN') ? 'bg-primary' : 'bg-info'; ?>">
                      <?php echo $a['level'] ?>
                    </span>
                  </td>
                  <td class="text-center">
                    <a href="users-aksi.php?id_akun=<?php echo $a['id_akun'] ?>&aksi=ubah" class="btn btn-primary btn-sm">UBAH</a>
                    <a href="users-proses.php?id_akun=<?php echo $a['id_akun'] ?>&proses=hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus akun ini?')">HAPUS</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>