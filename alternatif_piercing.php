<?php
$username = "@sphnx_piercing";
$current_page = basename($_SERVER['PHP_SELF']);
$page_title = "Alternatif Piercing";
$page_heading = "Alternatif Piercing";
$page_description = "Temukan pilihan piercing alternatif yang unik dan menarik, cocok untuk gaya berbeda.";


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        :root {
            --bg-main: #2f0c58;
            --bg-main-dark: #20103a;
            --bg-sidebar: #240744;
            --bg-card: #14062b;
            --accent: #a54ccf;
            --text: #f4f4f4;
            --text-soft: #cdcdcd;
            --lime: #82ff5b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            background: #111;
            color: var(--text);
        }

        .app {
            display: flex;
            min-height: 100vh;
            background: var(--bg-main);
        }

        .sidebar {
            width: 210px;
            background: var(--bg-sidebar);
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-right: 1px solid rgba(0, 0, 0, .4);
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            height: 100vh;
            z-index: 60;
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid var(--accent);
            object-fit: cover;
        }

        .brand span {
            display: block;
            margin-top: 8px;
            font-size: 13px;
        }

        .menu {
            width: 100%;
            list-style: none;
            flex: 1;
        }

        .menu li {
            margin-bottom: 14px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 999px;
            font-size: 13px;
            text-decoration: none;
            color: var(--text-soft);
            transition: .2s;
        }

        .menu a i {
            width: 20px;
            text-align: center;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--bg-main-dark);
            color: var(--lime);
        }

        .sidebar-footer {
            width: 100%;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .main {
            flex: 1;
            padding: 20px 28px;
            background: var(--bg-main);
            display: flex;
            flex-direction: column;
            margin-left: 210px;
        }

        .topbar {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .top-icons {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 18px;
        }

        .feature-page {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 32px;
            width: 100%;
        }

        .feature-page h1 {
            font-size: 32px;
            color: var(--lime);
            margin-bottom: 18px;
        }

        .feature-page p {
            color: var(--text-soft);
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin: 40px 0;
        }

        .product-card {
            background: var(--bg-main-dark);
            border-radius: 14px;
            overflow: hidden;
            transition: .3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(130, 255, 91, 0.15);
        }

        .product-image {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
            display: block;
            background: var(--bg-card);
        }

        .product-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--lime);
            margin-bottom: 10px;
        }

        .product-desc {
            font-size: 14px;
            color: var(--text-soft);
            line-height: 1.6;
            flex: 1;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 30px;
            padding: 10px 18px;
            border-radius: 10px;
            background: var(--accent);
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-back:hover {
            background: var(--lime);
            color: #111;
        }

        @media (max-width: 900px) {
            .app {
                flex-direction: column;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                flex-direction: row;
                overflow-x: auto;
            }

            .main {
                margin-left: 0;
            }

            .feature-page {
                padding: 22px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 16px;
            }
        }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <img src="logo2.jpeg" alt="Logo">
            <span><?= htmlspecialchars($username) ?></span>
        </div>
        <ul class="menu">
            <li><a href="dashboard.php"><i class="fa-solid fa-house"></i>Dashboard</a></li>
            <li><a href="riwayat.php"><i class="fa-solid fa-clock-rotate-left"></i>Riwayat Pemesanan</a></li>
            <li><a href="jadwal.php"><i class="fa-solid fa-calendar-check"></i>Jadwal Reservasi</a></li>

            <li><a href="pengaturan.php"><i class="fa-solid fa-gear"></i>Pengaturan Akun</a></li>
        </ul>
        <div class="sidebar-footer">
            <ul class="menu">
                <li><a href="bantuan.php"><i class="fa-solid fa-circle-question"></i>Bantuan</a></li>
            </ul>
        </div>
    </aside>
    <main class="main">
        <div class="topbar">
            <div class="top-icons">
                <i class="fa-regular fa-bell"></i>
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
        <section class="feature-page">
            <h1><?= htmlspecialchars($page_heading) ?></h1>
            <p><?= htmlspecialchars($page_description) ?></p>
            
            <div class="products-grid">
                <div class="product-card">
                    <img src="Contoh-Alis.png" alt="Contoh Alis" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Alis</h3>
                        <p class="product-desc">Piercing alis dengan bentuk rapi dan posisi estetis, cocok untuk memberi aksen wajah yang tajam dan modern.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh-Bibir.png" alt="Contoh Bibir" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Bibir</h3>
                        <p class="product-desc">Piercing bibir yang stylish untuk model labret atau monroe, dengan teknik steril dan hasil simetris.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh-Lidah.png" alt="Contoh Lidah" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Lidah</h3>
                        <p class="product-desc">Piercing lidah aman dan nyaman, direkomendasikan untuk gaya yang berani dengan perawatan aftercare yang lengkap.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh-Telinga.jpeg" alt="Contoh Telinga" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Telinga</h3>
                        <p class="product-desc">Piercing telinga profesional untuk berbagai model seperti helix, tragus, dan daith, dengan hasil aman dan estetis.</p>
                    </div>
                </div>

                <!-- <div class="product-card">
                    <img src="contoh-bintang.png" alt="Dparis Model Bintang" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Dparis Model Bintang</h3>
                        <p class="product-desc">Desain unik dengan motif bintang yang menawan. Memberikan statement yang berani dan crafty untuk mereka yang ingin tampil beda dan ekspresif.</p>
                    </div>
                </div> -->

                <div class="product-card">
                    <img src="Contoh-Hidung.png" alt="Contoh Hidung" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Hidung</h3>
                        <p class="product-desc">Piercing hidung untuk model nose stud atau hoop, menggunakan bahan steril agar hasilnya rapi dan nyaman dipakai.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh1.png" alt="Contoh 1" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 1</h3>
                        <p class="product-desc">Piercing modern dengan detail elegan, cocok untuk tampil beda dengan aksen yang halus dan penuh gaya.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh2.png" alt="Contoh 2" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 2</h3>
                        <p class="product-desc">Model piercing elegan dengan sentuhan minimalis, memberikan tampilan bersih dan stylish untuk penampilan sehari-hari.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh3.png" alt="Contoh 3" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 3</h3>
                        <p class="product-desc">Piercing serbaguna dengan tampilan bold, ideal untuk menambahkan aksen kuat pada gaya kasual atau formal.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh4.png" alt="Contoh 4" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 4</h3>
                        <p class="product-desc">Desain piercing kontemporer dengan garis tegas dan finishing halus, sempurna untuk tampilan modern.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh5.png" alt="Contoh 5" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 5</h3>
                        <p class="product-desc">Model piercing kreatif dengan detail unik, cocok untuk menonjolkan gaya personal yang berani.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh6.png" alt="Contoh 6" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 6</h3>
                        <p class="product-desc">Piercing dengan detail menarik dan tekstur khusus, dibuat untuk memberi aksen berbeda pada penampilan Anda.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Contoh7.png" alt="Contoh 7" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Kontemporer 7</h3>
                        <p class="product-desc">Aksesori piercing modern dengan desain edgy, sempurna untuk tampilan urban yang berani dan trendi.</p>
                    </div>
                </div>

                <!-- <div class="product-card">
                    <img src="contoh-bintang.png" alt="Dparis Model Bintang" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Dparis Model Bintang</h3>
                        <p class="product-desc">Desain unik dengan motif bintang yang menawan. Memberikan statement yang berani dan crafty untuk mereka yang ingin tampil beda dan ekspresif.</p>
                    </div>
                </div> -->

                <!-- <div class="product-card">
                    <img src="contoh-bintang.png" alt="Dparis Model Bintang" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Dparis Model Bintang</h3>
                        <p class="product-desc">Desain unik dengan motif bintang yang menawan. Memberikan statement yang berani dan crafty untuk mereka yang ingin tampil beda dan ekspresif.</p>
                    </div>
                </div> -->
            </div>
            
            <a class="btn-back" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i>Kembali ke Dashboard</a>
        </section>
    </main>
</div>
</body>
</html>

