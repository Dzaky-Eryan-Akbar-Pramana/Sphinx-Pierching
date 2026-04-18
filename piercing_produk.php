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

        /* --- CART ICON ON CARD --- */
        .card-actions {
            margin-top: 16px;
            display: flex;
            justify-content: flex-end;
        }
        .btn-card-cart {
            background: transparent;
            border: 2px solid var(--lime);
            color: var(--lime);
            width: 42px; height: 42px;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: .2s;
        }
        .btn-card-cart:hover { background: rgba(130,255,91,.15); }

        /* --- PRODUCT MODAL --- */
        .product-modal {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.75);
            display: none; align-items: center; justify-content: center;
            padding: 24px; z-index: 120;
        }
        .product-modal.active { display: grid; }
        .product-modal-card {
            background: var(--bg-card); border-radius: 18px;
            width: min(680px, 100%); padding: 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,.35); position: relative;
        }
        .product-modal-image {
            width: 100%; max-height: 320px; overflow: hidden;
            border-radius: 16px; margin-bottom: 18px;
        }
        .product-modal-image img {
            width: 100%; height: auto; object-fit: contain;
            display: block; border-radius: 16px; max-height: 320px; margin: 0 auto;
        }
        .modal-close {
            position: absolute; top: 18px; right: 18px;
            width: 38px; height: 38px; border: none; border-radius: 50%;
            background: rgba(255,255,255,.08); color: var(--text);
            cursor: pointer; display: grid; place-items: center; transition: .2s;
        }
        .modal-close:hover { background: rgba(255,255,255,.16); }
        .product-modal-card h2 { font-size: 24px; margin-bottom: 14px; color: var(--lime); }
        .product-modal-card p { color: var(--text-soft); line-height: 1.7; margin-bottom: 24px; }
        .product-modal-meta {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;
        }
        .product-modal-meta div { background: rgba(255,255,255,.05); border-radius: 12px; padding: 16px; }
        .product-modal-meta span { display: block; font-size: 12px; color: var(--text-soft); margin-bottom: 6px; }
        .product-modal-meta strong { display: block; color: var(--text); font-size: 16px; }
        .modal-actions { display: flex; gap: 10px; margin-top: 22px; width: 100%; flex-direction: column; }
        .btn-buy {
            display: inline-flex; align-items: center; justify-content: center;
            flex: 1; padding: 12px 18px; border-radius: 12px;
            background: var(--lime); color: #111; text-decoration: none;
            font-weight: 700; transition: .2s; margin-top: 0;
        }
        .btn-buy:hover { opacity: .92; transform: translateY(-1px); }
        .btn-cart {
            display: inline-flex; align-items: center; justify-content: center;
            gap: 8px; padding: 12px; border-radius: 12px;
            background: transparent; color: var(--lime);
            border: 2px solid var(--lime); font-weight: 700;
            cursor: pointer; transition: .2s; flex: 0 0 52px; width: 52px;
        }
        .btn-cart:hover { background: rgba(130,255,91,.1); }
        .cart-qty-control {
            display: flex; align-items: center; justify-content: space-between;
            width: 100%; padding: 8px 12px; border-radius: 12px;
            border: 2px solid var(--lime); background: rgba(130,255,91,.08);
        }
        .cart-qty-btn {
            background: transparent; border: none; color: var(--lime);
            font-size: 16px; cursor: pointer; width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; transition: .2s;
        }
        .cart-qty-btn:hover { background: rgba(130,255,91,.2); }
        .cart-qty-value { color: var(--lime); font-weight: 700; font-size: 16px; min-width: 24px; text-align: center; }

        @media (max-width: 900px) {
            .sidebar { width: 60px; padding: 12px 6px; }
            .brand { display: none; }
            .sidebar-footer { display: none; }
            .menu a { font-size: 0; padding: 10px; justify-content: center; }
            .menu a i { font-size: 18px; width: auto; }
            .main { margin-left: 60px; }
            .feature-page { padding: 22px; }
            .products-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; }
        }

        @media (max-width: 600px) {
            .main { padding: 12px 10px; }
            .feature-page h1 { font-size: 22px; }
            .products-grid { grid-template-columns: 1fr; }
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
                <i class="fa-solid fa-cart-shopping" id="cartIcon" style="position:relative;cursor:pointer;" title="Keranjang">
                  <span class="cart-count" id="cartCount" style="position:absolute;top:-8px;right:-8px;background:var(--lime);color:#111;border-radius:50%;width:20px;height:20px;font-size:12px;display:flex;align-items:center;justify-content:center;font-weight:600;">0</span>
                </i>
            </div>

        </div>
        <section class="feature-page">
            <h1>PRODUK PIERCING </h1>
            <p>Temukan pilihan piercing alternatif yang unik dan menarik, cocok untuk gaya berbeda.</p>
            
            <div class="products-grid">
        <div class="product-card" data-product="Spike Ohrring" data-price="Rp 55.000" data-stock="10" data-desc="Piercing dengan desain spike yang tajam dan elegan. Cocok untuk septum, telinga, atau alternatif piercing lainnya dengan tampilan aggressive yang stylish.">
                    <img src="gambar/spkie-ohrring.jpg" alt="Spike Ohrring" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Spike Ohrring</h3>
                        <p class="product-desc">Piercing dengan desain spike yang tajam dan elegan. Cocok untuk septum, telinga, atau alternatif piercing lainnya dengan tampilan aggressive yang stylish.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Circular Barbell" data-price="Rp 45.000" data-stock="8" data-desc="Piercing berbentuk lingkaran dengan bola pada kedua ujungnya. Desain klasik namun sophisticated, sangat populer untuk body piercing dan septum.">
                    <img src="gambar/Circular-Barbell.png" alt="Circular Barbell" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Circular Barbell</h3>
                        <p class="product-desc">Piercing berbentuk lingkaran dengan bola pada kedua ujungnya. Desain klasik namun sophisticated, sangat populer untuk body piercing dan septum.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Barre de Surface" data-price="Rp 60.000" data-stock="6" data-desc="Piercing surface bar yang modern dan minimalis. Ideal untuk surface piercing di area dada, punggung, atau bagian tubuh lainnya dengan efek visual unik.">
                    <img src="gambar/Barre-de-surface.png" alt="Barre de Surface" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Barre de Surface</h3>
                        <p class="product-desc">Piercing surface bar yang modern dan minimalis. Ideal untuk surface piercing di area dada, punggung, atau bagian tubuh lainnya dengan efek visual unik.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Titanium Straight Barbel" data-price="Rp 75.000" data-stock="5" data-desc="Barbel lurus berkualitas tinggi dari titanium. Hypoallergenic dan aman untuk semua jenis kulit, sempurna untuk piercing bridge atau septa dengan kenyamanan maksimal.">
                    <img src="gambar/Titanium-Straight-Barbel.png" alt="Titanium Straight Barbel" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Titanium Straight Barbel</h3>
                        <p class="product-desc">Barbel lurus berkualitas tinggi dari titanium. Hypoallergenic dan aman untuk semua jenis kulit, sempurna untuk piercing bridge atau septa dengan kenyamanan maksimal.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Dparis Model Bintang" data-price="Rp 50.000" data-stock="12" data-desc="Desain unik dengan motif bintang yang menawan. Memberikan statement yang berani dan crafty untuk mereka yang ingin tampil beda dan ekspresif.">
                    <img src="gambar/Dparis-Model-Bintang.png" alt="Dparis Model Bintang" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Dparis Model Bintang</h3>
                        <p class="product-desc">Desain unik dengan motif bintang yang menawan. Memberikan statement yang berani dan crafty untuk mereka yang ingin tampil beda dan ekspresif.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Piercing Nostril Em Aço" data-price="Rp 40.000" data-stock="15" data-desc="Piercing nostril berkualitas dengan material steel yang tahan lama. Sempurna untuk septum piercing dengan desain geometri dan finish yang premium.">
                    <img src="gambar/Piercing-Nostril-Em-Aço.png" alt="Piercing Nostril Em Aço" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Piercing Nostril Em Aço</h3>
                        <p class="product-desc">Piercing nostril berkualitas dengan material steel yang tahan lama. Sempurna untuk septum piercing dengan desain geometri dan finish yang premium.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Cubic Zirconia" data-price="Rp 85.000" data-stock="7" data-desc="Anting piercing dengan sentuhan kristal cubic zirconia, memberikan kilau mewah tanpa mengorbankan kenyamanan.">
                    <img src="gambar/cubic-zironia.jpg" alt="Cubic Zirconia" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Cubic Zirconia</h3>
                        <p class="product-desc">Anting piercing dengan sentuhan kristal cubic zirconia, memberikan kilau mewah tanpa mengorbankan kenyamanan.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Kyoto Series" data-price="Rp 70.000" data-stock="4" data-desc="Piercing koleksi Kyoto dengan bentuk elegan dan warna lembut, cocok untuk tampilan modern yang minimalis.">
                    <img src="gambar/kyoto-series.jpg" alt="Kyoto Series" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Kyoto Series</h3>
                        <p class="product-desc">Piercing koleksi Kyoto dengan bentuk elegan dan warna lembut, cocok untuk tampilan modern yang minimalis.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Ear Piercing Ball" data-price="Rp 35.000" data-stock="20" data-desc="Piercing model bola sederhana yang nyaman dipakai sehari-hari, ideal untuk tampilan ringkas dan modern.">
                    <img src="gambar/ear-piercing-ball.jpg" alt="Ear Piercing Ball" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Ear Piercing Ball</h3>
                        <p class="product-desc">Piercing model bola sederhana yang nyaman dipakai sehari-hari, ideal untuk tampilan ringkas dan modern.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Barbell Earrings" data-price="Rp 45.000" data-stock="9" data-desc="Desain barbel yang kuat dan stylish, sangat cocok untuk tampilan bold pada piercing telinga atau monroe.">
                    <img src="gambar/barbell-earrings.jpg" alt="Barbell Earrings" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Barbell Earrings</h3>
                        <p class="product-desc">Desain barbel yang kuat dan stylish, sangat cocok untuk tampilan bold pada piercing telinga atau monroe.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Tindik Bunga" data-price="Rp 50.000" data-stock="11" data-desc="Piercing motif bunga yang feminin dan manis, membuat tampilan lebih lembut dengan detail yang menarik.">
                    <img src="gambar/Tindik-Bunga.png" alt="Tindik Bunga" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Tindik Bunga</h3>
                        <p class="product-desc">Piercing motif bunga yang feminin dan manis, membuat tampilan lebih lembut dengan detail yang menarik.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>

                <div class="product-card" data-product="Anting Jepit" data-price="Rp 30.000" data-stock="18" data-desc="Pilihan anting tanpa tindik untuk gaya piercing sementara dengan kenyamanan tinggi dan desain trendi.">
                    <img src="gambar/Anting-Jepit.png" alt="Anting Jepit" class="product-image">
                    <div class="product-info">
                        <h3 class="product-name">Anting Jepit</h3>
                        <p class="product-desc">Pilihan anting tanpa tindik untuk gaya piercing sementara dengan kenyamanan tinggi dan desain trendi.</p>
                        <div class="card-actions"><button class="btn-card-cart"><i class="fa-solid fa-cart-plus"></i></button></div>
                    </div>
                </div>
            </div>
            
            <a class="btn-back" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i>Kembali ke Dashboard</a>
        </section>
    </main>

    <!-- Product Modal -->
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
            <div class="modal-actions">
                <div class="cart-qty-control" id="cartQtyControl">
                    <button class="cart-qty-btn" id="cartMinus"><i class="fa-solid fa-minus"></i></button>
                    <span class="cart-qty-value" id="cartQtyValue">1</span>
                    <button class="cart-qty-btn" id="cartPlus"><i class="fa-solid fa-plus"></i></button>
                </div>
                <div style="display:flex; gap:10px; width:100%;">
                    <button class="btn-cart" id="cartButton"><i class="fa-solid fa-cart-plus"></i></button>
                    <a class="btn-buy" id="buyButton" href="#">Beli Sekarang</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const cartKey = 'sphinx_cart';
    const cartCountEl = document.getElementById('cartCount');
    const productModal = document.getElementById('productModal');
    const closeModal = document.getElementById('closeModal');
    const modalProductImage = document.getElementById('modalProductImage');
    const modalProductName = document.getElementById('modalProductName');
    const modalProductDesc = document.getElementById('modalProductDesc');
    const modalProductPrice = document.getElementById('modalProductPrice');
    const modalProductStock = document.getElementById('modalProductStock');
    const cartButton = document.getElementById('cartButton');
    const buyButton = document.getElementById('buyButton');
    const cartMinus = document.getElementById('cartMinus');
    const cartPlus = document.getElementById('cartPlus');
    const cartQtyValue = document.getElementById('cartQtyValue');

    let currentProduct = null;

    function loadCartCount() {
        const cart = JSON.parse(localStorage.getItem(cartKey) || '[]');
        const total = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
        if (cartCountEl) cartCountEl.innerText = total;
    }

    function openModal(card) {
        const name  = card.dataset.product || '';
        const price = card.dataset.price  || '-';
        const desc  = card.dataset.desc   || '';
        const stock = card.dataset.stock  || '-';
        const img   = card.querySelector('.product-image');

        currentProduct = { name, price, image: img ? img.src : '' };

        modalProductName.innerText  = name;
        modalProductDesc.innerText  = desc;
        modalProductPrice.innerText = price;
        modalProductStock.innerText = stock;
        modalProductImage.src = img ? img.src : '';
        modalProductImage.alt = name;
        cartQtyValue.innerText = 1;

        const encoded = encodeURIComponent(name);
        const encodedPrice = encodeURIComponent(price);
        buyButton.href = `beli.php?product=${encoded}&price=${encodedPrice}`;

        productModal.classList.add('active');
    }

    // open modal when clicking cart icon on card
    document.querySelectorAll('.btn-card-cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            openModal(this.closest('.product-card'));
        });
    });

    // also open modal when clicking anywhere on card
    document.querySelectorAll('.product-card').forEach(card => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', function(e) {
            if (e.target.closest('.btn-card-cart')) return;
            openModal(this);
        });
    });

    closeModal.addEventListener('click', () => productModal.classList.remove('active'));
    productModal.addEventListener('click', e => { if (e.target === productModal) productModal.classList.remove('active'); });

    cartMinus.addEventListener('click', () => {
        let v = parseInt(cartQtyValue.innerText) || 1;
        if (v > 1) cartQtyValue.innerText = v - 1;
    });
    cartPlus.addEventListener('click', () => {
        cartQtyValue.innerText = (parseInt(cartQtyValue.innerText) || 1) + 1;
    });

    cartButton.addEventListener('click', () => {
        if (!currentProduct) return;
        const qty = parseInt(cartQtyValue.innerText) || 1;
        let cart = JSON.parse(localStorage.getItem(cartKey) || '[]');
        const existing = cart.find(i => i.name === currentProduct.name);
        if (existing) existing.qty += qty;
        else cart.push({ name: currentProduct.name, price: currentProduct.price, image: currentProduct.image, qty });
        localStorage.setItem(cartKey, JSON.stringify(cart));
        loadCartCount();
        productModal.classList.remove('active');
    });

    buyButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (!this.href || this.href === '#') return;
        const qty = parseInt(cartQtyValue.innerText) || 1;
        const base = this.href.split('&qty=')[0];
        productModal.classList.remove('active');
        window.location.href = base + '&qty=' + qty;
    });

    loadCartCount();
</script>

