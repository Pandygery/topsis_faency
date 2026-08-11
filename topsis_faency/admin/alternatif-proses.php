<?php include '../assets/conn/config.php';
if (isset($_GET['proses'])) {
  if ($_GET['proses'] == 'simpan') {
      $nama_alternatif = $_POST['nama_alternatif'];
     mysqli_query($conn, "INSERT INTO tbl_alternatif (nama_alternatif) VALUES ('$nama_alternatif')");
      header("location:alternatif.php");

    }elseif ($_GET['proses'] == 'ubah') {
        $id_alternatif = $_POST['id_alternatif'];
        $nama_alternatif = $_POST['nama_alternatif'];
        
        mysqli_query($conn, "UPDATE tbl_alternatif SET nama_alternatif='$nama_alternatif' WHERE id_alternatif='$id_alternatif'");
        header("location:alternatif.php");
      
    } elseif ($_GET['proses'] == 'hapus') {
      $id_alternatif = $_GET['id_alternatif'];
      mysqli_query($conn, "DELETE FROM tbl_alternatif WHERE id_alternatif='$id_alternatif'");
      header("location:alternatif.php");
    }
  }
  ?>