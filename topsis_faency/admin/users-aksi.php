<?php
include 'header.php';

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'tambah') {
?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item"><a href="users.php">Akun</a></li>
          <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="users-proses.php?proses=simpan" method="post">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Level</label>
          <select name="level" class="form-control" required>
            <option value="">-- Pilih Level --</option>
            <option value="ADMIN">ADMIN</option>
            <option value="OWNER">OWNER</option>
          </select>
        </div>

        <div class="d-flex gap-2">
          <a href="users.php" class="btn btn-danger">BATAL</a>
          <input type="submit" class="btn btn-primary" value="SIMPAN">
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  } elseif ($_GET['aksi'] == 'ubah') { 
    $data = mysqli_query($conn, "SELECT * FROM tbl_akun WHERE id_akun='". $_GET['id_akun'] ."'");
    $a = mysqli_fetch_array($data);
?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item"><a href="users.php">Akun</a></li>
          <li class="breadcrumb-item active">Ubah Data</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="users-proses.php?proses=ubah" method="post">
        <input type="hidden" name="id_akun" value="<?php echo $a['id_akun']; ?>">

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?php echo $a['username']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
          <input type="password" name="password" class="form-control" placeholder="Password baru">
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $a['nama_lengkap']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Level</label>
          <select name="level" class="form-control" required>
            <option value="ADMIN" <?php echo ($a['level'] == 'ADMIN') ? 'selected' : ''; ?>>ADMIN</option>
            <option value="OWNER" <?php echo ($a['level'] == 'OWNER') ? 'selected' : ''; ?>>OWNER</option>
          </select>
        </div>

        <div class="d-flex gap-2">
          <a href="users.php" class="btn btn-primary">BATAL</a>
          <input type="submit" class="btn btn-danger" value="UBAH">
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  }
}
?>