<?php include '../assets/conn/config.php';
if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'simpan') {
        $id_alternatif = $_POST['id_alternatif'];

        $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
        while ($result = mysqli_fetch_array($query)) {
            $idk = $result['id_kriteria'];
            $ids = $_POST[$idk];

            $query1 = "INSERT INTO tbl_nilai(id_alternatif, id_kriteria, id_subkriteria) VALUES('$id_alternatif', '$idk', '$ids')";
            $result1 = mysqli_query($conn, $query1);
        }

        header('location:nilai.php');

    } elseif ($_GET['proses'] == 'ubah') {

    $id_alternatif = $_POST['id_alternatif'];

    $query2 = "DELETE FROM tbl_nilai WHERE id_alternatif='" . $_POST['id_alternatif'] . "'";
    $result2 = mysqli_query($conn, $query2);

        $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
        while ($result = mysqli_fetch_array($query)) {
            $idk = $result['id_kriteria'];
            $ids = $_POST[$idk];

            $query1 = "INSERT INTO tbl_nilai(id_alternatif, id_kriteria, id_subkriteria) VALUES('$id_alternatif', '$idk', '$ids')";
            $result1 = mysqli_query($conn, $query1);
        }

        header('location:nilai.php');

    } elseif ($_GET['proses'] == 'hapus') {

    $id_alternatif = $_GET['id_alternatif'];
    $squery2 = "DELETE FROM tbl_nilai WHERE id_alternatif='" . $_GET['id_alternatif'] . "'";
    $result2 = mysqli_query($conn, $squery2);

        header('location:nilai.php');
    }
}
