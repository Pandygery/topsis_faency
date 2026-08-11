<?php 
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'simpan') {
        $id_alternatif = mysqli_real_escape_string($conn, $_POST['id_alternatif']);

        // Cek apakah alternatif sudah memiliki nilai
        $cek_nilai = mysqli_query($conn, "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif'");
        
        if (mysqli_num_rows($cek_nilai) > 0) {
            // Jika sudah ada, redirect dengan pesan error
            header('location:nilai.php?pesan=sudah_ada');
            exit();
        }

        // Ambil semua kriteria
        $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
        
        $berhasil = true;
        while ($result = mysqli_fetch_array($query)) {
            $idk = $result['id_kriteria'];
            
            // Pastikan ada input untuk kriteria ini
            if (isset($_POST[$idk]) && !empty($_POST[$idk])) {
                $ids = mysqli_real_escape_string($conn, $_POST[$idk]);
                
                // Insert ke database
                $query1 = "INSERT INTO tbl_nilai(id_alternatif, id_kriteria, id_subkriteria) 
                          VALUES('$id_alternatif', '$idk', '$ids')";
                $result1 = mysqli_query($conn, $query1);
                
                if (!$result1) {
                    $berhasil = false;
                    break;
                }
            } else {
                $berhasil = false;
                break;
            }
        }

        if ($berhasil) {
            header('location:nilai.php?pesan=berhasil');
        } else {
            // Hapus data yang sudah masuk jika gagal
            mysqli_query($conn, "DELETE FROM tbl_nilai WHERE id_alternatif='$id_alternatif'");
            header('location:nilai.php?pesan=gagal');
        }

    } elseif ($_GET['proses'] == 'ubah') {
        $id_alternatif = mysqli_real_escape_string($conn, $_POST['id_alternatif']);

        // Hapus data lama
        $query2 = "DELETE FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
        mysqli_query($conn, $query2);

        // Insert data baru
        $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
        
        $berhasil = true;
        while ($result = mysqli_fetch_array($query)) {
            $idk = $result['id_kriteria'];
            
            if (isset($_POST[$idk]) && !empty($_POST[$idk])) {
                $ids = mysqli_real_escape_string($conn, $_POST[$idk]);
                
                $query1 = "INSERT INTO tbl_nilai(id_alternatif, id_kriteria, id_subkriteria) 
                          VALUES('$id_alternatif', '$idk', '$ids')";
                $result1 = mysqli_query($conn, $query1);
                
                if (!$result1) {
                    $berhasil = false;
                    break;
                }
            }
        }

        if ($berhasil) {
            header('location:nilai.php?pesan=berhasil_ubah');
        } else {
            header('location:nilai.php?pesan=gagal_ubah');
        }

    } elseif ($_GET['proses'] == 'hapus') {
        $id_alternatif = mysqli_real_escape_string($conn, $_GET['id_alternatif']);
        
        $query2 = "DELETE FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
        mysqli_query($conn, $query2);

        header('location:nilai.php?pesan=berhasil_hapus');
    }
}
?>