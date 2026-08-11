<?php include "header.php"; ?>
<div class="container">
<?php
if (isset($_GET['id_kriteria'])) {
    $id_kriteria = $_GET['id_kriteria'];
    $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria WHERE id_kriteria='$id_kriteria'");
    $a = mysqli_fetch_array($data);
?>
<div class="row">
    <ol class="breadcrumb"><h4>SUBKRITERIA / <a href="kriteria.php"><?php echo $a['nama_kriteria'] ?></a></h4></ol>
</div>

<div class="panel panel-container">
    <div class="bootstrap-table">
        <a href="subkriteria-aksi.php?id_kriteria=<?php echo $id_kriteria ?>&aksi=tambah"
           class="btn btn-success">TAMBAH DATA</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Subkriteria</th>
                        <th class="text-center">Nilai</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY id_subkriteria");
                $no = 1;
                while ($a = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td class="text-center"><?php echo $no++ ?></td>
                    <td class="text-center"><?php echo $a['nama_subkriteria'] ?></td>
                    <td class="text-center"><?php echo $a['nilai_subkriteria'] ?></td>

                    <td class="text-center">
                        <a href="subkriteria-aksi.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&id_subkriteria=<?php echo $a['id_subkriteria'] ?>&aksi=ubah"
                           class="btn btn-primary">UBAH</a>
                        <a href="subkriteria-proses.php?id_kriteria=<?php echo $a['id_kriteria'] ?>&id_subkriteria=<?php echo $a['id_subkriteria'] ?>&proses=hapus"
                           class="btn btn-danger">HAPUS</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
} 
?>
