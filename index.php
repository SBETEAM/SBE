<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Ujian Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #f2f2f2; overflow: hidden; }
        .bg-image-decor { position: fixed; inset: 0; background: url('https://ppgutm.id/img/fkip.png') center/cover; opacity: 0.15; z-index: 0; }
        .soft-ungu-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(106,27,154,0.12), rgba(142,36,170,0.08)); z-index: 1; pointer-events: none; }
        .blur-circle { position: absolute; width: 600px; height: 600px; border-radius: 50%; background: rgba(255,255,240,0.3); filter: blur(130px); top: -200px; right: -150px; z-index: 2; animation: floatCircle 20s infinite alternate ease-in-out; }
        .blur-circle-bottom { position: absolute; width: 500px; height: 500px; border-radius: 50%; background: rgba(200,200,255,0.2); filter: blur(100px); bottom: -150px; left: -100px; z-index: 2; animation: floatCircle 18s infinite alternate-reverse ease-in-out; }
        @keyframes floatCircle { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(30px, 20px) scale(1.1); } }
        .login-card { width: 100%; max-width: 460px; padding: 2.5rem; border-radius: 32px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2); z-index: 20; position: relative; border: 1px solid rgba(255, 255, 255, 0.5); }
        .custom-input { padding: 14px 16px; border-radius: 16px; border: 2px solid #eaeaea; transition: .3s; background: rgba(255, 255, 255, 0.7); }
        .custom-input:focus { border-color: #8E24AA; box-shadow: 0 0 0 4px rgba(142, 36, 170, 0.15); background: #fff; outline: none; }
        .btn-ppg { background: linear-gradient(135deg, #6A1B9A, #8E24AA); color: white; padding: 14px; border-radius: 16px; font-weight: 600; border: none; transition: .3s; width: 100%; }
        .btn-ppg:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(106, 27, 154, 0.35); color: white; }
        .text-ppg { color: #6A1B9A; }
    </style>
</head>
<body>
    <div class="bg-image-decor"></div><div class="soft-ungu-overlay"></div>
    <div class="blur-circle"></div><div class="blur-circle-bottom"></div>
    
    <div class="login-card" id="loginCard">
        <div class="text-center mb-4">
            <h4 class="mt-3 fw-bold text-ppg">Ujian Harian</h4>
            <p class="landing-tagline small text-muted">Silakan masukkan identitas Anda untuk memulai</p>
        </div>
        <form method="POST" action="ujian.php">
            <div class="mb-3">
                <label class="fw-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control custom-input" placeholder="Masukkan Nama Anda" required autofocus>
            </div>
            <div class="mb-4">
                <label class="fw-semibold mb-2">Nomor Absen</label>
                <input type="number" name="no_absen" class="form-control custom-input" placeholder="Masukkan Nomor Absen" required>
            </div>
            <button type="submit" class="btn btn-ppg">Mulai Kerjakan</button>
        </form>
    </div>

    <script>
        anime({ targets: '#loginCard', opacity: [0, 1], translateY: [30, 0], duration: 1000, easing: 'easeOutExpo' });
    </script>
</body>
</html>
