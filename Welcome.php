<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #0f0f2d;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 350px;
            text-align: center;
            padding: 20px;
        }

        .logo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        h1 {
            color: white;
            font-size: 32px;
            margin-bottom: 5px;
        }

        p {
            color: #d0d0e0;
            font-size: 14px;
            margin-top: 0;
            letter-spacing: 1px;
        }

        .btn {
            width: 100%;
            padding: 12px 0;
            background-color: white;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            margin-top: 15px;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="logo-sphinx.png" class="logo" alt="Logo">
    <h1>WELCOME</h1>
    <p>SELAMAT DATANG DI<br>SPHINX_PIERCING_JOGJA</p>

    <a href="Login.php">
        <button class="btn">Login</button>
    </a>

    <a href="BuatAkun.php">
        <button class="btn">Daftar</button>
    </a>
</div>

</body>
</html>
