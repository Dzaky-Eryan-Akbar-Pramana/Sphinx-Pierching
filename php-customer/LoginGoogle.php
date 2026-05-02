<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css-customer/LoginGoogle.css">

</head>
<body>

<div class="container">
     <a href="Login.php" class="back">&#8592;</a>

    <img src="../gambar/logo-sphinx.png" class="logo" alt="Logo">
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
