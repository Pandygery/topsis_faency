<?php include 'header.php'; ?>

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
          <li class="breadcrumb-item active" aria-current="page">
            <h4 class="m-0">HASIL ANALISA TOPSIS</h4>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <a href="cetak-hasil.php" target="_blank" class="btn btn-success mb-3">🖨️ CETAK HASIL</a>

          <h5>Perangkingan Alternatif</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
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
                    echo "<tr><td colspan='4' class='text-center'>Data alternatif atau kriteria belum lengkap</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>