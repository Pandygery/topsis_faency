<?php
session_start();
include '../assets/conn/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Hasil Analisa TOPSIS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print { display: none !important; }
      body { font-size: 12pt; }
      .table { font-size: 10pt; }
    }
    body { padding: 20px; }
    .header-cetak { text-align: center; margin-bottom: 30px; border-bottom: 3px double #000; padding-bottom: 15px; }
    .header-cetak h3 { margin-bottom: 5px; }
    .tanda-tangan { margin-top: 50px; text-align: right; padding-right: 50px; }
  </style>
</head>
<body>

<div class="container">
  <div class="no-print mb-3">
    <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak</button>
    <a href="hasil.php" class="btn btn-secondary">← Kembali</a>
  </div>

  <div class="header-cetak">
    <h3>SISTEM PENDUKUNG KEPUTUSAN</h3>
    <h4>REKOMENDASI SUPPLIER MENGGUNAKAN METODE TOPSIS</h4>
    <p>Tanggal Cetak: <?php echo date('d-m-Y H:i:s'); ?></p>
  </div>

  <h5 class="mb-3">HASIL PERANGKINGAN</h5>

  <table class="table table-bordered">
    <thead class="table-dark text-center">
      <tr>
        <th>Ranking</th>
        <th>Nama Alternatif</th>
        <th>Nilai Preferensi</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Ambil data kriteria
      $kriteria = [];
      $qk = mysqli_query($conn, "SELECT * FROM tbl_kriteria ORDER BY id_kriteria");
      while ($k = mysqli_fetch_array($qk)) {
          $kriteria[] = $k;
      }

      // Ambil data alternatif dan nilai
      $alternatif = [];
      $qa = mysqli_query($conn, "SELECT * FROM tbl_alternatif ORDER BY id_alternatif");
      while ($a = mysqli_fetch_array($qa)) {
          $nilai_alt = [];
          foreach ($kriteria as $kr) {
              $qn = mysqli_query($conn, "SELECT s.nilai_subkriteria FROM tbl_nilai n 
                  JOIN tbl_subkriteria s ON n.id_subkriteria = s.id_subkriteria 
                  WHERE n.id_alternatif='{$a['id_alternatif']}' AND n.id_kriteria='{$kr['id_kriteria']}'");
              $n = mysqli_fetch_array($qn);
              $nilai_alt[] = $n ? (float)$n['nilai_subkriteria'] : 0;
          }
          $alternatif[] = ['id' => $a['id_alternatif'], 'nama' => $a['nama_alternatif'], 'nilai' => $nilai_alt];
      }

      if (count($alternatif) > 0 && count($kriteria) > 0) {
          // Normalisasi
          $pembagi = [];
          for ($j = 0; $j < count($kriteria); $j++) {
              $sum = 0;
              foreach ($alternatif as $alt) {
                  $sum += pow($alt['nilai'][$j], 2);
              }
              $pembagi[] = sqrt($sum);
          }

          $normalisasi = [];
          foreach ($alternatif as $alt) {
              $norm = [];
              for ($j = 0; $j < count($kriteria); $j++) {
                  $norm[] = $pembagi[$j] != 0 ? $alt['nilai'][$j] / $pembagi[$j] : 0;
              }
              $normalisasi[] = ['id' => $alt['id'], 'nama' => $alt['nama'], 'nilai' => $norm];
          }

          // Normalisasi terbobot
          $terbobot = [];
          foreach ($normalisasi as $norm) {
              $bobot_val = [];
              for ($j = 0; $j < count($kriteria); $j++) {
                  $bobot_val[] = $norm['nilai'][$j] * (float)$kriteria[$j]['bobot_kriteria'];
              }
              $terbobot[] = ['id' => $norm['id'], 'nama' => $norm['nama'], 'nilai' => $bobot_val];
          }

          // Solusi ideal positif dan negatif (asumsi semua benefit)
          $ideal_pos = [];
          $ideal_neg = [];
          for ($j = 0; $j < count($kriteria); $j++) {
              $col = array_column(array_column($terbobot, 'nilai'), $j);
              $ideal_pos[] = max($col);
              $ideal_neg[] = min($col);
          }

          // Jarak dan preferensi
          $hasil = [];
          foreach ($terbobot as $tb) {
              $d_pos = 0; $d_neg = 0;
              for ($j = 0; $j < count($kriteria); $j++) {
                  $d_pos += pow($tb['nilai'][$j] - $ideal_pos[$j], 2);
                  $d_neg += pow($tb['nilai'][$j] - $ideal_neg[$j], 2);
              }
              $d_pos = sqrt($d_pos);
              $d_neg = sqrt($d_neg);
              $pref = ($d_pos + $d_neg) != 0 ? $d_neg / ($d_pos + $d_neg) : 0;
              $hasil[] = ['nama' => $tb['nama'], 'preferensi' => $pref];
          }

          usort($hasil, function($a, $b) { return $b['preferensi'] <=> $a['preferensi']; });

         $rank = 1;
                    foreach ($hasil as $h) {
                        if ($rank == 1) {
                            $ket = "<strong class='text-success'>Rekomendasi Terbaik</strong>";
                        } elseif ($rank == 2) {
                            $ket = "<strong class='text-warning'>Cukup Baik</strong>";
                        } elseif ($rank == 3) {
                            $ket = "<strong class='text-danger'>Kurang Baik</strong>";
                        } else {
                            $ket = "-";
                        }
              echo "<tr>
                  <td class='text-center'>{$rank}</td>
                  <td class='text-center'>{$h['nama']}</td>
                  <td class='text-center'>" . number_format($h['preferensi'], 4) . "</td>
                  <td class='text-center'>{$ket}</td>
              </tr>";
              $rank++;
          }
      } else {
          echo "<tr><td colspan='4' class='text-center'>Data belum lengkap</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <div class="tanda-tangan">
    <p>Mengetahui,</p>
    <br><br><br>
    <p><strong>(______________________)</strong></p>
    <p>Owner</p>
  </div>
</div>

</body>
</html>