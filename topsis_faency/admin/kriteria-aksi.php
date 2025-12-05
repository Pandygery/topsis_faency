<?php
include 'header.php';

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'tambah') {
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb"><h4>KRITERIA / TAMBAH DATA</h4></ol>
  </div>

  <div class="panel panel-container">
    <div class="bootstrap-table">
      <form action="kriteria-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama Kriteria</label>
          <input type="text" name="nama_kriteria" class="form-control" placeholder="nama kriteria">
        </div>

        <div class="form-group">
          <label>Bobot Kriteria</label>
          <input type="text" name="bobot_kriteria" class="form-control" placeholder="bobot kriteria">
        </div>

        <div class="modal-footer">
          <a href="kriteria.php" class="btn btn-danger">BATAL</a>
          <input type="submit" class="btn btn-primary" value="SIMPAN">
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  } elseif ($_GET['aksi'] == 'ubah') { ?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb"><h4>KRITERIA / UBAH DATA</h4></ol>
  </div>

  <div class="panel panel-container">
    <div class="bootstrap-table">
      <?php $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria WHERE id_kriteria=' ". $_GET['id_kriteria'] ."'");
while ($a=mysqli_fetch_array($data)) { ?>

      <form action="kriteria-proses.php?proses=ubah" method="post" enctype="multipart/form-data">
        
      <input type="hidden" name="id_kriteria" value="<?php echo $a['id_kriteria']; ?>">

      <div class="form-group">
          <label>Nama Kriteria</label>
          <input type="text" name="nama_kriteria" class="form-control" value="<?php echo $a['nama_kriteria']; ?>">
        </div>

        <div class="form-group">
          <label>Bobot Kriteria</label>
          <input type="text" name="bobot_kriteria" class="form-control" value="<?php echo $a['bobot_kriteria']; ?>">
        </div>

        <div class="modal-footer">
          <a href="kriteria.php" class="btn btn-primary">BATAL</a>
          <input type="submit" class="btn btn-danger" value="UBAH">
        </div>
      </form>

      <?php } ?>
    </div>
  </div>
</div>

<?php } } ?>