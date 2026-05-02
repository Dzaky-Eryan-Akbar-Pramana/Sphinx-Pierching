<?php
session_start();
require_once 'firebase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $nohp = trim($_POST['nohp']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Simpan ke Firebase
    $userData = [
        'username' => $username,
        'nohp' => $nohp,
        'email' => $email,
        'password' => $password,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $result = $firestore->saveDocument('users', $username, $userData);

    if (!isset($result['error'])) {
        // Buat juga entri profil agar data akun langsung tersedia
        $profileData = [
            'username' => $username,
            'full_name' => $username,
            'email' => $email,
            'phone' => $nohp,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $firestore->saveDocument('profiles', $username, $profileData);

        // Akun berhasil dibuat, arahkan ke Login dengan pesan sukses
        header('Location: Login.php?registered=1');
        exit;
    } else {
        $error = 'Gagal membuat akun: ' . $result['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - Sphinx Piercing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css-customer/BuatAkun.css">
</head>
<body>

    <div class="container">
        <div class="left-section">
            <img src="../gambar/logo2.jpeg" alt="Logo Sphinx" class="logo-img">
            <div class="brand-name">@sphinx_piercing</div>
        </div>

        <div class="right-section">
            <h2>Buat Akun Baru</h2>
            <?php if (isset($error)): ?>
                <p style="color: #ff6b6b; margin-bottom: 15px;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Masukkan Username" required>
                <input type="tel" name="nohp" placeholder="Masukkan No HP" required>
                <input type="email" name="email" placeholder="Masukkan Email" required>
                <input type="password" name="password" placeholder="Masukkan Password" required>
                <button type="submit" name="register">Simpan</button>
            </form>
            <a href="Login.php" class="small-text">Sudah punya akun? Login di sini</a>
        </div>
    </div>

</body>
</html>
