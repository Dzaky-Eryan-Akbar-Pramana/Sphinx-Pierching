<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Akun berhasil dibuat, arahkan ke Login dengan pesan sukses
    header('Location: Login.php?registered=1');
    exit;
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

    <style>
        * { box-sizing: border-box;
            margin: 0; padding: 0;
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
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            color: #7FFF00;
            margin-bottom: 25px;
            font-size: 1.8rem;
            text-align: left; 
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            background-color: #e0e0e0;
            border: none;
            border-radius: 5px;
            outline: none;
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
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #9162b5;
        }

        .small-text {
            color: #96DB70;
            font-size: 0.8rem;
            text-align: right;
            margin-top: 10px;
            display: block;
            text-decoration: none;
        }

        .small-text:hover {
            color: #fff;
        }

        @media (max-width: 640px) {
            body { padding: 12px; }
            .container { flex-direction: column; min-height: auto; }
            .left-section { width: 100%; padding: 24px 20px 12px; }
            .logo-img { width: 100px; height: 100px; }
            .right-section { width: 100%; padding: 20px; }
            h2 { font-size: 1.4rem; margin-bottom: 18px; }
            input { padding: 10px; margin-bottom: 12px; }
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
            <h2>Buat Akun Baru</h2>
            
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
