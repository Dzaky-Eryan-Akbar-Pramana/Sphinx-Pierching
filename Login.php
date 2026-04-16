<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($username === 'user' && $password === 'sphx123') {
        $_SESSION['user'] = $username;
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
            height: 100vh;
        }

        .container {
            background-color: #3b2460; 
            width: 800px;
            height: 500px;
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
            width: 200px;
            height: 200px;
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
                <button type="submit" class="btn">Masuk</button>
            </form>
            <a href="BuatAkun.php" class="small-text">Jika Belum Punya Akun, Buat Akun Ya</a>
        </div>

    </div>

</body>
</html>