<?php include '../assets/conn/config.php';
if (isset($_GET['proses'])) {
  if ($_GET['proses'] == 'simpan') {
      $nama_kriteria = $_POST['nama_kriteria'];
      $bobot_kriteria = $_POST['bobot_kriteria'];
      mysqli_query($conn, "INSERT INTO tbl_kriteria (nama_kriteria, bobot_kriteria) VALUES ('$nama_kriteria', '$bobot_kriteria')");
      header("location:kriteria.php");

    }elseif ($_GET['proses'] == 'ubah') {
        $id_kriteria = $_POST['id_kriteria'];
        $nama_kriteria = $_POST['nama_kriteria'];
        $bobot_kriteria = $_POST['bobot_kriteria'];

        mysqli_query($conn, "UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria', bobot_kriteria='$bobot_kriteria' WHERE id_kriteria='$id_kriteria'");
        header("location:kriteria.php");
      
    } elseif ($_GET['proses'] == 'hapus') {
      $id_kriteria = $_GET['id_kriteria'];
      mysqli_query($conn, "DELETE FROM tbl_kriteria WHERE id_kriteria='$id_kriteria'");
      header("location:kriteria.php");
    }
  }
  ?>