<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : '@sphnx_piercing';
$is_logged_in = isset($_SESSION['user']);
$allowed_pages = ['Login.php', 'BuatAkun.php'];
if (!$is_logged_in && !in_array(basename($_SERVER['PHP_SELF']), $allowed_pages)) {
    header('Location: Login.php');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi - Sphinx Piercing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        :root{
            --bg-main:#2f0c58;
            --bg-main-dark:#20103a;
            --bg-sidebar:#240744;
            --bg-card:#14062b;
            --accent:#a54ccf;
            --accent-soft:#b86be0;
            --text:#f4f4f4;
            --text-soft:#cdcdcd;
            --lime:#82ff5b;
        }
        *{margin:0;padding:0;box-sizing:border-box;}

        body{
            font-family:"Poppins",sans-serif;
            background:#111;
            color:var(--text);
        }

        .app{
            display:flex;
            min-height:100vh;
            background:var(--bg-main);
        }
       
        /* --- SIDEBAR --- */
        .sidebar{
            width:210px;
            background:var(--bg-sidebar);
            padding:18px 16px;
            display:flex;
            flex-direction:column;
            align-items:center;
            border-right:1px solid rgba(0,0,0,.4);
            position:fixed; left:0; top:0; bottom:0; height:100vh;
            z-index:60;
        }
        .brand{ text-align:center; margin-bottom:32px; }
        .brand img{
            width:90px;height:90px; border-radius:50%;
            border:3px solid var(--accent); object-fit:cover;
        }
        .brand span{ display:block; margin-top:8px; font-size:13px; }
        
        .menu{ width:100%; list-style:none; flex:1; }
        .menu li{ margin-bottom:14px; }
        .menu a{
            display:flex; align-items:center; gap:10px;
            padding:10px 12px; border-radius:999px; font-size:13px;
            text-decoration:none; color:var(--text-soft); transition:.2s;
        }
        .menu a i{ width:20px; text-align:center; }
        .menu a:hover, .menu a.active{ background:var(--bg-main-dark); color:var(--lime); }
        
        .sidebar-footer{
            width:100%; margin-top:auto; padding-top:12px;
            border-top:1px solid rgba(255,255,255,.08);
        }
        
        /* --- MAIN CONTENT --- */
        .main{
            flex:1; padding:20px 28px; background:var(--bg-main);
            display:flex; flex-direction:column;
            margin-left:210px;
        }
    
        .topbar{
            display:flex; align-items:center; gap:20px; margin-bottom:24px;
        }
        
        .top-links{ display:flex; align-items:center; gap:24px; font-size:14px; }
        .top-links a{ text-decoration:none; color:var(--text-soft); }
        .top-links a:hover{ color:var(--lime); }
        .top-icons{ display:flex; align-items:center; gap:16px; font-size:18px; cursor:pointer; }

        /* --- MAPS SECTION --- */
        .maps-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            flex: 1;
        }

        .maps-frame {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            border: 1px solid rgba(130,255,91,0.2);
        }

        .maps-frame iframe {
            width: 100%;
            height: 500px;
            border: none;
        }

        .location-info {
            background: var(--bg-card);
            padding: 28px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .location-info h2 {
            color: var(--lime);
            font-size: 24px;
            margin-bottom: 8px;
        }

        .info-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .info-item i {
            color: var(--lime);
            font-size: 18px;
            width: 24px;
            margin-top: 2px;
        }

        .info-item-content {
            flex: 1;
        }

        .info-item-content strong {
            display: block;
            color: var(--text);
            margin-bottom: 4px;
        }

        .info-item-content span {
            color: var(--text-soft);
            font-size: 14px;
        }

        .contact-buttons {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .contact-btn {
            flex: 1;
            padding: 12px 16px;
            border: none;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .contact-btn.whatsapp {
            background: #25D366;
            color: white;
        }

        .contact-btn.whatsapp:hover {
            background: #1fa857;
            transform: translateY(-2px);
        }

        .contact-btn.call {
            background: var(--accent);
            color: white;
        }

        .contact-btn.call:hover {
            background: var(--accent-soft);
            transform: translateY(-2px);
        }

        @media (max-width: 1200px) {
            .maps-container {
                grid-template-columns: 1fr;
            }

            .maps-frame iframe {
                height: 400px;
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 200px;
                padding: 12px 10px;
            }

            .sidebar .brand img {
                width: 75px;
                height: 75px;
            }

            .sidebar .brand span {
                font-size: 11px;
            }

            .menu a {
                font-size: 12px;
                padding: 8px 10px;
            }

            .main {
                margin-left: 200px;
                padding: 16px 20px;
            }

            .topbar {
                gap: 12px;
                margin-bottom: 16px;
            }

            .top-links {
                gap: 16px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 12px 16px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .top-links {
                flex-direction: column;
                gap: 8px;
            }

            .maps-container {
                gap: 16px;
            }

            .maps-frame iframe {
                height: 300px;
            }

            .location-info {
                padding: 20px;
            }

            .location-info h2 {
                font-size: 20px;
            }

            .contact-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="app">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="brand">
                <img src="gambar/sphinx_piercing_logo.jpg" alt="Sphinx Piercing Logo" onerror="this.src='https://via.placeholder.com/90'">
                <span>Sphinx Piercing</span>
            </div>

            <ul class="menu">
                <li><a href="Dashboard.php"><i class="fa-solid fa-home"></i> Home</a></li>
                <li><a href="piercing_produk.php"><i class="fa-solid fa-ring"></i> Produk</a></li>
                <li><a href="jasa_piercing.php"><i class="fa-solid fa-handshake"></i> Jasa</a></li>
                <li><a href="riwayat.php"><i class="fa-solid fa-history"></i> Riwayat</a></li>
                <li><a href="maps.php" class="active"><i class="fa-solid fa-map-location-dot"></i> Lokasi</a></li>
            </ul>

            <div class="sidebar-footer">
                <a href="pengaturan.php" style="text-decoration: none; color: var(--text-soft); font-size: 13px;">
                    <i class="fa-solid fa-gear"></i> Pengaturan
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main">
            <div class="topbar">
                <div class="top-links">
                    <a href="piercing_produk.php">Produk</a>
                    <a href="jasa_piercing.php">Jasa</a>
                    <a href="maps.php">Maps</a>
                </div>
                <div class="top-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>

            <!-- MAPS CONTENT -->
            <div class="maps-container">
                <!-- Google Maps -->
                <div class="maps-frame">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0562265905516!2d110.36936!3d-7.787529999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5707b1b1b1b1%3A0x1b1b1b1b1b1b1b1b!2sJl.%20Malioboro%20No.10%2C%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Location Info -->
                <div class="location-info">
                    <div>
                        <h2>Studio Piercing Sphinx</h2>
                        <span style="color: var(--text-soft); font-size: 14px;">Lokasi Toko Kami</span>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div class="info-item-content">
                            <strong>Alamat</strong>
                            <span>Jl. Malioboro No. 10<br>Yogyakarta 55271<br>Indonesia</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-clock"></i>
                        <div class="info-item-content">
                            <strong>Jam Operasional</strong>
                            <span>Senin - Minggu<br>10:00 - 20:00 WIB</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-phone"></i>
                        <div class="info-item-content">
                            <strong>Hubungi Kami</strong>
                            <span>+62 274 xxxx xxx</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-brands fa-instagram"></i>
                        <div class="info-item-content">
                            <strong>Instagram</strong>
                            <span>@sphnx_piercing</span>
                        </div>
                    </div>

                    <div class="contact-buttons">
                        <a href="https://wa.me/62274xxxxxxx" class="contact-btn whatsapp" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="tel:+62274xxxxxxx" class="contact-btn call">
                            <i class="fa-solid fa-phone"></i> Hubungi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
