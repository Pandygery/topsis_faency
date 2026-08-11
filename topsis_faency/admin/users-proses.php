<?php 
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {
  if ($_GET['proses'] == 'simpan') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);

    mysqli_query($conn, "INSERT INTO tbl_akun (username, password, nama_lengkap, level) VALUES ('$username', '$password', '$nama_lengkap', '$level')");
    header("location:users.php");

  } elseif ($_GET['proses'] == 'ubah') {
    $id_akun = $_POST['id_akun'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);

    if (!empty($_POST['password'])) {
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      mysqli_query($conn, "UPDATE tbl_akun SET username='$username', password='$password', nama_lengkap='$nama_lengkap', level='$level' WHERE id_akun='$id_akun'");
    } else {
      mysqli_query($conn, "UPDATE tbl_akun SET username='$username', nama_lengkap='$nama_lengkap', level='$level' WHERE id_akun='$id_akun'");
    }
    header("location:users.php");

  } elseif ($_GET['proses'] == 'hapus') {
    $id_akun = $_GET['id_akun'];
    mysqli_query($conn, "DELETE FROM tbl_akun WHERE id_akun='$id_akun'");
    header("location:users.php");
  }
}
?>