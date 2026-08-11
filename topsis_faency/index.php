<?php
session_start();
include 'assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'login') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM tbl_akun WHERE username = '$username' AND password = '$password'");
    $cek   = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        
        // Redirect berdasarkan level
        if ($data['level'] == 'ADMIN') {
            header("Location: admin/index.php");
            exit();
        } elseif ($data['level'] == 'OWNER') {
            header("Location: admin/index.php");
            exit();
        }
    } else {
        header("Location: index.php?pesan=gagal");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PENERAPAN METODE TOPSIS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="login-container">
  <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") { ?>
    <div class="custom-alert">
      Login gagal! Username atau password salah.
    </div>
  <?php } ?>

<div class="login-box">
  <h4 class="text-center mb-4">Login</h4>
  <form action="index.php?aksi=login" method="post">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-success">LOGIN</button>
    </div>
  </form>
</div>

</body>
</html>