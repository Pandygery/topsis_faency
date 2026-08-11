<?php
include 'header.php';

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'tambah') {
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb"><h4>NILAI / TAMBAH DATA</h4></ol>
  </div>

  <div class="panel panel-container">
    <div class="bootstrap-table">
      <form action="nilai-proses.php?proses=simpan" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label>Nama Alternatif</label>
          <select class="form-control" name="id_alternatif">
            <option selected disabled>Pilih</option>
            <?php
           $query = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
           while ($result=mysqli_fetch_array($query)) { 
             echo "<option value='$result[id_alternatif]'>$result[nama_alternatif]</option>";
           }
            ?>
          </select>
         </div>

        <?php
        $query1 = mysqli_query($conn,"SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
        while ($result1=mysqli_fetch_array($query1)) {
            $id_kriteria = $result1['id_kriteria'];
            $nama_kriteria = $result1['nama_kriteria'];
            
            echo "<div class='form-group'>
                  <label>$nama_kriteria</label>
                  <select name=\"$id_kriteria\" class='form-control'>";

                  $query2 = mysqli_query($conn,"SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
                  while ($result2=mysqli_fetch_array($query2)) {
                      echo "<option selected value=\"{$result2['id_subkriteria']}\">{$result2['nama_subkriteria']} - {$result2['nilai_subkriteria']}</option>";
                  }
                  echo "</select>
                </div>";
        }
        ?>

        <div class="modal-footer">
          <a href="nilai.php" class="btn btn-danger">BATAL</a>
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
    <ol class="breadcrumb"><h4>NILAI / UBAH DATA</h4></ol>
  </div>

  <div class="panel panel-container">
    <div class="bootstrap-table">

      <form action="nilai-proses.php?proses=ubah" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
          <label>Nama Alternatif</label>
          <?php
          $id_alternatif = $_GET['id_alternatif'];
          $query3 = mysqli_query($conn, "SELECT * FROM tbl_alternatif WHERE id_alternatif='$id_alternatif'");
          $result3 = mysqli_fetch_array($query3);
          ?>
          <select class="form-control" name="id_alternatif">
            <option selected value="<?php echo $result3['id_alternatif'] ?>"><?php echo $result3['nama_alternatif'] ?></option>
            <?php
            $query = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
            while ($result = mysqli_fetch_array($query)) { 
              echo "<option value='$result[id_alternatif]'>$result[nama_alternatif]</option>";
            }
            ?>
          </select>
        </div>

        <?php
        $query1 = mysqli_query($conn,"SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
        while ($result1 = mysqli_fetch_array($query1)) {
            $id_kriteria   = $result1['id_kriteria'];
            $nama_kriteria = $result1['nama_kriteria'];
            $id_alternatif = $_GET['id_alternatif'];

            $query4 = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_kriteria='$id_kriteria' AND id_alternatif='$id_alternatif'");
            $result4 = mysqli_fetch_array($query4);

            // default null jika belum ada data di tbl_nilai
            $id_sub = null;
            if ($result4) {
              $id_sub = $result4['id_subkriteria'];
            }

            echo "<div class='form-group'>
                    <label>$nama_kriteria</label>
                    <select name=\"$id_kriteria\" class='form-control'>";

            $query2 = mysqli_query($conn,"SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria DESC");
            while ($result2 = mysqli_fetch_array($query2)) {
              if ($id_sub !== null && $result2['id_subkriteria'] == $id_sub) {
                echo "<option value=\"{$result2['id_subkriteria']}\" selected>{$result2['nama_subkriteria']} - {$result2['nilai_subkriteria']}</option>";
              } else {
                echo "<option value=\"{$result2['id_subkriteria']}\">{$result2['nama_subkriteria']} - {$result2['nilai_subkriteria']}</option>";
              }
            }

            echo "</select>
                </div>";
        }
        ?>

        <div class="modal-footer">
          <a href="nilai.php" class="btn btn-primary">BATAL</a>
          <input type="submit" class="btn btn-danger" value="UBAH">
        </div>
      </form>

    </div>
  </div>
</div>

<?php } } ?>