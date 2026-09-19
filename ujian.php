<?php
if (!isset($_POST['nama']) \vert{}\vert{} !isset($_POST['no_absen'])) {
    header("Location: index.php");
    exit;
}
$nama = htmlspecialchars($_POST['nama']);
$no_absen = htmlspecialchars($_POST['no_absen']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Ujian Berlangsung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Anti Block & Select text */
        body { 
            -webkit-user-select: none; -ms-user-select: none; user-select: none; 
            background: #f2f2f2; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .soft-ungu-overlay { position: fixed; inset: 0; background: linear-gradient(135deg, rgba(106,27,154,0.12), rgba(142,36,170,0.08)); z-index: -1; }
        .exam-container { max-width: 800px; margin: 2rem auto; background: rgba(255, 255, 255, 0.95); padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.5); backdrop-filter: blur(10px); }
        .timer-box { position: sticky; top: 20px; background: #dc3545; color: white; padding: 10px 20px; border-radius: 12px; font-weight: bold; text-align: center; float: right; box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3); }
        .btn-ppg { background: linear-gradient(135deg, #6A1B9A, #8E24AA); color: white; padding: 12px 24px; border-radius: 12px; font-weight: 600; border: none; width: 100%; transition: .3s; }
        .btn-ppg:hover { transform: translateY(-2px); color: white; }
        .question-box { margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #eee; }
        .form-check-input:checked { background-color: #6A1B9A; border-color: #6A1B9A; }
    </style>
</head>
<body>
    <div class="soft-ungu-overlay"></div>
    <div class="container exam-container">
        <div class="timer-box" id="timerDisplay">Waktu: 50:00</div>
        <h4 class="fw-bold" style="color: #6A1B9A;">Ujian Sedang Berlangsung</h4>
        <p class="text-muted">Nama: <strong><?= $nama ?></strong> \vert{} No. Absen: <strong><?= $no_absen ?></strong></p>
        <hr class="mb-4">

        <form id="formUjian" action="proses.php" method="POST">
            <input type="hidden" name="nama" value="<?= $nama ?>">
            <input type="hidden" name="no_absen" value="<?= $no_absen ?>">

            <!-- Soal 1 -->
            <div class="question-box">
                <p class="fw-semibold">1. Seorang remaja laki-laki mengalami perubahan suara menjadi lebih berat, pertumbuhan rambut pada wajah, serta peningkatan massa otot. Berdasarkan materi, perubahan tersebut paling tepat dijelaskan sebagai akibat dari ...[cite: 1]</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="A" id="q1a"><label class="form-check-label" for="q1a">A. meningkatnya produksi estrogen oleh ovarium[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="B" id="q1b"><label class="form-check-label" for="q1b">B. meningkatnya produksi testosteron oleh testis[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="C" id="q1c"><label class="form-check-label" for="q1c">C. meningkatnya progesteron oleh korpus luteum[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="D" id="q1d"><label class="form-check-label" for="q1d">D. meningkatnya HCG oleh plasenta[cite: 1]</label></div>
            </div>

            <!-- Soal 2 -->
            <div class="question-box">
                <p class="fw-semibold">2. Seorang siswa menghilangkan epididimis dari urutan perjalanan sperma setelah sperma terbentuk di testis. Mengapa urutan tersebut menjadi kurang tepat?[cite: 1]</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="A" id="q2a"><label class="form-check-label" for="q2a">A. Epididimis merupakan tempat sperma mengalami pematangan dan penyimpanan[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="B" id="q2b"><label class="form-check-label" for="q2b">B. Epididimis menghasilkan testosteron yang menggerakkan sperma[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="C" id="q2c"><label class="form-check-label" for="q2c">C. Epididimis merupakan tempat terjadinya fertilisasi[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="D" id="q2d"><label class="form-check-label" for="q2d">D. Epididimis menghasilkan sel telur[cite: 1]</label></div>
            </div>

            <!-- Soal 3 -->
            <div class="question-box">
                <p class="fw-semibold">3. Seseorang mengalami gangguan pada epididimis sehingga sperma tidak mengalami pematangan secara optimal. Dampak yang paling logis berdasarkan fungsi organ tersebut adalah ...[cite: 1]</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="A" id="q3a"><label class="form-check-label" for="q3a">A. produksi testosteron langsung berhenti[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="B" id="q3b"><label class="form-check-label" for="q3b">B. sperma tidak dapat terbentuk di testis[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="C" id="q3c"><label class="form-check-label" for="q3c">C. sperma yang tersedia dapat mengalami gangguan dalam proses pematangan[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="D" id="q3d"><label class="form-check-label" for="q3d">D. proses menstruasi menjadi tidak teratur[cite: 1]</label></div>
            </div>

            <!-- Soal 4 -->
            <div class="question-box">
                <p class="fw-semibold">4. Seorang perempuan mengalami gangguan pada silia tuba falopi. Berdasarkan fungsi silia yang dijelaskan dalam materi, kemungkinan dampaknya adalah ...[cite: 1]</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="A" id="q4a"><label class="form-check-label" for="q4a">A. sperma tidak dapat diproduksi[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="B" id="q4b"><label class="form-check-label" for="q4b">B. pergerakan sel telur melalui tuba falopi dapat terganggu[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="C" id="q4c"><label class="form-check-label" for="q4c">C. ovarium tidak menghasilkan hormon[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="D" id="q4d"><label class="form-check-label" for="q4d">D. uterus berhenti menghasilkan darah[cite: 1]</label></div>
            </div>

            <!-- Soal 5 -->
            <div class="question-box">
                <p class="fw-semibold">5. Mengapa fertilisasi secara normal lebih mungkin terjadi di tuba falopi daripada di uterus?[cite: 1]</p>
                <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="A" id="q5a"><label class="form-check-label" for="q5a">A. Tuba falopi merupakan tempat sperma dan sel telur bertemu, sedangkan zigot kemudian bergerak menuju uterus[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="B" id="q5b"><label class="form-check-label" for="q5b">B. uterus tidak memiliki dinding[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="C" id="q5c"><label class="form-check-label" for="q5c">C. ovarium hanya berfungsi menghasilkan hormon[cite: 1]</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="D" id="q5d"><label class="form-check-label" for="q5d">D. sperma hanya dapat hidup di uterus[cite: 1]</label></div>
            </div>

            <button type="submit" class="btn btn-ppg mt-3">Selesai & Kumpulkan</button>
        </form>
    </div>

    <script>
        // 1. Sistem Anti Kecurangan
        document.addEventListener('contextmenu', e => e.preventDefault()); // Anti Klik Kanan
        document.addEventListener('copy', e => e.preventDefault()); // Anti Copy
        document.addEventListener('paste', e => e.preventDefault()); // Anti Paste

        // Peringatan Screenshot
        document.addEventListener('keyup', (e) => {
            if (e.key === 'PrintScreen' || e.keyCode === 44 || e.key === 'Meta') {
                navigator.clipboard.writeText(''); 
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Screenshot dilarang dalam sesi ini.',
                    confirmButtonColor: '#6A1B9A'
                });
            }
        });

        // 2. Sistem Timer Mundur (50 Menit)
        let totalTime = 50 * 60; // 3000 detik
        const timerDisplay = document.getElementById('timerDisplay');
        const formUjian = document.getElementById('formUjian');

        const countdown = setInterval(() => {
            let minutes = Math.floor(totalTime / 60);
            let seconds = totalTime % 60;
            
            // Format waktu menjadi MM:SS
            timerDisplay.innerText = `Waktu: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            totalTime--;

            if (totalTime < 0) {
                clearInterval(countdown);
                Swal.fire({
                    title: 'Waktu Habis!',
                    text: 'Jawaban Anda akan dikirim secara otomatis.',
                    icon: 'info',
                    timer: 2500,
                    showConfirmButton: false,
                    allowOutsideClick: false
                }).then(() => {
                    formUjian.submit();
                });
            }
        }, 1000);
    </script>
</body>
</html>
