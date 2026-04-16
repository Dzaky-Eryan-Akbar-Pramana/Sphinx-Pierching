<?php
$username = "@sphnx_piercing";
$current_page = basename($_SERVER['PHP_SELF']);
$page_title = "Jasa Piercing";
$page_heading = "Jasa Piercing";
$page_description = "Lihat layanan jasa piercing profesional dengan prosedur aman dan nyaman untuk semua jenis piercing.";
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
            max-width: 920px;
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
            margin-bottom: 24px;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .feature-card {
            background: var(--bg-main-dark);
            border-radius: 14px;
            padding: 22px;
        }

        .feature-card h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--text);
        }

        .feature-card p {
            color: var(--text-soft);
            font-size: 14px;
            line-height: 1.7;
        }

        .service-block {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-top: 16px;
        }

        .service-copy {
            flex: 1;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            display: flex;
            gap: 12px;
            padding: 12px 14px;
            align-items: center;
            min-width: 260px;
        }

        .service-card img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
        }

        .service-card-content {
            flex: 1;
        }

        .service-card-content h3 {
            font-size: 15px;
            color: var(--text);
            margin-bottom: 4px;
        }

        .service-card-content p {
            font-size: 13px;
            color: var(--text-soft);
            line-height: 1.5;
            margin: 0;
        }

        .service-image {
            width: 220px;
            min-width: 220px;
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(130, 255, 91, .16), rgba(165, 76, 207, .15));
        }

        .service-image img {
            width: 100%;
            display: block;
        }

        .slot-table-wrap {
            overflow-x: auto;
            margin-top: 16px;
        }

        .slot-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
            font-size: 14px;
        }

        .slot-table th,
        .slot-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .slot-table th {
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 12px;
        }

        .slot-table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.04);
        }

        .status-full {
            color: #ff6d6d;
            font-weight: 700;
        }

        .status-available {
            color: var(--lime);
            font-weight: 700;
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

            .feature-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <img src="gambar/logo2.jpeg" alt="Logo">
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
            <div class="feature-list">
                <div class="feature-card" style="grid-column:1 / -1;">
                    <h2>Slot Booking</h2>
                    <p>Jadwal yang sudah terisi ditandai dengan warna merah untuk menunjukkan slot penuh.</p>
                    <div class="slot-table-wrap">
                        <table class="slot-table">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Selasa</td>
                                    <td>16 April 2024</td>
                                    <td>14:00 - 15:00 WIB</td>
                                    <td class="status-full">Full</td>
                                </tr>
                                <tr>
                                    <td>Kamis</td>
                                    <td>18 April 2024</td>
                                    <td>11:00 - 12:00 WIB</td>
                                    <td class="status-full">Full</td>
                                </tr>
                                <tr>
                                    <td>Sabtu</td>
                                    <td>20 April 2024</td>
                                    <td>16:30 - 17:30 WIB</td>
                                    <td class="status-full">Full</td>
                                </tr>
                                <tr>
                                    <td>Minggu</td>
                                    <td>21 April 2024</td>
                                    <td>10:00 - 11:00 WIB</td>
                                    <td class="status-available">Tersedia</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="feature-card" style="grid-column:1 / -1;">
                    <h2>Layanan Profesional</h2>
                    <div class="service-block">
                        <div class="service-copy">
                            <p>Silakan pilih layanan berdasarkan jenis piercing dan penjelasan prosedur yang tersedia:</p>
                            <div class="service-grid">
                                <div class="service-card">
                                    <img src="gambar/Contoh-Telinga.jpeg" alt="Telinga (Ear Lobe)">
                                    <div class="service-card-content">
                                        <h3>Telinga (Ear Lobe)</h3>
                                        <p>Piercing klasik di daun telinga dengan perawatan cepat dan minim nyeri.</p>
                                    </div>
                                </div>
                                <div class="service-card">
                                    <img src="gambar/Contoh-Hidung.png" alt="Hidung (Nose)">
                                    <div class="service-card-content">
                                        <h3>Hidung (Nose)</h3>
                                        <p>Piercing hidung profesional untuk model lubang kanan atau kiri.</p>
                                    </div>
                                </div>
                                <div class="service-card">
                                    <img src="gambar/Contoh-Alis.png" alt="Alis (Eyebrow)">
                                    <div class="service-card-content">
                                        <h3>Alis (Eyebrow)</h3>
                                        <p>Piercing alis rapi dengan posisi estetis dan aman.</p>
                                    </div>
                                </div>
                                <div class="service-card">
                                    <img src="gambar/Contoh-Bibir.png" alt="Bibir (Lip)">
                                    <div class="service-card-content">
                                        <h3>Bibir (Lip)</h3>
                                        <p>Piercing bibir atas/bawah dengan teknik steril dan aftercare lengkap.</p>
                                    </div>
                                </div>
                                <div class="service-card">
                                    <img src="gambar/Contoh-Lidah.png" alt="Lidah (Tongue)">
                                    <div class="service-card-content">
                                        <h3>Lidah (Tongue)</h3>
                                        <p>Piercing kompleks pada daun telinga dengan dua lubang sekaligus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn-back" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i>Kembali ke Dashboard</a>
            <a class="btn-back" href="jadwal.php"><i class="fa-solid fa-calendar-check"></i>Reservasi ke Jadwal</a>
        </section>
    </main>
</div>
</body>
</html>
