<?php 
include 'header.php'; 

$username = "@sphnx_piercing";
$promo_title = "Promo Piercing";
$promo_sub = "Diskon 20%";

$current_page = basename($_SERVER['PHP_SELF']);
?>
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
            background-attachment:fixed;
            background-size:cover;
            color:var(--text);
        }
        .app{
            display:flex;
            min-height: calc(100vh - 62px);
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
        .search-box{
            flex:1; background:var(--accent); padding:10px 16px;
            border-radius:999px; display:flex; align-items:center; gap:10px;
        }
        .search-box input{
            flex:1; border:none; outline:none; background:transparent;
            color:var(--text); font-size:14px;
        }
        .search-box input::placeholder{ color:#f6f6f6; opacity:0.8; }
        
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
            text-decoration:none; color:inherit;
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
            grid-template-columns: repeat(6, minmax(180px, 1fr));
            gap:24px;
            margin-top:40px;
        }

        .product-item{
            background:var(--bg-card); padding:14px; border-radius:12px;
            text-align:center; position:relative; overflow:hidden;
        }
        .product-item img{
            width:100%; aspect-ratio: 1/1; object-fit:cover;
            border-radius:12px; margin-bottom:12px; display:block;
            transition:transform .35s ease;
        }
        .product-item::before{
            pointer-events: none;
            content: 'Lihat'; position:absolute; inset:0;
            display:flex; align-items:center; justify-content:center;
            color:var(--text); background:rgba(0,0,0,0.35); opacity:0;
            transition:opacity .25s ease; font-weight:600; font-size:14px;
            border-radius:10px; z-index: 10;
        }
        .product-item:hover img{ transform:scale(1.08); }
        .product-item:hover::before{ opacity:1; }
        .product-item span{ display:block; color:var(--text-soft); font-size:14px; }

        /* LOVE/FAVORITE BUTTON */
        .product-love-btn{
            position:absolute; top:10px; right:10px; z-index:15;
            background:rgba(0,0,0,0.5); border:none; cursor:pointer;
            width:36px; height:36px; border-radius:50%; display:flex;
            align-items:center; justify-content:center; transition:.2s;
        }
        .product-love-btn:hover{ background:rgba(0,0,0,0.7); transform:scale(1.1); }
        .product-love-btn i{ font-size:18px; color:var(--text-soft); transition:.2s; }
        .product-love-btn.active i{ color:var(--lime); }
        .product-love-btn.active{ background:rgba(130,255,91,0.15); }

        .product-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            z-index: 120;
        }

        .product-modal.active {
            display: grid;
        }

        .product-modal-card {
            background: var(--bg-card);
            border-radius: 18px;
            width: min(680px, 100%);
            padding: 28px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
            position: relative;
        }

        .product-modal-image {
            width: 100%;
            max-height: 320px;
            overflow: hidden;
            border-radius: 16px;
            margin-bottom: 18px;
            background: rgba(0, 0, 0, 0.08);
        }

        .product-modal-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
            border-radius: 16px;
            max-height: 320px;
            margin: 0 auto;
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            color: var(--text);
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: background .2s;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        .btn-buy {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 18px;
            margin-top: 22px;
            border-radius: 12px;
            background: var(--lime);
            color: #111;
            text-decoration: none;
            font-weight: 700;
            transition: transform .2s ease, opacity .2s ease;
        }

        .btn-buy:hover {
            transform: translateY(-1px);
            opacity: 0.95;
        }

        .product-modal-card h2 {
            font-size: 24px;
            margin-bottom: 14px;
            color: var(--lime);
        }

        .product-modal-card p {
            color: var(--text-soft);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .product-modal-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(120px, 1fr));
            gap: 16px;
        }

        .checkout-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.82);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 130;
        }

        .checkout-modal.active {
            display: grid;
        }

        .checkout-modal-card {
            background: var(--bg-card);
            border-radius: 18px;
            width: min(95vw, 1160px);
            max-height: 95vh;
            overflow: hidden;
            position: relative;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
        }

        .checkout-modal-card iframe {
            width: 100%;
            height: 88vh;
            border: none;
            display: block;
            background: #111;
        }

        .checkout-modal-card .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 10;
        }

        .product-modal-meta div {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 16px;
        }

        .product-modal-meta span {
            display: block;
            font-size: 12px;
            color: var(--text-soft);
            margin-bottom: 6px;
        }

        .product-modal-meta strong {
            display: block;
            color: var(--text);
            font-size: 16px;
        }

        @media (max-width: 1280px) {
            .product-images {
                grid-template-columns: repeat(4, minmax(180px, 1fr));
            }
        }
        

        @media (max-width: 1024px) {
            .product-images {
                grid-template-columns: repeat(3, minmax(180px, 1fr));
            }
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
            .product-images { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 600px) {
            .main { padding: 12px 10px; }
            .topbar { flex-wrap: wrap; gap: 8px; }
            .search-box { min-width: 0; }
            .promo-text h1 { font-size: 22px; }
            .features { grid-template-columns: 1fr; }
            .product-images { grid-template-columns: 1fr; }
        }

        /* --- UPDATE MODAL BUTTONS --- */
        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
            width: 100%;
        }

        .btn-buy {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 1; /* Berbagi ruang yang sama rata dengan tombol keranjang */
            padding: 12px 18px;
            border-radius: 12px;
            background: var(--lime);
            color: #111;
            text-decoration: none;
            font-weight: 700;
            transition: transform .2s ease, opacity .2s ease;
        }

        .btn-buy:hover {
            transform: translateY(-1px);
            opacity: 0.95;
        }

        .btn-cart {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1; /* Berbagi ruang yang sama rata */
            padding: 12px 18px;
            border-radius: 12px;
            background: transparent;
            color: var(--lime);
            border: 2px solid var(--lime);
            text-decoration: none;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-cart:hover {
            background: rgba(130, 255, 91, 0.1); /* Efek hover hijau transparan */
            transform: translateY(-1px);
        }

        /* --- KONTROL PLUS MINUS KERANJANG --- */
        .cart-qty-control {
            display: none; /* Disembunyikan di awal */
            align-items: center;
            justify-content: space-between;
            flex: 1; /* Ukuran menyesuaikan agar sejajar dengan Beli */
            padding: 8px 12px;
            border-radius: 12px;
            border: 2px solid var(--lime);
            background: rgba(130, 255, 91, 0.08);
        }

        .cart-qty-btn {
            background: transparent;
            border: none;
            color: var(--lime);
            font-size: 16px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: .2s ease;
        }

        .cart-qty-btn:hover {
            background: rgba(130, 255, 91, 0.2);
        }

        .cart-qty-value {
            color: var(--lime);
            font-weight: 700;
            font-size: 16px;
            min-width: 24px;
            text-align: center;
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
            <li><a href="dashboard.php" class="<?= ($current_page == 'dashboard.php' || $current_page == 'Dashboard.php') ? 'active' : '' ?>"><i class="fa-solid fa-house"></i>Dashboard</a></li>
            <li><a href="riwayat.php" class="<?= $current_page == 'riwayat.php' ? 'active' : '' ?>"><i class="fa-solid fa-clock-rotate-left"></i>Riwayat Pemesanan</a></li>
            <li><a href="jadwal.php" class="<?= $current_page == 'jadwal.php' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-check"></i>Jadwal Reservasi</a></li>
            <!-- <li><a href="metode.php" class="<?= $current_page == 'metode.php' ? 'active' : '' ?>"><i class="fa-solid fa-wallet"></i>Metode Pembayaran</a></li> -->
            <li><a href="pengaturan.php" class="<?= $current_page == 'pengaturan.php' ? 'active' : '' ?>"><i class="fa-solid fa-gear"></i>Pengaturan Akun</a></li>
        </ul>
        
        <div class="sidebar-footer">
            <ul class="menu">
                 <li><a href="bantuan.php" class="<?= $current_page == 'bantuan.php' ? 'active' : '' ?>"><i class="fa-solid fa-circle-question"></i>Bantuan</a></li>
            </ul>
        </div>
    </aside>

        <!-- <div class="sidebar-footer">
            <ul class="menu">
                <li><a href="bantuan.php"><i class="fa-solid fa-circle-question"></i>Bantuan</a></li>
            </ul>
        </div>
    </aside> -->

    <main class="main app">
        <!-- Topbar moved to header, cartIcon synced -->


        <section class="promo-card">
            <div class="promo-text">
                <h1><?= $promo_title ?></h1>
                <p><?= $promo_sub ?></p>
                <button>Lihat Detail</button>
            </div>
            <div class="promo-image">
                <img src="gambar/promo.png" alt="Promo Piercing">
            </div>
        </section>

        <section class="features">
            <a class="feature-item" href="piercing_produk.php">
                <div class="feature-icon"><i class="fa-solid fa-gem"></i></div>X
                <span>Piercing Produk</span>
            </a>
            <a class="feature-item" href="jasa_piercing.php">
                <div class="feature-icon"><i class="fa-regular fa-gem"></i></div>
                <span>Jasa Piercing</span>
            </a>
            <a class="feature-item" href="alternatif_piercing.php">
                <div class="feature-icon"><i class="fa-solid fa-ring"></i></div>
                <span>Alternatif Piercing</span>
            </a>
            <a class="feature-item" href="piercing_disukai.php">
                <div class="feature-icon"><i class="fa-regular fa-heart"></i></div>
                <span>Piercing Yang Disukai</span>
            </a>
        </section>

        <section class="product-images">
            <div class="product-item" data-product="Cubic Zirconia" data-desc="Desain klasik dengan batu cubic zirconia yang berkilau, cocok untuk tampilan elegan pada berbagai jenis piercing." data-price="Rp 30.000" data-stock="12">
                <button class="product-love-btn" data-product="Cubic Zirconia"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/cubic-zironia.jpg" alt="Product 1">
                <span>Cubic Zirconia</span>
            </div>
            <div class="product-item" data-product="Titanium Earrings" data-desc="Anting titanium ringan dan tahan karat, ideal untuk kulit sensitif dan pemakaian sehari-hari." data-price="Rp 50.000" data-stock="8">
                <button class="product-love-btn" data-product="Titanium Earrings"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/titanium-earrings.jpg" alt="Product 2">
                <span>Titanium Earrings</span>
            </div>
            <div class="product-item" data-product="Spike Ohrring" data-desc="Piercing dengan desain spike yang tajam dan elegan. Cocok untuk septum, telinga, atau alternatif piercing lainnya." data-price="Rp 55.000" data-stock="10">
                <button class="product-love-btn" data-product="Spike Ohrring"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/spkie-ohrring.jpg" alt="Product 3">
                <span>Spike Ohrring</span>
            </div>
            <div class="product-item" data-product="Kyoto Series" data-desc="Koleksi piercing bertema Jepang yang minimalis dan modern, memberikan nuansa estetika elegan." data-price="Rp 40.000" data-stock="7">
                <button class="product-love-btn" data-product="Kyoto Series"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/kyoto-series.jpg" alt="Product 4">
                <span>Kyoto Series</span>
            </div>
            <div class="product-item" data-product="Ear Piercing Ball" data-desc="Piercing bentuk bola yang halus, cocok untuk berbagai variasi anting dan piercing telinga." data-price="Rp 45.000" data-stock="15">
                <button class="product-love-btn" data-product="Ear Piercing Ball"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/ear-piercing-ball.jpg" alt="Product 5">
                <span>Ear Piercing Ball</span>
            </div>
            <div class="product-item" data-product="Barbell Earrings" data-desc="Anting barbell dengan desain kuat dan trendi untuk gaya piercing yang berani." data-price="Rp 35.000" data-stock="9">
                <button class="product-love-btn" data-product="Barbell Earrings"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/barbell-earrings.jpg" alt="Product 6">
                <span>Barbell Earrings</span>
            </div>
            <div class="product-item" data-product="Tindik Bunga" data-desc="Piercing motif bunga yang feminin dan manis, cocok untuk tampilan lembut." data-price="Rp 50.000" data-stock="6">
                <button class="product-love-btn" data-product="Tindik Bunga"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Tindik-Bunga.png" alt="Product 7">
                <span>Tindik Bunga</span>
            </div>
            <div class="product-item" data-product="Anting Jepit" data-desc="Anting jepit praktis tanpa tindik, ideal untuk yang ingin tampil stylish tanpa komitmen permanen." data-price="Rp 35.000" data-stock="18">
                <button class="product-love-btn" data-product="Anting Jepit"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Anting-Jepit.png" alt="Product 8">
                <span>Anting Jepit</span>
            </div>
            <div class="product-item" data-product="Barre de Surface" data-desc="Piercing surface bar yang modern dan minimalis untuk area dada atau punggung." data-price="Rp 30.000" data-stock="5">
                <button class="product-love-btn" data-product="Barre de Surface"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Barre-de-surface.png" alt="Product 9">
                <span>Barre de Surface</span>
            </div>
            <div class="product-item" data-product="Circular Barbell" data-desc="Piercing berbentuk lingkaran dengan bola pada kedua ujungnya untuk gaya klasik yang nyaman." data-price="Rp 55.000" data-stock="11">
                <button class="product-love-btn" data-product="Circular Barbell"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Circular-Barbell.png" alt="Product 10">
                <span>Circular Barbell</span>
            </div>
            <div class="product-item" data-product="Dparis Model Bintang" data-desc="Desain unik dengan motif bintang yang menawan, cocok untuk tampilan berani dan ekspresif." data-price="Rp 35.000" data-stock="4">
                <button class="product-love-btn" data-product="Dparis Model Bintang"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Dparis-Model-Bintang.png" alt="Product 11">
                <span>Dparis Model Bintang</span>
            </div>
            <div class="product-item" data-product="Titanium Straight Barbel" data-desc="Barbel lurus titanium hypoallergenic, sempurna untuk piercing bridge atau septum." data-price="Rp 40.000" data-stock="8">
                <button class="product-love-btn" data-product="Titanium Straight Barbel"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Titanium-Straight-Barbel.png" alt="Product 12">
                <span>Titanium Straight Barbel</span>
            </div>
            <div class="product-item" data-product="Piercing Nostril Em Aço" data-desc="Piercing nostril berkualitas steel dengan desain geometri dan finish premium." data-price="Rp 35.000" data-stock="7">
                <button class="product-love-btn" data-product="Piercing Nostril Em Aço"><i class="fa-regular fa-heart"></i></button>
                <img src="gambar/Piercing-Nostril-Em-Aço.png" alt="Product 13">
                <span>Piercing Nostril Em Aço</span>
            </div>
        </section>

        <!-- <div class="product-modal" id="productModal">
            <div class="product-modal-card">
                <button class="modal-close" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
                <div class="product-modal-image">
                    <img id="modalProductImage" src="" alt="Detail Produk">
                </div>
                <h2 id="modalProductName"></h2>
                <p id="modalProductDesc"></p>
                <div class="product-modal-meta">
                    <div>
                        <span>Harga</span>
                        <strong id="modalProductPrice"></strong>
                    </div>
                    <div>
                        <span>Stock Tersedia</span>
                        <strong id="modalProductStock"></strong>
                    </div>
                </div>
                <a id="buyButton" class="btn-buy" href="#">Beli</a>
            </div>
        </div> -->

        <div class="product-modal" id="productModal">
            <div class="product-modal-card">
                <button class="modal-close" id="closeModal"><i class="fa-solid fa-xmark"></i></button>
                <div class="product-modal-image">
                    <img id="modalProductImage" src="" alt="Detail Produk">
                </div>
                <h2 id="modalProductName"></h2>
                <p id="modalProductDesc"></p>
                <div class="product-modal-meta">
                    <div>
                        <span>Harga</span>
                        <strong id="modalProductPrice"></strong>
                    </div>
                    <div>
                        <span>Stock Tersedia</span>
                        <strong id="modalProductStock"></strong>
                    </div>
                </div>
                
                <!-- <div class="modal-actions">
                    <button id="cartButton" class="btn-cart">
                        <i class="fa-solid fa-cart-plus"></i> Keranjang
                    </button>
                    <a id="buyButton" class="btn-buy" href="#">Beli Sekarang</a>
                </div> -->
                
                <div class="modal-actions" style="flex-direction:column; gap:10px;">
                    <div id="cartQtyControl" class="cart-qty-control" style="display:flex; flex:unset; width:100%;">
                        <button id="cartMinus" class="cart-qty-btn"><i class="fa-solid fa-minus"></i></button>
                        <span id="cartQtyValue" class="cart-qty-value">1</span>
                        <button id="cartPlus" class="cart-qty-btn"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div style="display:flex; gap:10px; width:100%;">
                        <button id="cartButton" class="btn-cart" style="flex:0 0 52px; width:52px; padding:12px;">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                        <a id="buyButton" class="btn-buy" style="flex:1; margin-top:0;" href="#">Beli Sekarang</a>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="checkout-modal" id="checkoutModal">
            <div class="checkout-modal-card">
                <button class="modal-close" id="closeCheckoutBtn"><i class="fa-solid fa-xmark"></i></button>
                <iframe id="checkoutIframe" src="" title="Checkout Produk"></iframe>
            </div>
        </div>

    </main>

<script>
    
    const favoriteKey = 'piercing_favorites';

    const cartKey = 'sphinx_cart';

    // Elemen DOM
    const cartCountEl = document.getElementById('cartCount');
    const productModal = document.getElementById('productModal');
    const productNameEl = document.getElementById('modalProductName');
    const productDescEl = document.getElementById('modalProductDesc');
    const productPriceEl = document.getElementById('modalProductPrice');
    const productStockEl = document.getElementById('modalProductStock');
    const productImageEl = document.getElementById('modalProductImage');
    
    // Elemen Tombol Modal
    const buyButton = document.getElementById('buyButton');
    const cartButton = document.getElementById('cartButton');
    const cartQtyControl = document.getElementById('cartQtyControl');
    const cartMinus = document.getElementById('cartMinus');
    const cartPlus = document.getElementById('cartPlus');
    const cartQtyValue = document.getElementById('cartQtyValue');
    
    const closeModalBtn = document.getElementById('closeModal');
    const checkoutModal = document.getElementById('checkoutModal');
    const checkoutIframe = document.getElementById('checkoutIframe');
    const closeCheckoutBtn = document.getElementById('closeCheckoutBtn');

    let currentSelectedProduct = null;

    // Load Favorit
    function loadFavorites() {
        const favorites = JSON.parse(localStorage.getItem(favoriteKey) || '[]');
        favorites.forEach(productName => {
            const btn = document.querySelector(`.product-love-btn[data-product="${productName}"]`);
            if (btn) {
                btn.classList.add('active');
                btn.innerHTML = '<i class="fa-solid fa-heart"></i>';
            }
        });
    }

    // Load Angka Keranjang Topbar
    function loadCartCount() {
        const cart = JSON.parse(localStorage.getItem(cartKey) || '[]');
        const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        cartCountEl.innerText = totalItems;
    }

    // Cek Status Tombol Keranjang (Apakah tampilkan tombol "Keranjang" atau "+ -")
    function updateCartButtonState(productName) {
        cartQtyValue.innerText = 1;
    }

    // Handle klik tombol favorit
    document.querySelectorAll('.product-love-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const productName = this.dataset.product;
            let favorites = JSON.parse(localStorage.getItem(favoriteKey) || '[]');

            if (this.classList.contains('active')) {
                favorites = favorites.filter(name => name !== productName);
                this.classList.remove('active');
                this.innerHTML = '<i class="fa-regular fa-heart"></i>';
            } else {
                if (!favorites.includes(productName)) {
                    favorites.push(productName);
                }
                this.classList.add('active');
                this.innerHTML = '<i class="fa-solid fa-heart"></i>';
            }
            localStorage.setItem(favoriteKey, JSON.stringify(favorites));
        });
    });

    // Buka Modal Produk
    document.querySelectorAll('.product-item').forEach(item => {
        item.addEventListener('click', function () {
            const name = this.dataset.product || '';
            const desc = this.dataset.desc || 'Deskripsi tidak tersedia.';
            const price = this.dataset.price || '-';
            const stock = this.dataset.stock || '-';
            const image = this.querySelector('img');

            currentSelectedProduct = { name, price, image: image ? image.src : '' };

            productNameEl.innerText = name;
            productDescEl.innerText = desc;
            productPriceEl.innerText = price;
            productStockEl.innerText = stock;
            productImageEl.src = image ? image.src : '';
            productImageEl.alt = image ? image.alt : name;
            // Set buy link to open checkout page for this product (global handler will redirect)
            if (buyButton) {
                const encodedProduct = encodeURIComponent(name || '');
                const encodedPrice = encodeURIComponent(price || '');
                buyButton.href = `beli.php?product=${encodedProduct}&price=${encodedPrice}`;
            }
            // Update UI Keranjang berdasarkan data produk ini
            updateCartButtonState(name);

            productModal.classList.add('active');
        });
    });

    // KLIK TOMBOL KERANJANG (Klik Pertama)
    // cartButton.addEventListener('click', function() {
    //     if (!currentSelectedProduct) return;
    //     let cart = JSON.parse(localStorage.getItem(cartKey) || '[]');
        
    //     cart.push({
    //         name: currentSelectedProduct.name,
    //         price: currentSelectedProduct.price,
    //         image: currentSelectedProduct.image,
    //         qty: 1
    //     });

    //     localStorage.setItem(cartKey, JSON.stringify(cart));
    //     loadCartCount();
    //     updateCartButtonState(currentSelectedProduct.name); // Animasi tombol berubah
    // });

    cartButton.addEventListener('click', function() {
    if (!currentSelectedProduct) return;
    const qtyToAdd = parseInt(cartQtyValue.innerText) || 1;

    if (window.sphinxCart) {
        sphinxCart.addItem({
            name: currentSelectedProduct.name,
            price: currentSelectedProduct.price,
            image: currentSelectedProduct.image,
            qty: qtyToAdd
        });
    } else {
        let cart = JSON.parse(localStorage.getItem('sphinx_cart') || '[]');
        let existing = cart.find(i => i.name === currentSelectedProduct.name);
        if (existing) existing.qty += qtyToAdd;
        else cart.push({ name: currentSelectedProduct.name, price: currentSelectedProduct.price, image: currentSelectedProduct.image, qty: qtyToAdd });
        localStorage.setItem('sphinx_cart', JSON.stringify(cart));
    }

    loadCartCount();
    cartQtyValue.innerText = 1;
    productModal.classList.remove('active');
});

    // KLIK TOMBOL PLUS (+)
    cartPlus.addEventListener('click', function() {
        let qty = parseInt(cartQtyValue.innerText) || 1;
        cartQtyValue.innerText = qty + 1;
    });

    // KLIK TOMBOL MINUS (-)
    cartMinus.addEventListener('click', function() {
        let qty = parseInt(cartQtyValue.innerText) || 1;
        if (qty > 1) cartQtyValue.innerText = qty - 1;
    });

    // Handle Beli Sekarang (redirect to beli.php)
    buyButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (!this.href || this.href === '#') return;
        const qty = parseInt(cartQtyValue.innerText) || 1;
        const baseHref = this.href.split('&qty=')[0];
        productModal.classList.remove('active');
        // redirect top-level to the link (beli.php) with selected quantity
        window.location.href = baseHref + '&qty=' + qty;
    });

    // Handle Tutup Modal
    closeModalBtn.addEventListener('click', () => { productModal.classList.remove('active'); });
    productModal.addEventListener('click', (event) => {
        if (event.target === productModal) productModal.classList.remove('active');
    });
    closeCheckoutBtn.addEventListener('click', () => {
        checkoutModal.classList.remove('active'); checkoutIframe.src = '';
    });
    checkoutModal.addEventListener('click', (event) => {
        if (event.target === checkoutModal) {
            checkoutModal.classList.remove('active'); checkoutIframe.src = '';
        }
    });

    // Load data saat pertama kali
    window.addEventListener('DOMContentLoaded', () => {
        loadFavorites();
        loadCartCount();
    });
</script>


</body>
</html>
