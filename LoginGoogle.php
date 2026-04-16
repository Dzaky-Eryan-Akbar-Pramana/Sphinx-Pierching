<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0f0f2d;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }

        .container {
            width: 350px;
            text-align: left;
            color: white;
        }

        .logo {
            width: 170px;
            height: 170px;
            display: block;
            margin: 0 auto;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .forgot {
            font-size: 13px;
            color: #b5b5b5;
            margin-top: -10px;
            margin-bottom: 25px;
        }

        .section-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .google-btn {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            color: white;
            display: block;
            margin-top: 10px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .google-btn:hover {
            opacity: 0.8;
        }

        .back {
            font-size: 25px;
            text-decoration: none;
            color: white;
            margin-bottom: 10px;
            display: inline-block;
        }
    </style>

</head>
<body>

<div class="container">
     <a href="Welcome.php" class="back">&#8592;</a>

    <img src="gambar/logo-sphinx.png" class="logo" alt="Logo">
    <h1>Login Google</h1>
    <form action="proses_login.php" method="POST">

        <label>Akun Google</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>
        <div class="forgot">Lupa Password</div>

        <button type="submit"
                style="width:100%; padding:12px; border-radius:25px; border:none; font-size:17px; cursor:pointer; margin-top:5px;">
            Login
        </button>

    </form>

</div>

</body>
</html>
