<?php
session_start();
require_once 'firebase.php';
$error = '';
$google_error = '';

// Login via email (modal Google)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Cari akun berdasarkan email di koleksi users
    $allUsers = $firestore->getCollection('users');
    $foundUser = null;
    $foundUsername = null;
    foreach ($allUsers as $uname => $udata) {
        if (isset($udata['email']) && strtolower($udata['email']) === strtolower($email)) {
            $foundUser = $udata;
            $foundUsername = $uname;
            break;
        }
    }

    if ($foundUser && password_verify($password, $foundUser['password'])) {
        $_SESSION['user'] = $foundUsername;
        $_SESSION['user_data'] = $foundUser;
        header('Location: Dashboard.php');
        exit;
    } else {
        $google_error = 'Email atau password salah!';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['email'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Login sebagai admin
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin'] = true;
        $_SESSION['user'] = 'admin';
        header('Location: ../admin/Dashboard-admin.php');
        exit;
    }
    
    // Ambil data pengguna dari Firebase
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
    <link rel="stylesheet" href="../css-customer/Login.css">
</head>
<body>

    <div class="container">
        <div class="left-section">
            <img src="../gambar/logo2.jpeg" alt="Logo Sphinx" class="logo-img">
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
            <form action="Login.php" method="POST">
                <input type="hidden" name="google_login" value="1">
                <label>Email Google</label>
                <?php if ($google_error): ?>
                <div style="background:rgba(255,0,0,0.2);color:#ff4444;padding:10px 12px;border-radius:6px;margin-bottom:12px;border-left:4px solid #ff4444;font-size:13px;">
                    <?= htmlspecialchars($google_error) ?>
                </div>
                <?php endif; ?>
                <input type="email" name="email" placeholder="contoh@gmail.com" required>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password akun" required>
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
        // --- Modal Login Google ---
        <?php if ($google_error): ?>
        // Buka kembali modal Google jika ada error login
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('googleModal').classList.add('active');
        });
        <?php endif; ?>
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

            // Tampilkan pesan sukses setelah permintaan reset password
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