﻿<?php 
$page_css = '../css-customer/Dashboard.css';
include 'header.php'; 

$username = "@sphnx_piercing";
$promo_title = "Promo Piercing";
$promo_sub = "Diskon 20%";

$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <img src="../gambar/logo2.jpeg" alt="Logo">
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

    <main class="main">
        <!-- Search Bar -->
        <div class="search-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Cari produk piercing... (contoh: titanium, barbell)">
            <button class="search-clear" id="searchClear"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <p class="search-results-label" id="searchLabel">Menampilkan <span id="searchCount">0</span> hasil untuk "<span id="searchQuery"></span>"</p>

        <!-- Iklan Produk Slideshow -->
        <div class="ad-slideshow" id="adSlideshow">

            <div class="ad-slide active">
                <div class="ad-slide-img"><img src="../gambar/cubic-zironia.jpg" alt="Cubic Zirconia"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge">Terlaris</span>
                    <div class="ad-slide-name">Cubic Zirconia</div>
                    <div class="ad-slide-desc">Desain klasik dengan batu cubic zirconia berkilau, cocok untuk tampilan elegan pada berbagai jenis piercing.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">Diameter 6mm</span>
                        <span class="ad-size-tag">Diameter 8mm</span>
                        <span class="ad-size-tag">Diameter 10mm</span>
                        <span class="ad-size-tag">18G / 16G</span>
                    </div>
                    <div class="ad-slide-price">Rp 30.000</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/titanium-earrings.jpg" alt="Titanium Earrings"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge">Hypoallergenic</span>
                    <div class="ad-slide-name">Titanium Earrings</div>
                    <div class="ad-slide-desc">Anting titanium ringan dan tahan karat, ideal untuk kulit sensitif dan pemakaian sehari-hari tanpa iritasi.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">Panjang 6mm</span>
                        <span class="ad-size-tag">Panjang 8mm</span>
                        <span class="ad-size-tag">Panjang 10mm</span>
                        <span class="ad-size-tag">16G / 18G</span>
                    </div>
                    <div class="ad-slide-price">Rp 50.000</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/kyoto-series.jpg" alt="Kyoto Series"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge">Edisi Khusus</span>
                    <div class="ad-slide-name">Kyoto Series</div>
                    <div class="ad-slide-desc">Koleksi bertema Jepang yang minimalis dan modern, menghadirkan nuansa estetika elegan dan unik.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">Diameter 8mm</span>
                        <span class="ad-size-tag">Diameter 10mm</span>
                        <span class="ad-size-tag">14G / 16G</span>
                    </div>
                    <div class="ad-slide-price">Rp 40.000</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/Circular-Barbell.png" alt="Circular Barbell"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge">Populer</span>
                    <div class="ad-slide-name">Circular Barbell</div>
                    <div class="ad-slide-desc">Piercing berbentuk lingkaran dengan bola pada kedua ujungnya, memberikan gaya klasik yang nyaman dipakai.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">Diameter 10mm</span>
                        <span class="ad-size-tag">Diameter 12mm</span>
                        <span class="ad-size-tag">14G / 16G</span>
                    </div>
                    <div class="ad-slide-price">Rp 55.000</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/spkie-ohrring.jpg" alt="Spike Ohrring"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge">Eksklusif</span>
                    <div class="ad-slide-name">Spike Ohrring</div>
                    <div class="ad-slide-desc">Desain spike tajam dan elegan, cocok untuk septum, telinga, atau berbagai pilihan piercing lainnya.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">Panjang 8mm</span>
                        <span class="ad-size-tag">Panjang 10mm</span>
                        <span class="ad-size-tag">14G</span>
                    </div>
                    <div class="ad-slide-price">Rp 55.000</div>
                </div>
            </div>

            <!-- Alternatif Piercing -->
            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/Contoh-Alis.png" alt="Piercing Alis"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge" style="background:#a54ccf;color:#fff;">Alternatif</span>
                    <div class="ad-slide-name">Piercing Alis</div>
                    <div class="ad-slide-desc">Piercing alis dengan bentuk rapi dan posisi estetis, cocok untuk memberi aksen wajah yang tajam dan modern.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">16G / 18G</span>
                        <span class="ad-size-tag">Panjang 8mm</span>
                        <span class="ad-size-tag">Panjang 10mm</span>
                    </div>
                    <div class="ad-slide-price">Jasa Tindik</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/Contoh-Bibir.png" alt="Piercing Bibir"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge" style="background:#a54ccf;color:#fff;">Alternatif</span>
                    <div class="ad-slide-name">Piercing Bibir</div>
                    <div class="ad-slide-desc">Piercing bibir yang stylish untuk model labret atau monroe, dengan teknik steril dan hasil simetris.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">16G / 18G</span>
                        <span class="ad-size-tag">Labret</span>
                        <span class="ad-size-tag">Monroe</span>
                    </div>
                    <div class="ad-slide-price">Jasa Tindik</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/Contoh-Hidung.png" alt="Piercing Hidung"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge" style="background:#a54ccf;color:#fff;">Alternatif</span>
                    <div class="ad-slide-name">Piercing Hidung</div>
                    <div class="ad-slide-desc">Piercing hidung untuk model nose stud atau hoop, menggunakan bahan steril agar hasilnya rapi dan nyaman dipakai.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">20G / 18G</span>
                        <span class="ad-size-tag">Nose Stud</span>
                        <span class="ad-size-tag">Hoop</span>
                    </div>
                    <div class="ad-slide-price">Jasa Tindik</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/Contoh-Telinga.jpeg" alt="Piercing Telinga"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge" style="background:#a54ccf;color:#fff;">Alternatif</span>
                    <div class="ad-slide-name">Piercing Telinga</div>
                    <div class="ad-slide-desc">Piercing telinga profesional untuk berbagai model seperti helix, tragus, dan daith, dengan hasil aman dan estetis.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">16G / 18G</span>
                        <span class="ad-size-tag">Helix</span>
                        <span class="ad-size-tag">Tragus</span>
                        <span class="ad-size-tag">Daith</span>
                    </div>
                    <div class="ad-slide-price">Jasa Tindik</div>
                </div>
            </div>

            <div class="ad-slide">
                <div class="ad-slide-img"><img src="../gambar/Contoh-Lidah.png" alt="Piercing Lidah"></div>
                <div class="ad-slide-info">
                    <span class="ad-slide-badge" style="background:#a54ccf;color:#fff;">Alternatif</span>
                    <div class="ad-slide-name">Piercing Lidah</div>
                    <div class="ad-slide-desc">Piercing lidah aman dan nyaman, direkomendasikan untuk gaya yang berani dengan perawatan aftercare yang lengkap.</div>
                    <div class="ad-slide-sizes">
                        <span class="ad-size-tag">14G</span>
                        <span class="ad-size-tag">Barbell 16mm</span>
                        <span class="ad-size-tag">Titanium</span>
                    </div>
                    <div class="ad-slide-price">Jasa Tindik</div>
                </div>
            </div>

            <div class="ad-dots" id="adDots"></div>
        </div>

        <section class="features">
            <a class="feature-item" href="piercing_produk.php">
                <div class="feature-icon"><i class="fa-solid fa-gem"></i></div>
                <span>Piercing Produk</span>
            </a>
            <a class="feature-item" href="jasa_piercing.php">
                <div class="feature-icon"><i class="fa-regular fa-gem"></i></div>
                <span>Jasa Piercing</span>
            </a>
            <a class="feature-item" href="alternatif_piercing.php">
                <div class="feature-icon"><i class="fa-solid fa-ring"></i></div>
                <span>Katalog Piercing</span>
            </a>
            <a class="feature-item" href="piercing_disukai.php">
                <div class="feature-icon"><i class="fa-regular fa-heart"></i></div>
                <span>Piercing Yang Disukai</span>
            </a>
        </section>

        <section class="product-images">
            <div class="product-item" data-product="Cubic Zirconia" data-desc="Desain klasik dengan batu cubic zirconia yang berkilau, cocok untuk tampilan elegan pada berbagai jenis piercing." data-price="Rp 30.000" data-stock="12">
                <button class="product-love-btn" data-product="Cubic Zirconia"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/cubic-zironia.jpg" alt="Product 1">
                <span>Cubic Zirconia</span>
            </div>
            <div class="product-item" data-product="Titanium Earrings" data-desc="Anting titanium ringan dan tahan karat, ideal untuk kulit sensitif dan pemakaian sehari-hari." data-price="Rp 50.000" data-stock="8">
                <button class="product-love-btn" data-product="Titanium Earrings"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/titanium-earrings.jpg" alt="Product 2">
                <span>Titanium Earrings</span>
            </div>
            <div class="product-item" data-product="Spike Ohrring" data-desc="Piercing dengan desain spike yang tajam dan elegan. Cocok untuk septum, telinga, atau alternatif piercing lainnya." data-price="Rp 55.000" data-stock="10">
                <button class="product-love-btn" data-product="Spike Ohrring"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/spkie-ohrring.jpg" alt="Product 3">
                <span>Spike Ohrring</span>
            </div>
            <div class="product-item" data-product="Kyoto Series" data-desc="Koleksi piercing bertema Jepang yang minimalis dan modern, memberikan nuansa estetika elegan." data-price="Rp 40.000" data-stock="7">
                <button class="product-love-btn" data-product="Kyoto Series"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/kyoto-series.jpg" alt="Product 4">
                <span>Kyoto Series</span>
            </div>
            <div class="product-item" data-product="Ear Piercing Ball" data-desc="Piercing bentuk bola yang halus, cocok untuk berbagai variasi anting dan piercing telinga." data-price="Rp 45.000" data-stock="15">
                <button class="product-love-btn" data-product="Ear Piercing Ball"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/ear-piercing-ball.jpg" alt="Product 5">
                <span>Ear Piercing Ball</span>
            </div>
            <div class="product-item" data-product="Barbell Earrings" data-desc="Anting barbell dengan desain kuat dan trendi untuk gaya piercing yang berani." data-price="Rp 35.000" data-stock="9">
                <button class="product-love-btn" data-product="Barbell Earrings"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/barbell-earrings.jpg" alt="Product 6">
                <span>Barbell Earrings</span>
            </div>
            <div class="product-item" data-product="Tindik Bunga" data-desc="Piercing motif bunga yang feminin dan manis, cocok untuk tampilan lembut." data-price="Rp 50.000" data-stock="6">
                <button class="product-love-btn" data-product="Tindik Bunga"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Tindik-Bunga.png" alt="Product 7">
                <span>Tindik Bunga</span>
            </div>
            <div class="product-item" data-product="Anting Jepit" data-desc="Anting jepit praktis tanpa tindik, ideal untuk yang ingin tampil stylish tanpa komitmen permanen." data-price="Rp 35.000" data-stock="18">
                <button class="product-love-btn" data-product="Anting Jepit"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Anting-Jepit.png" alt="Product 8">
                <span>Anting Jepit</span>
            </div>
            <div class="product-item" data-product="Barre de Surface" data-desc="Piercing surface bar yang modern dan minimalis untuk area dada atau punggung." data-price="Rp 30.000" data-stock="5">
                <button class="product-love-btn" data-product="Barre de Surface"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Barre-de-surface.png" alt="Product 9">
                <span>Barre de Surface</span>
            </div>
            <div class="product-item" data-product="Circular Barbell" data-desc="Piercing berbentuk lingkaran dengan bola pada kedua ujungnya untuk gaya klasik yang nyaman." data-price="Rp 55.000" data-stock="11">
                <button class="product-love-btn" data-product="Circular Barbell"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Circular-Barbell.png" alt="Product 10">
                <span>Circular Barbell</span>
            </div>
            <div class="product-item" data-product="Dparis Model Bintang" data-desc="Desain unik dengan motif bintang yang menawan, cocok untuk tampilan berani dan ekspresif." data-price="Rp 35.000" data-stock="4">
                <button class="product-love-btn" data-product="Dparis Model Bintang"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Dparis-Model-Bintang.png" alt="Product 11">
                <span>Dparis Model Bintang</span>
            </div>
            <div class="product-item" data-product="Titanium Straight Barbel" data-desc="Barbel lurus titanium hypoallergenic, sempurna untuk piercing bridge atau septum." data-price="Rp 40.000" data-stock="8">
                <button class="product-love-btn" data-product="Titanium Straight Barbel"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Titanium-Straight-Barbel.png" alt="Product 12">
                <span>Titanium Straight Barbel</span>
            </div>
            <div class="product-item" data-product="Piercing Nostril Em Aço" data-desc="Piercing nostril berkualitas steel dengan desain geometri dan finish premium." data-price="Rp 35.000" data-stock="7">
                <button class="product-love-btn" data-product="Piercing Nostril Em Aço"><i class="fa-regular fa-heart"></i></button>
                <img src="../gambar/Piercing-Nostril-Em-Aço.png" alt="Product 13">
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
    // --- SEARCH PRODUK ---
    const searchInput = document.getElementById('searchInput');
    const searchClear = document.getElementById('searchClear');
    const searchLabel = document.getElementById('searchLabel');
    const searchCountEl = document.getElementById('searchCount');
    const searchQueryEl = document.getElementById('searchQuery');
    const allProductItems = document.querySelectorAll('.product-item');
    const adSlideshow = document.getElementById('adSlideshow');

    searchInput.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        searchClear.style.display = q ? 'block' : 'none';

        if (q === '') {
            allProductItems.forEach(item => item.style.display = '');
            adSlideshow.style.display = '';
            searchLabel.style.display = 'none';
            return;
        }

        // Sembunyikan slideshow saat searching
        adSlideshow.style.display = 'none';

        let count = 0;
        allProductItems.forEach(item => {
            const name = (item.dataset.product || '').toLowerCase();
            const desc = (item.dataset.desc || '').toLowerCase();
            const match = name.includes(q) || desc.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) count++;
        });

        searchCountEl.textContent = count;
        searchQueryEl.textContent = this.value.trim();
        searchLabel.style.display = 'block';
    });

    searchClear.addEventListener('click', function () {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });

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
        favorites.forEach(fav => {
            const productName = typeof fav === 'string' ? fav : fav.name;
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
            const productItem = this.closest('.product-item');
            const img = productItem ? productItem.querySelector('img') : null;
            const price = productItem ? (productItem.dataset.price || '') : '';
            let favorites = JSON.parse(localStorage.getItem(favoriteKey) || '[]');

            if (this.classList.contains('active')) {
                favorites = favorites.filter(f => (typeof f === 'string' ? f : f.name) !== productName);
                this.classList.remove('active');
                this.innerHTML = '<i class="fa-regular fa-heart"></i>';
            } else {
                if (!favorites.find(f => (typeof f === 'string' ? f : f.name) === productName)) {
                    favorites.push({ name: productName, image: img ? img.src : '', price: price });
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

        // --- AD SLIDESHOW ---
        const slides = document.querySelectorAll('#adSlideshow .ad-slide');
        const dotsContainer = document.getElementById('adDots');
        let currentSlide = 0;

        slides.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.className = 'ad-dot' + (i === 0 ? ' active' : '');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        });

        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            dotsContainer.children[currentSlide].classList.remove('active');
            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dotsContainer.children[currentSlide].classList.add('active');
        }

        setInterval(() => goToSlide(currentSlide + 1), 5000);
    });
</script>

<!-- Customer Service Floating Button -->
<div class="cs-wrap">
    <div class="cs-popup" id="csPopup">
        <div class="cs-popup-header">
            <i class="fa-solid fa-headset"></i>
            <span>Customer Service</span>
        </div>
        <a href="https://wa.me/6281994799058" class="cs-item" target="_blank">
            <div class="cs-item-icon cs-wa"><i class="fa-brands fa-whatsapp"></i></div>
            <div class="cs-item-info">
                <strong>WhatsApp</strong>
                <span>081994799058</span>
            </div>
        </a>
        <a href="https://www.instagram.com/sphinx_piercingjogja" class="cs-item" target="_blank">
            <div class="cs-item-icon cs-ig"><i class="fa-brands fa-instagram"></i></div>
            <div class="cs-item-info">
                <strong>Instagram</strong>
                <span>@sphinx_piercingjogja</span>
            </div>
        </a>
    </div>
    <button class="cs-btn" id="csBtn" title="Customer Service">
        <i class="fa-solid fa-headset"></i>
    </button>
</div>

<script>
    // CS Popup toggle
    document.getElementById('csBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('csPopup').classList.toggle('active');
    });
    document.addEventListener('click', function() {
        document.getElementById('csPopup').classList.remove('active');
    });
    document.getElementById('csPopup').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>

</body>
</html>
