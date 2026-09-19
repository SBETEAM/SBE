<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST['nama']) \vert{}\vert{} trim($_POST['nama']) == '') {
    echo "<script>alert('Harap isi nama dan nomor absen terlebih dahulu!'); window.location.href = '/';</script>";
    exit;
}

$nama = htmlspecialchars($_POST['nama']);
$no_absen = htmlspecialchars($_POST['no_absen']);

// Seluruh 35 Soal dari Dokumen
$soal_list = [
    1 => ['q' => 'Seorang remaja laki-laki mengalami perubahan suara menjadi lebih berat, pertumbuhan rambut pada wajah, serta peningkatan massa otot. Berdasarkan materi, perubahan tersebut paling tepat dijelaskan sebagai akibat dari ...', 'opt' => ['A' => 'meningkatnya produksi estrogen oleh ovarium', 'B' => 'meningkatnya produksi testosteron oleh testis', 'C' => 'meningkatnya progesteron oleh korpus luteum', 'D' => 'meningkatnya HCG oleh plasenta']],
    2 => ['q' => 'Seorang siswa menghilangkan epididimis dari urutan perjalanan sperma setelah sperma terbentuk di testis. Mengapa urutan tersebut menjadi kurang tepat?', 'opt' => ['A' => 'Epididimis merupakan tempat sperma mengalami pematangan dan penyimpanan', 'B' => 'Epididimis menghasilkan testosteron yang menggerakkan sperma', 'C' => 'Epididimis merupakan tempat terjadinya fertilisasi', 'D' => 'Epididimis menghasilkan sel telur']],
    3 => ['q' => 'Seseorang mengalami gangguan pada epididimis sehingga sperma tidak mengalami pematangan secara optimal. Dampak yang paling logis berdasarkan fungsi organ tersebut adalah ...', 'opt' => ['A' => 'produksi testosteron langsung berhenti', 'B' => 'sperma tidak dapat terbentuk di testis', 'C' => 'sperma yang tersedia dapat mengalami gangguan dalam proses pematangan', 'D' => 'proses menstruasi menjadi tidak teratur']],
    4 => ['q' => 'Seorang perempuan mengalami gangguan pada silia tuba falopi. Berdasarkan fungsi silia yang dijelaskan dalam materi, kemungkinan dampaknya adalah ...', 'opt' => ['A' => 'sperma tidak dapat diproduksi', 'B' => 'pergerakan sel telur melalui tuba falopi dapat terganggu', 'C' => 'ovarium tidak menghasilkan hormon', 'D' => 'uterus berhenti menghasilkan darah']],
    5 => ['q' => 'Mengapa fertilisasi secara normal lebih mungkin terjadi di tuba falopi daripada di uterus?', 'opt' => ['A' => 'Tuba falopi merupakan tempat sperma dan sel telur bertemu, sedangkan zigot kemudian bergerak menuju uterus', 'B' => 'uterus tidak memiliki dinding', 'C' => 'ovarium hanya berfungsi menghasilkan hormon', 'D' => 'sperma hanya dapat hidup di uterus']],
    6 => ['q' => 'Perhatikan proses berikut: (1) Ovulasi, (2) Fertilisasi, (3) Pembentukan zigot, (4) Implantasi. Jika fertilisasi berhasil terjadi, urutan proses yang paling tepat adalah ...', 'opt' => ['A' => '1 → 2 → 3 → 4', 'B' => '2 → 1 → 4 → 3', 'C' => '3 → 2 → 1 → 4', 'D' => '1 → 3 → 2 → 4']],
    7 => ['q' => 'Seorang perempuan mengalami ovulasi, tetapi tidak terjadi fertilisasi. Beberapa waktu kemudian terjadi menstruasi. Hubungan sebab-akibat yang paling tepat adalah ...', 'opt' => ['A' => 'tidak terjadi fertilisasi → korpus luteum berubah menjadi korpus albikans → progesteron menurun → dinding rahim meluruh', 'B' => 'tidak terjadi fertilisasi → progesteron meningkat → dinding rahim semakin menebal', 'C' => 'fertilisasi gagal → HCG meningkat → menstruasi terjadi', 'D' => 'ovulasi gagal → korpus luteum menghasilkan lebih banyak progesteron']],
    8 => ['q' => 'Pada suatu siklus menstruasi, kadar progesteron mengalami penurunan tajam setelah tidak terjadi fertilisasi. Berdasarkan informasi tersebut, peristiwa berikutnya yang paling mungkin terjadi adalah ...', 'opt' => ['A' => 'endometrium meluruh', 'B' => 'implantasi meningkat', 'C' => 'embrio terbentuk', 'D' => 'HCG meningkat']],
    9 => ['q' => 'Seorang siswa mengamati bahwa ketebalan endometrium meningkat sebelum kemungkinan terjadinya kehamilan. Fungsi perubahan tersebut paling tepat adalah ...', 'opt' => ['A' => 'menghasilkan sperma', 'B' => 'mempersiapkan uterus menerima hasil fertilisasi', 'C' => 'menghasilkan sel telur baru', 'D' => 'menghentikan produksi hormon']],
    10 => ['q' => 'Seorang perempuan memiliki siklus menstruasi 21 hari, sedangkan temannya 28 hari. Berdasarkan materi, tindakan yang paling tepat adalah ...', 'opt' => ['A' => 'langsung menyimpulkan bahwa perempuan tersebut tidak dapat hamil', 'B' => 'menganggap semua siklus harus tepat 28 hari', 'C' => 'menilai kondisi berdasarkan variasi siklus dan tidak menyimpulkan kemampuan hamil hanya dari panjang siklus', 'D' => 'menyimpulkan bahwa ovulasi pasti tidak terjadi']],
    11 => ['q' => 'Sebuah alat tes kehamilan menunjukkan hasil positif. Berdasarkan materi, keberadaan hormon yang menjadi dasar pendeteksian kehamilan adalah ...', 'opt' => ['A' => 'testosteron', 'B' => 'HCG', 'C' => 'LH', 'D' => 'FSH']],
    12 => ['q' => 'HCG mulai dibentuk sekitar 11 hari setelah pembuahan dan jumlahnya meningkat sampai sekitar 12 minggu kehamilan. Jika seorang perempuan melakukan tes terlalu awal setelah pembuahan, alasan yang paling logis adalah ...', 'opt' => ['A' => 'HCG mungkin belum mencapai tingkat yang dapat terdeteksi', 'B' => 'progesteron belum pernah diproduksi', 'C' => 'ovarium belum pernah ada', 'D' => 'uterus belum terbentuk']],
    13 => ['q' => 'Setelah fertilisasi, zigot mengalami pembelahan berulang hingga membentuk blastokista. Blastokista kemudian melakukan implantasi. Jika implantasi tidak terjadi, proses kehamilan akan terganggu terutama karena ...', 'opt' => ['A' => 'blastokista tidak memperoleh tempat untuk menempel dan memperoleh nutrisi dari lapisan rahim', 'B' => 'testis tidak menghasilkan testosteron', 'C' => 'sperma kembali diproduksi', 'D' => 'ovulasi terjadi dua kali']],
    14 => ['q' => 'Perhatikan urutan perkembangan berikut: Fertilisasi → zigot → 2 sel → 4 sel → 8 sel → morula → blastokista. Kesimpulan yang paling tepat dari urutan tersebut adalah ...', 'opt' => ['A' => 'perkembangan awal terjadi melalui pembelahan sel berulang', 'B' => 'zigot langsung berubah menjadi bayi', 'C' => 'blastokista terbentuk sebelum fertilisasi', 'D' => 'morula terbentuk sebelum zigot']],
    15 => ['q' => 'Seorang siswa menyatakan bahwa pertumbuhan dan perkembangan adalah hal yang sama karena keduanya menunjukkan perubahan tubuh. Berdasarkan materi, alasan paling kuat untuk menolak pernyataan tersebut adalah ...', 'opt' => ['A' => 'pertumbuhan dapat diukur, sedangkan perkembangan menunjukkan pencapaian tahapan kemampuan', 'B' => 'pertumbuhan hanya terjadi pada bayi', 'C' => 'perkembangan hanya terjadi sebelum lahir', 'D' => 'pertumbuhan tidak dapat diamati']],
    16 => ['q' => 'Perhatikan dua pernyataan berikut. P: Berat badan anak meningkat 5 kg. Q: Anak mulai mampu berbicara dengan lancar. Pasangan yang paling tepat adalah ...', 'opt' => ['A' => 'P = perkembangan, Q = pertumbuhan', 'B' => 'P = pertumbuhan, Q = perkembangan', 'C' => 'P dan Q = pertumbuhan', 'D' => 'P dan Q = perkembangan']],
    17 => ['q' => 'Seorang bayi awalnya hanya melakukan gerak refleks, kemudian mampu duduk, merangkak, berdiri, dan berjalan. Berdasarkan data tersebut, kesimpulan yang paling tepat adalah ...', 'opt' => ['A' => 'kemampuan motorik berkembang seiring perkembangan sistem saraf dan otot', 'B' => 'kemampuan bayi hanya ditentukan oleh berat badan', 'C' => 'semua bayi pasti mencapai setiap tahap pada waktu yang persis sama', 'D' => 'perkembangan tidak berhubungan dengan kemampuan gerak']],
    18 => ['q' => 'Perhatikan data pertambahan tinggi badan berikut: 0 thn (50 cm), 1 thn (75 cm), 2 thn (87 cm), 3 thn (95 cm), 4 thn (103 cm), 5 thn (110 cm). Rentang usia yang menunjukkan pertambahan tinggi paling besar adalah ...', 'opt' => ['A' => '0–1 tahun', 'B' => '1–2 tahun', 'C' => '2–3 tahun', 'D' => '4–5 tahun']],
    19 => ['q' => 'Berdasarkan data pertumbuhan pada soal sebelumnya, seorang siswa menyimpulkan bahwa pertumbuhan anak berlangsung dengan kecepatan yang sama setiap tahun. Evaluasi terhadap kesimpulan tersebut adalah ...', 'opt' => ['A' => 'benar karena tinggi selalu bertambah', 'B' => 'benar karena semua anak tumbuh konstan', 'C' => 'kurang tepat karena besar pertambahan tinggi berbeda pada setiap rentang usia', 'D' => 'benar karena perkembangan dan pertumbuhan sama']],
    20 => ['q' => 'Berdasarkan tabel pertumbuhan, tinggi anak mencapai sekitar 80 cm di antara usia 1 dan 2 tahun. Kesimpulan tersebut menunjukkan bahwa grafik garis dapat digunakan untuk ...', 'opt' => ['A' => 'menentukan jenis kelamin anak', 'B' => 'memperkirakan nilai di antara dua data pengukuran', 'C' => 'menentukan kadar hormon', 'D' => 'menentukan kapan terjadi menstruasi']],
    21 => ['q' => 'Seorang anak mengalami peningkatan tinggi badan, tetapi juga mengalami perubahan kemampuan motorik dan bahasa. Jika guru meminta siswa membedakan pertumbuhan dan perkembangan, data yang paling tepat digunakan sebagai indikator perkembangan adalah ...', 'opt' => ['A' => 'peningkatan tinggi badan', 'B' => 'peningkatan berat badan', 'C' => 'kemampuan berbicara dan melakukan gerakan baru', 'D' => 'peningkatan volume tubuh']],
    22 => ['q' => 'Embrio sangat rentan terhadap alkohol, nikotin, dan obat-obatan tertentu selama sekitar delapan minggu pertama. Berdasarkan informasi tersebut, alasan yang paling tepat adalah ...', 'opt' => ['A' => 'pada periode tersebut organ mulai terbentuk', 'B' => 'pada periode tersebut tubuh ibu tidak memiliki hormon', 'C' => 'janin belum memiliki plasenta', 'D' => 'sperma masih diproduksi']],
    23 => ['q' => 'Cairan ketuban memiliki beberapa fungsi. Jika jumlah atau kondisi cairan tersebut tidak mampu memberikan perlindungan yang memadai, fungsi yang paling langsung terganggu adalah ...', 'opt' => ['A' => 'perlindungan janin dari guncangan', 'B' => 'pembentukan sperma', 'C' => 'ovulasi', 'D' => 'pembentukan ovarium']],
    24 => ['q' => 'Seorang siswa menyatakan bahwa plasenta hanya berfungsi sebagai tempat melekatnya janin. Berdasarkan materi, pernyataan tersebut ...', 'opt' => ['A' => 'benar karena plasenta tidak berperan dalam pertukaran zat', 'B' => 'kurang tepat karena oksigen dan nutrisi berasal dari plasenta melalui tali pusar', 'C' => 'benar karena tali pusar tidak berfungsi', 'D' => 'salah karena nutrisi berasal dari ovarium']],
    25 => ['q' => 'Jika aliran oksigen dan nutrisi melalui plasenta dan tali pusar terganggu, dampak yang paling mungkin terjadi pada janin adalah ...', 'opt' => ['A' => 'pertumbuhan dan perkembangan janin dapat terganggu', 'B' => 'ovulasi ibu meningkat', 'C' => 'sperma ibu meningkat', 'D' => 'menstruasi pasti meningkat']],
    26 => ['q' => 'Pada masa pubertas, seorang remaja mengalami perubahan fisik dan sistem reproduksinya mulai berfungsi. Jika perubahan tersebut dibandingkan dengan masa anak-anak, kesimpulan yang paling tepat adalah ...', 'opt' => ['A' => 'pubertas merupakan fase ketika hormon reproduksi mulai aktif', 'B' => 'pubertas hanya ditandai oleh pertambahan tinggi', 'C' => 'pubertas tidak berhubungan dengan hormon', 'D' => 'pubertas hanya terjadi pada laki-laki']],
    27 => ['q' => 'Dua remaja mengalami pubertas dengan perubahan fisik yang berbeda. Salah satunya mengalami pembesaran payudara dan menstruasi, sedangkan yang lain mengalami suara lebih berat dan mulai menghasilkan sperma. Penjelasan yang paling tepat adalah ...', 'opt' => ['A' => 'keduanya mengalami proses yang sama sekali tidak berhubungan dengan hormon', 'B' => 'perubahan tersebut berkaitan dengan hormon reproduksi yang berbeda pada laki-laki dan perempuan', 'C' => 'perempuan menghasilkan testosteron sebagai satu-satunya hormon', 'D' => 'laki-laki mengalami menstruasi setelah menghasilkan sperma']],
    28 => ['q' => 'Seorang perempuan memasuki menopause. Berdasarkan materi, perubahan yang paling sesuai adalah ...', 'opt' => ['A' => 'menstruasi berhenti dan tidak ada lagi telur yang dilepaskan', 'B' => 'produksi sperma berhenti', 'C' => 'fertilisasi meningkat', 'D' => 'ovarium menghasilkan lebih banyak sel telur baru']],
    29 => ['q' => 'Seorang laki-laki menjalani vasektomi. Berdasarkan mekanisme yang dijelaskan dalam materi, perubahan yang paling tepat adalah ...', 'opt' => ['A' => 'semen tidak lagi keluar saat ejakulasi', 'B' => 'sperma tidak dapat keluar melalui saluran sperma, tetapi semen masih dapat keluar', 'C' => 'testosteron langsung tidak diproduksi', 'D' => 'testis berhenti menghasilkan sperma']],
    30 => ['q' => 'Seorang perempuan menjalani tubektomi. Jika dikaitkan dengan fungsi tuba falopi, alasan metode tersebut dapat mencegah kehamilan adalah ...', 'opt' => ['A' => 'tuba falopi dipotong atau diikat sehingga mengganggu jalur reproduksi', 'B' => 'ovarium dihilangkan sehingga tidak ada hormon', 'C' => 'uterus dipindahkan keluar tubuh', 'D' => 'sperma diubah menjadi urine']],
    31 => ['q' => 'Seseorang menganggap penggunaan kondom menjamin seseorang terbebas dari semua infeksi menular seksual. Berdasarkan buku, pernyataan tersebut perlu dievaluasi karena ...', 'opt' => ['A' => 'kondom tidak pernah memiliki manfaat', 'B' => 'kondom dapat mengurangi kemungkinan infeksi, tetapi tidak menjamin keamanan sepenuhnya', 'C' => 'kondom hanya mencegah kehamilan dan tidak berhubungan dengan IMS', 'D' => 'IMS hanya disebabkan oleh makanan']],
    32 => ['q' => 'Pasangan yang mengalami infertilitas mempertimbangkan teknologi reproduksi berbantu. Dalam IVF, peristiwa yang membedakannya dari fertilisasi normal adalah ...', 'opt' => ['A' => 'pembuahan dilakukan di dalam wadah laboratorium sebelum embrio berkembang lebih lanjut', 'B' => 'sperma tidak digunakan', 'C' => 'sel telur tidak digunakan', 'D' => 'fertilisasi dilakukan di dalam paru-paru']],
    33 => ['q' => 'Pada prosedur ICSI, sperma diinjeksikan langsung ke dalam sel telur. Jika dibandingkan dengan fertilisasi alami, tujuan utama tindakan tersebut adalah ...', 'opt' => ['A' => 'membantu proses pembuahan dengan memasukkan sperma langsung ke sel telur', 'B' => 'menghentikan pembelahan sel', 'C' => 'mencegah pembentukan zigot', 'D' => 'menghentikan ovulasi permanen']],
    34 => ['q' => 'Sekelompok siswa merancang kampanye pencegahan stunting. Mereka hanya membuat poster berisi daftar makanan bergizi tanpa mempertimbangkan budaya, ekonomi, lingkungan, dan kondisi sosial masyarakat. Berdasarkan arahan projek dalam buku, kelemahan utama rancangan tersebut adalah ...', 'opt' => ['A' => 'poster tidak boleh membahas makanan', 'B' => 'solusi seharusnya dianalisis berdasarkan faktor yang dapat memengaruhi keberhasilannya', 'C' => 'stunting hanya disebabkan faktor budaya', 'D' => 'solusi tidak perlu mempertimbangkan kondisi masyarakat']],
    35 => ['q' => 'Sebuah keluarga memiliki keterbatasan ekonomi tetapi ingin memperbaiki pola makan anak yang berisiko mengalami stunting. Seorang siswa mengusulkan menu makanan yang mahal sebagai satu-satunya solusi. Jika dianalisis menggunakan pendekatan dalam projek, hal yang paling perlu dievaluasi adalah ...', 'opt' => ['A' => 'warna makanan', 'B' => 'kesesuaian solusi dengan kondisi ekonomi keluarga', 'C' => 'jumlah halaman poster', 'D' => 'ukuran tulisan poster']]
];
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
        body { 
            -webkit-user-select: none; -ms-user-select: none; user-select: none; 
            background: #f2f2f2; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .soft-ungu-overlay { position: fixed; inset: 0; background: linear-gradient(135deg, rgba(106,27,154,0.12), rgba(142,36,170,0.08)); z-index: -1; }
        .exam-container { max-width: 800px; margin: 2rem auto; background: rgba(255, 255, 255, 0.95); padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.5); backdrop-filter: blur(10px); }
        .timer-box { position: sticky; top: 20px; background: #dc3545; color: white; padding: 10px 20px; border-radius: 12px; font-weight: bold; text-align: center; float: right; box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3); z-index: 100; }
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
        <h4 class="fw-bold" style="color: #6A1B9A;">Ujian Harian</h4>
        <p class="text-muted">Nama: <strong><?= $nama ?></strong> \vert{} No. Absen: <strong><?= $no_absen ?></strong></p>
        <hr class="mb-4">

        <form id="formUjian" action="/proses.php" method="POST">
            <input type="hidden" name="nama" value="<?= $nama ?>">
            <input type="hidden" name="no_absen" value="<?= $no_absen ?>">

            <?php foreach ($soal_list as $num =>$item): ?>
                <div class="question-box">
                    <p class="fw-semibold"><?= $num ?>. <?= $item['q'] ?></p>
                    <?php foreach ($item['opt'] as $key =>$val): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q<?= $num ?>" value="<?= $key ?>" id="q<?= $num ?><?= strtolower($key) ?>">
                            <label class="form-check-label" for="q<?= $num ?><?= strtolower($key) ?>">
                                <?= $key ?>. <?= $val ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-ppg mt-3">Selesai & Kumpulkan</button>
        </form>
    </div>

    <script>
        // Anti Kecurangan
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener('copy', e => e.preventDefault());
        document.addEventListener('paste', e => e.preventDefault());

        document.addEventListener('keyup', (e) => {
            if (e.key === 'PrintScreen' || e.keyCode === 44 || e.key === 'Meta') {
                if (navigator.clipboard) { navigator.clipboard.writeText(''); }
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Screenshot dilarang dalam sesi ini.',
                    confirmButtonColor: '#6A1B9A'
                });
            }
        });

        // Timer 50 Menit
        let totalTime = 50 * 60;
        const timerDisplay = document.getElementById('timerDisplay');
        const formUjian = document.getElementById('formUjian');

        const countdown = setInterval(() => {
            let minutes = Math.floor(totalTime / 60);
            let seconds = totalTime % 60;
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
