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
                <i class="fa-solid fa-cart-shopping" id="cartIcon" style="position:relative;cursor:pointer;" title="Keranjang">
                  <span class="cart-count" style="position:absolute;top:-8px;right:-8px;background:var(--lime);color:#111;border-radius:50%;width:20px;height:20px;font-size:12px;display:flex;align-items:center;justify-content:center;font-weight:600;">0</span>
                </i>
            </div>

        </div>
        <section class="feature-page">
            <h1>PRODUK PIERCING </h1>
            <p>Temukan pilihan piercing alternatif yang unik dan menarik, cocok untuk gaya berbeda.</p>
            
            <div class="products-grid">
        <div class="product-card" data-product="Spike Ohrring" data-price="Rp 55.000" data-img="spkie-ohrring.jpg">
                    <img src="spkie-ohrring.jpg" alt="Spike Ohrring" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Spike Ohrring</h3>
                        <p class="product-desc">Piercing dengan desain spike yang tajam dan elegan. Cocok untuk septum, telinga, atau alternatif piercing lainnya dengan tampilan aggressive yang stylish.</p>

                    </div>
                </div>

                <div class="product-card">
                    <img src="Circular-Barbell.png" alt="Circular Barbell" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Circular Barbell</h3>
                        <p class="product-desc">Piercing berbentuk lingkaran dengan bola pada kedua ujungnya. Desain klasik namun sophisticated, sangat populer untuk body piercing dan septum.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Barre-de-surface.png" alt="Barre de Surface" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Barre de Surface</h3>
                        <p class="product-desc">Piercing surface bar yang modern dan minimalis. Ideal untuk surface piercing di area dada, punggung, atau bagian tubuh lainnya dengan efek visual unik.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Titanium-Straight-Barbel.png" alt="Titanium Straight Barbel" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Titanium Straight Barbel</h3>
                        <p class="product-desc">Barbel lurus berkualitas tinggi dari titanium. Hypoallergenic dan aman untuk semua jenis kulit, sempurna untuk piercing bridge atau septa dengan kenyamanan maksimal.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Dparis-Model-Bintang.png" alt="Dparis Model Bintang" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Dparis Model Bintang</h3>
                        <p class="product-desc">Desain unik dengan motif bintang yang menawan. Memberikan statement yang berani dan crafty untuk mereka yang ingin tampil beda dan ekspresif.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Piercing-Nostril-Em-Aço.png" alt="Piercing Nostril Em Aço" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Nostril Em Aço</h3>
                        <p class="product-desc">Piercing nostril berkualitas dengan material steel yang tahan lama. Sempurna untuk septum piercing dengan desain geometri dan finish yang premium.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="cubic-zironia.jpg" alt="Cubic Zirconia" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Cubic Zirconia</h3>
                        <p class="product-desc">Anting piercing dengan sentuhan kristal cubic zirconia, memberikan kilau mewah tanpa mengorbankan kenyamanan.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="kyoto-series.jpg" alt="Kyoto Series" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Kyoto Series</h3>
                        <p class="product-desc">Piercing koleksi Kyoto dengan bentuk elegan dan warna lembut, cocok untuk tampilan modern yang minimalis.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="ear-piercing-ball.jpg" alt="Ear Piercing Ball" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Ear Piercing Ball</h3>
                        <p class="product-desc">Piercing model bola sederhana yang nyaman dipakai sehari-hari, ideal untuk tampilan ringkas dan modern.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="barbell-earrings.jpg" alt="Barbell Earrings" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Barbell Earrings</h3>
                        <p class="product-desc">Desain barbel yang kuat dan stylish, sangat cocok untuk tampilan bold pada piercing telinga atau monroe.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Tindik-Bunga.png" alt="Tindik Bunga" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Tindik Bunga</h3>
                        <p class="product-desc">Piercing motif bunga yang feminin dan manis, membuat tampilan lebih lembut dengan detail yang menarik.</p>
                    </div>
                </div>

                <div class="product-card">
                    <img src="Anting-Jepit.png" alt="Anting Jepit" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Anting Jepit</h3>
                        <p class="product-desc">Pilihan anting tanpa tindik untuk gaya piercing sementara dengan kenyamanan tinggi dan desain trendi.</p>
                    </div>
                </div>
            </div>
            
            <a class="btn-back" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i>Kembali ke Dashboard</a>
        </section>
    </main>
</div>
</body>
</html>

