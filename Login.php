<?php
session_start();
require_once 'firebase.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Ambil data user dari Firebase
    $userData = $firestore->getDocument('users', $username);
    
    if ($userData && password_verify($password, $userData['password'])) {
        $_SESSION['user'] = $username;
        $_SESSION['user_data'] = $userData;
        header('Location: Dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sphinx Piercing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <style>
        
        * { box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
            font-family: 'Tilt Neon', sans-serif; 
        }
        
        body {
            background-color: #2c1e4a; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #3b2460; 
            width: 100%;
            max-width: 800px;
            min-height: 460px;
            display: flex;
            border-radius: 4px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            overflow: hidden;
            border: 1px solid #4a2c7a;
        }

        .left-section {
            width: 45%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .logo-img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #553485; 
            margin-bottom: 10px;
        }

        .brand-name {
            color: #7FFF00; 
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 10px;
            text-shadow: 0 0 5px rgba(127, 255, 0, 0.5);
        }

        .right-section {
            width: 55%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            color: #7FFF00; 
            margin-bottom: 30px;
            font-size: 1.8rem;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #e0e0e0;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 0.9rem;
        }

        .small-text {
            color: #96DB70;
            font-size: 0.8rem;
            text-align: right;
            margin-bottom: 20px;
            display: block;
            text-decoration: none;
        }
        
        .small-text:hover {
            color: #fff;
        }

        button {
            background-color: #7a4d9c;
            color: white;
            padding: 10px 40px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            align-self: flex-end; 
            transition: 0.3s;
        }

        button:hover {
            background-color: #9162b5;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 18px 0 14px;
            color: #7a6a96;
            font-size: 12px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.12);
        }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 11px;
            background: rgba(255,255,255,0.08);
            color: #f4f4f4;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-google:hover {
            background: rgba(255,255,255,0.14);
            border-color: #7FFF00;
            color: #7FFF00;
        }
        .btn-google img {
            width: 20px;
            height: 20px;
        }

        /* --- MODAL GOOGLE --- */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.65);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: #3b2460;
            border: 1px solid #4a2c7a;
            border-radius: 12px;
            padding: 36px 32px 28px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            position: relative;
            animation: slideUp 0.25s ease;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .modal-close-btn {
            position: absolute;
            top: 14px; right: 16px;
            background: none;
            border: none;
            color: #7a6a96;
            font-size: 20px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: color 0.2s;
            align-self: auto;
        }
        .modal-close-btn:hover { color: #7FFF00; background: rgba(127,255,0,0.08); }
        .modal-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .modal-logo img { width: 36px; height: 36px; }
        .modal-logo span { color: #7FFF00; font-weight: 700; font-size: 1rem; }
        .modal-box h3 {
            color: #7FFF00;
            font-size: 1.25rem;
            margin-bottom: 6px;
            text-align: center;
        }
        .modal-box p {
            color: #7a6a96;
            font-size: 12px;
            text-align: center;
            margin-bottom: 22px;
        }
        .modal-box label {
            display: block;
            font-size: 12px;
            color: #96DB70;
            margin-bottom: 6px;
        }
        .modal-box input {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 16px;
            background: #2c1e4a;
            border: 1px solid #4a2c7a;
            border-radius: 6px;
            color: #f4f4f4;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .modal-box input:focus { border-color: #7FFF00; }
        .modal-box input::placeholder { color: #7a6a96; }
        .modal-submit {
            width: 100%;
            padding: 12px;
            background: #7a4d9c;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            align-self: auto;
        }
        .modal-submit:hover { background: #9162b5; }

        @media (max-width: 640px) {
            body { padding: 12px; }
            .container { flex-direction: column; min-height: auto; }
            .left-section { width: 100%; padding: 24px 20px 12px; }
            .logo-img { width: 100px; height: 100px; }
            .right-section { width: 100%; padding: 20px; }
            h2 { font-size: 1.4rem; margin-bottom: 20px; }
            input { padding: 12px; margin-bottom: 14px; }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="left-section">
            <img src="gambar/logo2.jpeg" alt="Logo Sphinx" class="logo-img">
            <div class="brand-name">@sphinx_piercing</div>
        </div>

        <div class="right-section">
            <?php if (isset($_GET['registered'])): ?>
                <div style="background: rgba(0,255,0,0.15); color: #7FFF00; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #7FFF00;">
                    Akun berhasil dibuat! Silakan login.
                </div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div style="background: rgba(255,0,0,0.2); color: #ff4444; padding: 12px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #ff4444;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <h2>Selamat Datang, Kawan!!</h2>
            
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username (user)" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                <input type="password" name="password" placeholder="Password (sphx123)" required>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                    <button type="submit" class="btn">Masuk</button>
                    <button type="button" id="btnLupaPassword" style="background:none;border:none;color:#96DB70;font-size:0.8rem;cursor:pointer;padding:0;align-self:auto;transition:color 0.2s;"
                        onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#96DB70'">Lupa Password?</button>
                </div>
            </form>

            <div class="divider">atau</div>

            <button type="button" class="btn-google" id="btnGoogleLogin">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                Masuk dengan Google
            </button>

            <a href="BuatAkun.php" class="small-text"> Buat Akun </a>
        </div>

    </div>

    <!-- Modal Login Google -->
    <div class="modal-overlay" id="googleModal">
        <div class="modal-box">
            <button type="button" class="modal-close-btn" id="closeGoogleModal"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-logo">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                <span>Login dengan Google</span>
            </div>
            <h3>Masuk Akun Google</h3>
            <p>Gunakan email Google kamu untuk masuk</p>
            <form action="LoginGoogle.php" method="POST">
                <label>Email Google</label>
                <input type="email" name="email" placeholder="contoh@gmail.com" required>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password akun Google" required>
                <button type="submit" class="modal-submit">Masuk</button>
            </form>
        </div>
    </div>

    <!-- Modal Lupa Password -->
    <div class="modal-overlay" id="lupaPasswordModal">
        <div class="modal-box">
            <button type="button" class="modal-close-btn" id="closeLupaModal"><i class="fa-solid fa-xmark"></i></button>
            <div style="text-align:center; margin-bottom:18px;">
                <div style="width:52px;height:52px;background:rgba(127,255,0,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                    <i class="fa-solid fa-lock" style="color:#7FFF00;font-size:22px;"></i>
                </div>
            </div>
            <h3>Ubah Password</h3>
            <p>Masukkan data akun kamu untuk mengatur ulang password</p>
            <form id="formLupaPassword">
                <label>Username</label>
                <input type="text" id="resetUsername" placeholder="Username kamu" required>
                <label>Email</label>
                <input type="email" id="resetEmail" placeholder="Email terdaftar" required>
                <label>Password Baru</label>
                <input type="password" id="resetPasswordBaru" placeholder="Minimal 6 karakter" required>
                <label>Konfirmasi Password Baru</label>
                <input type="password" id="resetPasswordKonfirmasi" placeholder="Ulangi password baru" required>
                <div id="resetMsg" style="display:none; font-size:12px; padding:10px 12px; border-radius:6px; margin-bottom:14px;"></div>
                <button type="submit" class="modal-submit">Ubah Password</button>
            </form>
        </div>
    </div>

    <script>
        // --- Modal Google ---
        document.getElementById('btnGoogleLogin').addEventListener('click', function () {
            document.getElementById('googleModal').classList.add('active');
        });
        document.getElementById('closeGoogleModal').addEventListener('click', function () {
            document.getElementById('googleModal').classList.remove('active');
        });
        document.getElementById('googleModal').addEventListener('click', function (e) {
            if (e.target === this) this.classList.remove('active');
        });

        // --- Modal Lupa Password ---
        document.getElementById('btnLupaPassword').addEventListener('click', function () {
            document.getElementById('lupaPasswordModal').classList.add('active');
        });
        document.getElementById('closeLupaModal').addEventListener('click', function () {
            document.getElementById('lupaPasswordModal').classList.remove('active');
        });
        document.getElementById('lupaPasswordModal').addEventListener('click', function (e) {
            if (e.target === this) this.classList.remove('active');
        });

        document.getElementById('formLupaPassword').addEventListener('submit', function (e) {
            e.preventDefault();
            const baru = document.getElementById('resetPasswordBaru').value;
            const konfirmasi = document.getElementById('resetPasswordKonfirmasi').value;
            const msg = document.getElementById('resetMsg');

            if (baru.length < 6) {
                msg.style.display = 'block';
                msg.style.background = 'rgba(255,68,68,0.15)';
                msg.style.color = '#ff4444';
                msg.style.border = '1px solid #ff4444';
                msg.textContent = 'Password minimal 6 karakter.';
                return;
            }
            if (baru !== konfirmasi) {
                msg.style.display = 'block';
                msg.style.background = 'rgba(255,68,68,0.15)';
                msg.style.color = '#ff4444';
                msg.style.border = '1px solid #ff4444';
                msg.textContent = 'Konfirmasi password tidak cocok.';
                return;
            }

            // Tampilkan pesan sukses (integrasi backend bisa ditambahkan di sini)
            msg.style.display = 'block';
            msg.style.background = 'rgba(127,255,0,0.12)';
            msg.style.color = '#7FFF00';
            msg.style.border = '1px solid #7FFF00';
            msg.textContent = 'Permintaan ubah password berhasil dikirim!';
            this.reset();
            setTimeout(() => {
                document.getElementById('lupaPasswordModal').classList.remove('active');
                msg.style.display = 'none';
            }, 2000);
        });
    </script>

</body>
</html>