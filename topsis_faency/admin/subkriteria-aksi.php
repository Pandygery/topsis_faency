<?php
include 'header.php';

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'tambah') {
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb"><h4>SUBKRITERIA / TAMBAH DATA</h4></ol>
  </div>

  <div class="panel panel-container">
    <div class="bootstrap-table">
      <form action="subkriteria-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_kriteria" value="<?php echo $_GET['id_kriteria']; ?>">
        <div class="form-group">
          <label>Nama Subkriteria</label>
          <input type="text" name="nama_subkriteria" class="form-control" placeholder="nama subkriteria">
        </div>

        <div class="form-group">
          <label>Nilai Subriteria</label>
          <input type="number" name="nilai_subkriteria" class="form-control" placeholder="0">
        </div>

        <div class="modal-footer">
          <a href="subkriteria.php?id_kriteria=<?php echo $_GET['id_kriteria']; ?>" class="btn btn-danger">BATAL</a>
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
    <ol class="breadcrumb"><h4>SUBKRITERIA / UBAH DATA</h4></ol>
  </div>

  <div class="panel panel-container">
    <div class="bootstrap-table">
      <?php $data = mysqli_query($conn, "SELECT * FROM tbl_subkriteria WHERE id_subkriteria=' ". $_GET['id_subkriteria'] ."'");
while ($a=mysqli_fetch_array($data)) { ?>

      <form action="subkriteria-proses.php?proses=ubah" method="post" enctype="multipart/form-data">
     
      <input type="hidden" name="id_kriteria" value="<?php echo $a['id_kriteria']; ?>">
      
      <input type="hidden" name="id_subkriteria" value="<?php echo $a['id_subkriteria']; ?>">

      <div class="form-group">
          <label>Nama Subkriteria</label>
          <input type="text" name="nama_subkriteria" class="form-control" value="<?php echo $a['nama_subkriteria']; ?>">
        </div>

        <div class="form-group">
          <label>Nilai Subkriteria</label>
          <input type="number" name="nilai_subkriteria" class="form-control" value="<?php echo $a['nilai_subkriteria']; ?>">
        </div>

        <div class="modal-footer">
          <a href="subkriteria.php?id_kriteria=<?php echo $a['id_kriteria']; ?>" class="btn btn-primary">BATAL</a>
          <input type="submit" class="btn btn-danger" value="UBAH">
        </div>
      </form>

      <?php } ?>
    </div>
  </div>
</div>

<?php } } ?>