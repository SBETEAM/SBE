<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST['nama'])) {
    echo "<script>alert('Sesi ujian tidak valid!'); window.location.href = '/';</script>";
    exit;
}

$nama = htmlspecialchars($_POST['nama']);
$no_absen = htmlspecialchars($_POST['no_absen']);

// Kunci Jawaban Lengkap 35 Soal
$kunci_jawaban = [
    'q1' => 'B', 'q2' => 'A', 'q3' => 'C', 'q4' => 'B', 'q5' => 'A',
    'q6' => 'A', 'q7' => 'A', 'q8' => 'A', 'q9' => 'B', 'q10' => 'C',
    'q11' => 'B', 'q12' => 'A', 'q13' => 'A', 'q14' => 'A', 'q15' => 'A',
    'q16' => 'B', 'q17' => 'A', 'q18' => 'A', 'q19' => 'C', 'q20' => 'B',
    'q21' => 'C', 'q22' => 'A', 'q23' => 'A', 'q24' => 'B', 'q25' => 'A',
    'q26' => 'A', 'q27' => 'B', 'q28' => 'A', 'q29' => 'B', 'q30' => 'A',
    'q31' => 'B', 'q32' => 'A', 'q33' => 'A', 'q34' => 'B', 'q35' => 'B'
];

$skor = 0;
$total_soal = count($kunci_jawaban);

foreach ($kunci_jawaban as $nomor_soal => $jawaban_benar) {
    if (isset($_POST[$nomor_soal]) && $_POST[$nomor_soal] === $jawaban_benar) {
        $skor++;
    }
}

$nilai_akhir = ($skor / $total_soal) * 100;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #f2f2f2; overflow: hidden; }
        .soft-ungu-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(106,27,154,0.12), rgba(142,36,170,0.08)); z-index: 1; }
        .result-card { width: 100%; max-width: 500px; padding: 3rem 2.5rem; border-radius: 32px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); box-shadow: 0 30px 60px rgba(106, 27, 154, 0.2); z-index: 20; position: relative; text-align: center; border: 1px solid rgba(255, 255, 255, 0.5); }
        .score-circle { width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #6A1B9A, #8E24AA); color: white; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 10px 20px rgba(106, 27, 154, 0.3); }
        .btn-ppg { background: white; color: #6A1B9A; padding: 12px 30px; border-radius: 16px; font-weight: 600; border: 2px solid #6A1B9A; text-decoration: none; display: inline-block; transition: .3s; margin-top: 1.5rem; }
        .btn-ppg:hover { background: #6A1B9A; color: white; transform: translateY(-3px); }
    </style>
</head>
<body>
    <div class="soft-ungu-overlay"></div>
    
    <div class="result-card" id="resultCard">
        <h4 class="fw-bold" style="color: #4a4a4a;">Hasil Ujian</h4>
        <p class="text-muted mb-4">Nama: <strong><?= $nama ?></strong> <br> No. Absen: <strong><?= $no_absen ?></strong></p>
        
        <div class="score-circle">
            <?= round($nilai_akhir) ?>
        </div>
        
        <p class="text-muted">Jawaban Benar: <strong><?= $skor ?> / <?= $total_soal ?></strong></p>
        
        <a href="/" class="btn-ppg">Kembali ke Beranda</a>
    </div>

    <script>
        anime({ targets: '#resultCard', scale: [0.9, 1], opacity: [0, 1], duration: 800, easing: 'easeOutElastic(1, .6)' });
        anime({ targets: '.score-circle', scale: [0, 1], rotate: ['-45deg', '0deg'], duration: 1000, delay: 300, easing: 'easeOutElastic(1, .5)' });
    </script>
</body>
</html>
