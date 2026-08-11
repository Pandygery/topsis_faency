<?php include 'header.php'; ?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item active" aria-current="page">
            <h4 class="m-0">METODE TOPSIS</h4>
          </li>
        </ol>
      </nav>
    </div>
    <?php
    ?>
  </div>

  <div class="row">
    <div class="col-12">
      <!-- Card -->
      <div class="card shadow-sm">
        <div class="card-body">
            <hr>
            <h4>Nilai Keputusan</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                 
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { 
                  $nomor = $no++;
                  $id_alternatif = $a['id_alternatif'];
                  $nama_alternatif = $a['nama_alternatif'];
                ?>
                <tr>
                  <td class="text-center"><?php echo $nomor ?></td>
                  <td class="text-center"><?php echo $nama_alternatif ?></td>

                  <?php
                  $query1 = mysqli_query($conn, "SELECT a.nama_subkriteria as nama_sub 
                  FROM tbl_subkriteria a, tbl_nilai b 
                  WHERE b.id_alternatif='$id_alternatif' 
                  AND a.id_subkriteria=b.id_subkriteria 
                  ORDER BY b.id_kriteria");
                  while ($result=mysqli_fetch_array($query1)) { 
                    echo "<td class='text-center'>$result[nama_sub]</td>";
                  }
                  ?>

                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
<div class="card shadow-sm">
<div class="card-body">
    <hr>
      <h4>Konversi Nilai Keputusan</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                 
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { 
                  $nomor = $no++;
                  $id_alternatif = $a['id_alternatif'];
                  $nama_alternatif = $a['nama_alternatif'];
                ?>
                <tr>
                  <td class="text-center"><?php echo $nomor ?></td>
                  <td class="text-center"><?php echo $nama_alternatif ?></td>

                  <?php
                  $query1 = mysqli_query($conn, "SELECT a.nilai_subkriteria as nama_sub 
                  FROM tbl_subkriteria a, tbl_nilai b 
                  WHERE b.id_alternatif='$id_alternatif' 
                  AND a.id_subkriteria=b.id_subkriteria 
                  ORDER BY b.id_kriteria");
                  while ($result=mysqli_fetch_array($query1)) { 
                    echo "<td class='text-center'>$result[nama_sub]</td>";
                  }
                  ?>

                </tr>
                <?php } ?>
              </tbody>
              <tr>
                <td colspan="2">Hasil Pangkat</td>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                while ($a=mysqli_fetch_array($data)) {
                $sum_pangkat = 0;
                $id_kriteria = $a['id_kriteria'];

                $querry = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub FROM tbl_subkriteria s, tbl_nilai kp, tbl_kriteria k WHERE kp.id_kriteria='$id_kriteria' AND s.id_subkriteria=kp.id_subkriteria AND k.id_kriteria=kp.id_kriteria ORDER BY kp.id_kriteria");
                while ($result=mysqli_fetch_array($querry)) {
                    // pangkatkan setiap nilai_subkriteria, kemudian jumlahkan
                    $hsl_pangkat = pow($result['nama_sub'], 2);
                    $sum_pangkat += $hsl_pangkat;
                }
                echo "<td class='text-center'><b>$sum_pangkat</b></td>";
                } ?>
              </tr>
              <tr>
                <td colspan="2">Hasil Akar</td>
                 <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                while ($a=mysqli_fetch_array($data)) {
                $sum_pangkat = 0;
                $id_kriteria = $a['id_kriteria'];

                $querry = mysqli_query($conn, "SELECT s.nilai_subkriteria as nama_sub FROM tbl_subkriteria s, tbl_nilai kp, tbl_kriteria k WHERE kp.id_kriteria='$id_kriteria' AND s.id_subkriteria=kp.id_subkriteria AND k.id_kriteria=kp.id_kriteria ORDER BY kp.id_kriteria");
                while ($result=mysqli_fetch_array($querry)) {
                    // pangkatkan setiap nilai_subkriteria, kemudian jumlahkan
                    $hsl_pangkat = pow($result['nama_sub'], 2);
                    $sum_pangkat += $hsl_pangkat;
                    //akarkan setiap jumlah dari nilai pangkat
                    $hsl_akar = sqrt($sum_pangkat);
                    $round = number_format($hsl_akar, 4);
                }
                echo "<td class='text-center'><b>$round</b></td>";
                //ambil nilai akar, kemudian simpan ke dalam tbl kriteria
                mysqli_query($conn, "UPDATE tbl_kriteria SET akar_kriteria='$hsl_akar' WHERE id_kriteria='$id_kriteria'");
              } ?>
              </tr>

            </table>
          </div>
        </div>
      </div>

            
<div class="card shadow-sm">
<div class="card-body">
    <hr>
      <h4>Normalisasi Matriks</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                 
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
while ($a=mysqli_fetch_array($data)) {
    $nomor = $no++;
    $id_alternatif = $a['id_alternatif'];
    $nama_alternatif = $a['nama_alternatif'];
?>
    <td class="text-center"><?php echo $nomor ?></td>
    <td class="text-center"><?php echo $nama_alternatif ?></td>
              <?php
              $query = mysqli_query($conn,"SELECT s.nilai_subkriteria as nama_sub, n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, tbl_kriteria k WHERE n.id_alternatif='$id_alternatif' AND n.id_kriteria=k.id_kriteria AND n.id_subkriteria=s.id_subkriteria ORDER BY n.id_kriteria");
              while ($result=mysqli_fetch_array($query)) {
                  //panggil nilai akar
                  $query1 = mysqli_query($conn,"SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result1 = mysqli_fetch_array($query1);
                  //normalisasikan matriks dengan nilai data
                  $nm_matriks = $result['nama_sub']/$result1['akar'];
                  $round = number_format($nm_matriks,4);
                  
                  echo "<td class='text-center'>$round</td>";
              }
              ?>
              </tr>
              <?php } ?>

              </tbody>
              <tr>
                <td colspan="2">Normalisasi Bobot</td>
               <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                while ($a=mysqli_fetch_array($data)) {
                  //panggil jumlah keseluruhan bobot
                $query = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_total FROM tbl_kriteria");
                $result = mysqli_fetch_array($query);
                //normalisasikan bobot kriteria
                $nm_bobot = $a['bobot_kriteria'] / $result['sum_total'];
                echo "<td class='text-center'><b>$nm_bobot</b></td>";
                } ?>
              </tr>

            </table>
          </div>
        </div>
      </div>

      <div class="card shadow-sm">
<div class="card-body">
    <hr>
      <h4>Normalisasi Bobot</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                 
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
while ($a=mysqli_fetch_array($data)) {
    $nomor = $no++;
    $id_alternatif = $a['id_alternatif'];
    $nama_alternatif = $a['nama_alternatif'];
?>
    <td class="text-center"><?php echo $nomor ?></td>
    <td class="text-center"><?php echo $nama_alternatif ?></td>
              <?php
              $query = mysqli_query($conn,"SELECT s.nilai_subkriteria as nama_sub, n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, tbl_kriteria k WHERE n.id_alternatif='$id_alternatif' AND n.id_kriteria=k.id_kriteria AND n.id_subkriteria=s.id_subkriteria ORDER BY n.id_kriteria");
              while ($result=mysqli_fetch_array($query)) {
                  //panggil nilai akar
                  $query1 = mysqli_query($conn,"SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result1 = mysqli_fetch_array($query1);
                  //normalisasikan matriks dengan nilai data
                  $nm_matriks = $result['nama_sub']/$result1['akar'];
                 
                  //panggil nilai bobot
                  $query2 = mysqli_query($conn,"SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result2 = mysqli_fetch_array($query2);
                  //panggil nilai jumlah bobot
                  $query3 = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_total FROM tbl_kriteria");
                  $result3 = mysqli_fetch_array($query3);
                  //normalisasikan bobot kriteria
                  $nm_bobot = $result2['bobot_kriteria'] / $result3['sum_total'];
                  $valbobot = $nm_matriks * $nm_bobot;
                  $round = number_format($valbobot,4);
                  echo "<td class='text-center'>$round</td>";
                  //ambil hasil perkalian bobot, kemudian simpan ke dalam tbl nilai
                  mysqli_query($conn, "UPDATE tbl_nilai SET normalisasi='$valbobot' WHERE id_kriteria='$result[id_kriteria]'" . "AND id_alternatif='$a[id_alternatif]'");
                }
              ?>
              </tr>
              <?php } ?>

              </tbody>
              <tr>
                <td colspan="2">Max</td>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                while ($a = mysqli_fetch_array($data)) {
                    $id_kriteria = $a['id_kriteria'];

                    //tentukan nilai max pada hasil normalisasi bobot
                    $query = mysqli_query($conn, "SELECT max(normalisasi) as max_nm FROM tbl_nilai WHERE id_kriteria='".$id_kriteria."' ORDER BY id_kriteria");
                    $result = mysqli_fetch_array($query);
                    $max_bobot = number_format($result['max_nm'], 4);

                    echo "<td class='text-center'><b>$max_bobot</b></td>";
                }
                ?>

              </tr>
              <tr>
                <td colspan="2">Min</td>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
                while ($a = mysqli_fetch_array($data)) {
                    $id_kriteria = $a['id_kriteria'];

                    //tentukan nilai max pada hasil normalisasi bobot
                    $query = mysqli_query($conn, "SELECT min(normalisasi) as min_nm FROM tbl_nilai WHERE id_kriteria='".$id_kriteria."' ORDER BY id_kriteria");
                    $result = mysqli_fetch_array($query);
                    $min_bobot = number_format($result['min_nm'], 4);

                    echo "<td class='text-center'><b>$min_bobot</b></td>";
                }
                ?>
              </tr>

            </table>
          </div>
        </div>
      </div>

      <div class="card shadow-sm">
<div class="card-body">
    <hr>
      <h4>D+</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                   <th>D+</th>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
while ($a=mysqli_fetch_array($data)) {
    $nilai_d_max = 0;  
    $nomor = $no++;
    $id_alternatif = $a['id_alternatif'];
    $nama_alternatif = $a['nama_alternatif'];
?>
    <td class="text-center"><?php echo $nomor ?></td>
    <td class="text-center"><?php echo $nama_alternatif ?></td>
              <?php
              $query = mysqli_query($conn,"SELECT s.nilai_subkriteria as nama_sub, n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, tbl_kriteria k WHERE n.id_alternatif='$id_alternatif' AND n.id_kriteria=k.id_kriteria AND n.id_subkriteria=s.id_subkriteria ORDER BY n.id_kriteria");
              while ($result=mysqli_fetch_array($query)) {
                  //panggil nilai akar
                  $query1 = mysqli_query($conn,"SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result1 = mysqli_fetch_array($query1);
                  //normalisasikan matriks dengan nilai data
                  $nm_matriks = $result['nama_sub']/$result1['akar'];
                 
                  //panggil nilai bobot
                  $query2 = mysqli_query($conn,"SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result2 = mysqli_fetch_array($query2);
                  //panggil nilai jumlah bobot
                  $query3 = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_total FROM tbl_kriteria");
                  $result3 = mysqli_fetch_array($query3);
                  //normalisasikan bobot kriteria
                  $nm_bobot = $result2['bobot_kriteria'] / $result3['sum_total'];
                  $valbobot = $nm_matriks * $nm_bobot;
                  //panggil nilai max pada hasil normalisasi bobot
                  $query4 = mysqli_query($conn, "SELECT max(normalisasi) as max_nm FROM tbl_nilai WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result4 = mysqli_fetch_array($query4);
                  $max_bobot = $result4['max_nm'];
                  //set nilai D+
                  $nm_d_max = pow(($valbobot - $max_bobot), 2);
                  $round_max = number_format($nm_d_max,4);
                  $nilai_d_max +=  $nm_d_max;
                  $akar_d_max = sqrt($nilai_d_max);
                  $round_d_max = number_format($akar_d_max,4);

                  echo "<td class='text-center'>$round_max</td>";

                }
                 echo "<td class='text-center'>$round_d_max</td>";
                 //ambil nilai D+ masukkan ke dalam tbl alternatif
                 mysqli_query($conn, "UPDATE tbl_alternatif SET dmax='$akar_d_max' WHERE id_alternatif='$a[id_alternatif]'");
              ?>
              </tr>
              <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card shadow-sm">
<div class="card-body">
    <hr>
      <h4>D-</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <?php
                  $query = mysqli_query($conn, "SELECT * FROM tbl_kriteria");
                  while ($b=mysqli_fetch_array($query)) { 
                    echo "<th>$b[nama_kriteria]</th>";
                  }
                  ?>
                   <th>D-</th>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
while ($a=mysqli_fetch_array($data)) {
    $nilai_d_min = 0;  
    $nomor = $no++;
    $id_alternatif = $a['id_alternatif'];
    $nama_alternatif = $a['nama_alternatif'];
?>
    <td class="text-center"><?php echo $nomor ?></td>
    <td class="text-center"><?php echo $nama_alternatif ?></td>
              <?php
              $query = mysqli_query($conn,"SELECT s.nilai_subkriteria as nama_sub, n.id_kriteria as id_kriteria FROM tbl_subkriteria s, tbl_nilai n, tbl_kriteria k WHERE n.id_alternatif='$id_alternatif' AND n.id_kriteria=k.id_kriteria AND n.id_subkriteria=s.id_subkriteria ORDER BY n.id_kriteria");
              while ($result=mysqli_fetch_array($query)) {
                  //panggil nilai akar
                  $query1 = mysqli_query($conn,"SELECT akar_kriteria as akar FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result1 = mysqli_fetch_array($query1);
                  //normalisasikan matriks dengan nilai data
                  $nm_matriks = $result['nama_sub']/$result1['akar'];
                 
                  //panggil nilai bobot
                  $query2 = mysqli_query($conn,"SELECT bobot_kriteria FROM tbl_kriteria WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result2 = mysqli_fetch_array($query2);
                  //panggil nilai jumlah bobot
                  $query3 = mysqli_query($conn, "SELECT sum(bobot_kriteria) as sum_total FROM tbl_kriteria");
                  $result3 = mysqli_fetch_array($query3);
                  //normalisasikan bobot kriteria
                  $nm_bobot = $result2['bobot_kriteria'] / $result3['sum_total'];
                  $valbobot = $nm_matriks * $nm_bobot;
                  //panggil nilai max pada hasil normalisasi bobot
                  $query4 = mysqli_query($conn, "SELECT min(normalisasi) as min_nm FROM tbl_nilai WHERE id_kriteria='$result[id_kriteria]' ORDER BY id_kriteria");
                  $result4 = mysqli_fetch_array($query4);
                  $min_bobot = $result4['min_nm'];
                  //set nilai D-
                  $nm_d_min = pow(($valbobot - $min_bobot), 2);
                  $round_min = number_format($nm_d_min,4);
                  $nilai_d_min +=  $nm_d_min;
                  $akar_d_min = sqrt($nilai_d_min);
                  $round_d_min = number_format($akar_d_min,4);

                  echo "<td class='text-center'>$round_min</td>";

                }
                 echo "<td class='text-center'>$round_d_min</td>";
                 //ambil nilai D- masukkan ke dalam tbl alternatif
                 mysqli_query($conn, "UPDATE tbl_alternatif SET dmin='$akar_d_min' WHERE id_alternatif='$a[id_alternatif]'");
              ?>
              </tr>
              <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php
      //set nilai vi
      $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif"); 
      while ($a=mysqli_fetch_array($data)) {
          $dmax = $a['dmax'];
          $dmin = $a['dmin'];
          //hitung nilai vi
          $nilai_topsis = $dmin / ($dmin + $dmax);
          //ambil hasil vi, kemudian simpan ke dalam tbl alternatif sebagai nilai topsis
          mysqli_query($conn, "UPDATE tbl_alternatif SET nilai_topsis='$nilai_topsis' WHERE id_alternatif='$a[id_alternatif]'");
      }
      //set ranking
      $data1 = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY nilai_topsis DESC"); 
      $rank = 1;
      while ($a1=mysqli_fetch_array($data1)) {
          //ambil nilai ranking, kemudian simpan ke dalam tbl alternatif sebagai ranking
          mysqli_query($conn, "UPDATE tbl_alternatif SET ranking='$rank' WHERE id_alternatif='$a1[id_alternatif]'");
          $rank++;
      }

      ?>
       <div class="card shadow-sm">
        <div class="card-body">
          <hr>
      <h4>Perangkingan</h4>
      <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Alternatif</th>
                  <th>Nilai Topsis</th>
                  <th>Ranking</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
                $no=1;
                while ($a=mysqli_fetch_array($data)) { ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td class="text-center"><?php echo $a['nama_alternatif'] ?></td>
                  <td class="text-center"><?php echo number_format($a['nilai_topsis'],4) ?></td>
                  <td class="text-center"><?php echo $a['ranking'] ?></td>
                <?php } ?>
              </tbody>
            </table>
          </div>
      <!-- End Card -->
    </div>
  </div>
</div>