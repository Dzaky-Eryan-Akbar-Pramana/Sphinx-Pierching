<?php
$current_page = basename($_SERVER['PHP_SELF']);
include 'header.php';
?>
<style>
        /* CSS SAMA SEPERTI YANG KAMU KIRIM */
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
            background-attachment:fixed;
            background-size:cover;
            color:var(--text);
        }

        /* Pastikan semua elemen teks memakai Poppins sama seperti Dashboard */
        h1,h2,h3,h4,h5,h6,
        p,li,span,a,button,input,textarea,
        .card, .main, .toc, .feature-item, .product-item {
            font-family: "Poppins", sans-serif;
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
        /* Style untuk menu aktif */
        .menu a:hover, .menu a.active{ background:var(--bg-main-dark); color:var(--lime); }
        
        .sidebar-footer{
            width:100%; margin-top:auto; padding-top:12px;
            border-top:1px solid rgba(255,255,255,.08);
        }
        
        /* --- MAIN CONTENT --- */
        .main{
            flex:1; padding:20px 28px; background:var(--bg-main);
            display:flex; flex-direction:column;
            margin-left:210px; /* offset sidebar */
        }
    
        .topbar{
            display:flex; align-items:center; gap:20px; margin-bottom:24px;
        }
        
        .top-links{ display:flex; align-items:center; gap:24px; font-size:14px; }
        .top-links a{ text-decoration:none; color:var(--text-soft); }
        .top-links a:hover{ color:var(--lime); }
        .top-icons{ display:flex; align-items:center; gap:16px; font-size:18px; }
       
        /* --- PROMO CARD --- */
        .promo-card{
            background:var(--bg-card); border-radius:14px; padding:26px 28px;
            display:flex; justify-content:space-between; align-items:stretch;
            gap:20px; min-height:260px; overflow:hidden; margin-bottom:36px;
        }
        .promo-text{
            flex:1 1 auto; display:flex; flex-direction:column; justify-content:center; gap:8px;
        }
        .promo-text h1{ font-size:30px; color:var(--lime); line-height:1.2; }
        .promo-text p{ margin-top:6px; font-size:18px; color:var(--lime); }
        .promo-text button{
            margin-top:18px; border:none; border-radius:8px; padding:10px 22px;
            font-size:14px; cursor:pointer; background:var(--accent-soft); color:var(--text);
        }
        .promo-text button:hover{ opacity:.9; }
        .promo-image{
            flex:0 0 45%; display:flex; align-items:stretch;
            min-width:340px; max-width:55%; overflow:hidden;
            filter:grayscale(1); border-radius:0 14px 14px 0;
        }
        .promo-image img{
            width:100%; height:100%; object-fit:cover; display:block;
        }
        
        /* --- FEATURES --- */
        .features{
            display:grid; grid-template-columns: repeat(4, 1fr); gap:20px; margin-top:40px;
        }
        .feature-item{
            background: var(--bg-card); padding:20px; text-align:center;
            border-radius:14px; display:flex; flex-direction:column;
            justify-content:center; align-items:center; transition:.3s ease-in-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .feature-item:hover{ background: var(--bg-main-dark); transform:scale(1.05); }
        .feature-icon{
            width:80px; height:80px; background: var(--bg-card);
            border-radius:50%; display:flex; justify-content:center; align-items:center;
            margin-bottom:15px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .feature-icon i{ font-size:36px; color: var(--lime); }
        .feature-item span{ color: var(--text-soft); font-size:14px; }

        /* --- PRODUCT IMAGES (DIPERBAIKI) --- */
        .product-images{
            display:grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap:20px;
            margin-top:40px;
        }

        .product-item {
            background: var(--bg-card);
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .product-item img {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
            transition: transform .35s ease;
        }

        .product-item::before {
            content: 'Lihat';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            background: rgba(0, 0, 0, 0.35);
            opacity: 0;
            transition: opacity .25s ease;
            font-weight: 600;
            font-size: 14px;
            border-radius: 10px;
            z-index: 10;
        }

        .product-item:hover img {
            transform: scale(1.08);
        }

        .product-item:hover::before {
            opacity: 1;
        }

        .product-item span {
            display: block;
            color: var(--text-soft);
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .sidebar { width: 60px; padding: 12px 6px; }
            .brand { display: none; }
            .sidebar-footer { display: none; }
            .menu a { font-size: 0; padding: 10px; justify-content: center; }
            .menu a i { font-size: 18px; width: auto; }
            .main { margin-left: 60px; }
            .features { grid-template-columns: repeat(2, 1fr); }
            .promo-card { flex-direction: column; }
            .promo-image { max-width: 100%; min-width: auto; height: 200px; }
        }

        @media (max-width: 600px) {
            .main { padding: 12px 10px; }
            .topbar { flex-wrap: wrap; gap: 8px; }
            .promo-text h1 { font-size: 20px; }
            .features { grid-template-columns: 1fr; }
        }
    </style>

<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <img src="gambar/logo2.jpeg" alt="Logo">
            <span><?= isset($username) ? htmlspecialchars($username) : 'Tamu' ?></span>
        </div>

        <ul class="menu">
            <li><a href="dashboard.php" class="<?= ($current_page == 'dashboard.php' || $current_page == 'Dashboard.php') ? 'active' : '' ?>"><i class="fa-solid fa-house"></i>Dashboard</a></li>
            <li><a href="riwayat.php" class="<?= $current_page == 'riwayat.php' ? 'active' : '' ?>"><i class="fa-solid fa-clock-rotate-left"></i>Riwayat Pemesanan</a></li>
            <li><a href="jadwal.php" class="<?= $current_page == 'jadwal.php' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-check"></i>Jadwal Reservasi</a></li>

            <li><a href="pengaturan.php" class="<?= $current_page == 'pengaturan.php' ? 'active' : '' ?>"><i class="fa-solid fa-gear"></i>Pengaturan Akun</a></li>
        </ul>

        <div class="sidebar-footer">
            <ul class="menu">
                 <li><a href="bantuan.php" class="<?= $current_page == 'bantuan.php' ? 'active' : '' ?>"><i class="fa-solid fa-circle-question"></i>Bantuan</a></li>
            </ul>
        </div>
    </aside>

    <main class="main">
        <div class="header-top">
            <h1 class="page-title">Bantuan & Kebijakan</h1>
        </div>

        <!-- <div class="toc">
            <a href="#privasi">Kebijakan Privasi</a>
            <a href="#bantuan">Bantuan</a>
            <a href="#syarat">Syarat & Ketentuan</a>
        </div> -->

        <section id="privasi" class="card">
            <h2>Kebijakan Privasi</h2>
            <p>
                Kami menghargai privasi Anda. Informasi yang dikumpulkan (mis. nama, alamat email, data pemesanan) digunakan untuk memproses layanan, meningkatkan pengalaman, dan komunikasi terkait akun.
                Data tidak akan dibagikan kepada pihak ketiga tanpa persetujuan kecuali bila diwajibkan oleh hukum. Anda dapat meminta akses, koreksi, atau penghapusan data melalui pengaturan akun atau menghubungi layanan pelanggan.
            </p>
            <p>
                Untuk keamanan, kami menerapkan langkah teknis dan kebijakan internal untuk melindungi data dari akses yang tidak sah. Dengan menggunakan layanan ini, Anda menyetujui pengumpulan dan pemrosesan data sesuai kebijakan kami.
            </p>
        </section>

        <section id="bantuan" class="card">
            <h2>Bantuan</h2>
            <p>
                Jika Anda menemui masalah saat melakukan pemesanan, pembayaran, atau ingin mengubah jadwal, silakan ikuti langkah berikut:
            </p>
            <ol style="color:var(--text-soft); margin-left:18px; margin-top:8px;">
                <li>Periksa bagian Riwayat atau Jadwal pada akun Anda untuk status dan detail pemesanan.</li>
                <li>Gunakan fitur Pengaturan untuk memperbarui informasi akun atau metode pembayaran.</li>
                <li>Jika masih bermasalah, hubungi tim dukungan melalui email: support@example.com atau telepon: 0812-3456-7890.</li>
            </ol>
            <p style="margin-top:8px;">Jam layanan pelanggan: Senin–Jumat, 09:00–17:00 WIB.</p>
        </section>

        <section id="syarat" class="card">
            <h2>Syarat & Ketentuan</h2>
            <p>
                Dengan menggunakan layanan kami, Anda setuju untuk mematuhi syarat dan ketentuan berikut: layanan hanya boleh dipakai untuk tujuan yang sah; Anda bertanggung jawab atas keakuratan informasi yang diberikan; pihak kami berhak menolak atau membatalkan pesanan yang melanggar ketentuan.
            </p>
            <p>
                Pembayaran yang sudah dikonfirmasi bersifat final kecuali ada kebijakan pengembalian dana yang berlaku. Kami dapat mengubah syarat ini sewaktu-waktu; perubahan akan diumumkan di situs dan berlaku sejak tanggal publikasi.
            </p>
        </section>

    </main>
</div>

</body>
</html>