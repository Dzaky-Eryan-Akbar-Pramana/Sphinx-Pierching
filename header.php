<?php
session_start();
$username = isset($_SESSION['user']) ? $_SESSION['user'] : '@sphnx_piercing';
$is_logged_in = isset($_SESSION['user']);
$allowed_pages = ['Login.php', 'BuatAkun.php'];
if (!$is_logged_in && !in_array(basename($_SERVER['PHP_SELF']), $allowed_pages)) {
    header('Location: Login.php');
    exit;
}
// Provide a global sanitize_text helper if not already defined
if (!function_exists('sanitize_text')) {
    function sanitize_text($text) {
        return htmlspecialchars(trim((string)$text), ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sphinx Piercing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        :root {
            --bg-main: #2f0c58;
            --bg-card: #14062b;
            --text: #f4f4f4;
            --text-soft: #cdcdcd;
            --lime: #82ff5b;
            --accent: #a54ccf;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Poppins", sans-serif; background: #111; color: var(--text); }
        
        /* Fixed Cart Bar */
        .cart-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--bg-main);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            z-index: 100;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .cart-bar .logo { font-weight: 600; color: var(--lime); font-size: 18px; }
        .cart-icon { position: relative; cursor: pointer; font-size: 20px; color: var(--text-soft); margin-left: auto; }
        .cart-icon:hover { color: var(--lime); }
        .profile-wrap { position: relative; display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .profile-wrap .profile-name { font-weight: 700; color: var(--text); font-size: 14px; white-space: nowrap; }
        .profile-btn { background: rgba(255,255,255,0.08); border: none; color: var(--text-soft); width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; cursor: pointer; transition: .2s; flex-shrink: 0; }
        .profile-btn:hover { background: rgba(130,255,91,0.15); color: var(--lime); }
        .profile-dropdown {
            position: absolute; top: calc(100% + 10px); right: 0;
            background: var(--bg-card); border-radius: 12px; min-width: 180px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1);
            display: none; flex-direction: column; overflow: hidden; z-index: 200;
        }
        .profile-dropdown.active { display: flex; }
        .profile-dropdown a, .profile-dropdown button {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; background: none; border: none;
            color: var(--text-soft); font-size: 14px; font-family: inherit;
            text-decoration: none; cursor: pointer; transition: .2s; width: 100%; text-align: left;
        }
        .profile-dropdown a:hover, .profile-dropdown button:hover { background: rgba(255,255,255,0.07); color: var(--lime); }
        .cart-count {
            position: absolute; top: -6px; right: -6px;
            background: var(--lime); color: #111; border-radius: 50%;
            width: 20px; height: 20px; font-size: 12px; font-weight: 600;
            display: flex; align-items: center; justify-content: center;
        }
        .cart-dropdown {
            position: absolute; top: 50px; right: 20px;
            background: var(--bg-card); border-radius: 12px;
            min-width: 320px; max-width: 400px; max-height: 400px;
            overflow-y: auto; box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            display: none; border: 1px solid rgba(255,255,255,0.1);
        }
        .cart-dropdown.active { display: block; }
        .cart-item {
            display: flex; gap: 12px; padding: 16px; border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .cart-item img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; }
        .cart-item-info { flex: 1; }
        .cart-item-info strong { display: block; }
        .cart-item-price { color: var(--text-soft); font-size: 14px; }
        .cart-remove { background: none; border: none; color: var(--text-soft); font-size: 18px; cursor: pointer; }
        .cart-total { padding: 16px; border-top: 1px solid rgba(255,255,255,0.1); font-weight: 600; color: var(--lime); }
        .cart-empty { padding: 20px; text-align: center; color: var(--text-soft); }
        .btn-checkout { display: block; width: 100%; padding: 12px; background: var(--lime); color: #111; text-decoration: none; text-align: center; border-radius: 8px; margin-top: 8px; font-weight: 600; }
        
        /* Mobile Sidebar */
        .sidebar { transition: transform 0.3s ease; }
        .sidebar.hidden { transform: translateX(-100%); }
        .app.mobile-open .sidebar { transform: translateX(0); }
        
        /* Mobile Hamburger */
        .hamburger { display: none; flex-direction: column; gap: 4px; cursor: pointer; padding: 8px; }
        .hamburger span { width: 24px; height: 2px; background: var(--text-soft); transition: 0.3s; border-radius: 2px; }
        .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(6px, 6px); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(6px, -6px); }
        
        @media (max-width: 900px) {
            .hamburger { display: flex; }
            .cart-bar { padding: 12px; }
            .cart-dropdown { right: 10px; min-width: 280px; }
            .sidebar { position: fixed; z-index: 99; }
            body.mobile-open { overflow: hidden; }
        }
    </style>

</head>
<body>
    <header class="cart-bar">
        <div class="logo">Sphinx Piercing <i class="fas fa-gem"></i></div>
        <div class="hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </div>
        <div class="cart-icon" id="cartIcon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cartCount">0</span>
        </div>
        <?php if ($is_logged_in): ?>
            <div class="profile-wrap" id="profileWrap">
                <span class="profile-name"><?= htmlspecialchars($username) ?></span>
                <button class="profile-btn" id="profileBtn" aria-label="Profil">
                    <i class="fa-solid fa-user"></i>
                </button>
                <div class="profile-dropdown" id="profileDropdown">
                    <a href="pengaturan.php"><i class="fa-solid fa-gear"></i> Pengaturan Profil</a>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        <?php endif; ?>
<div class="cart-dropdown" id="cartDropdown">
            <div id="cartItems"></div>
            <div class="cart-total" id="cartTotal">Total: Rp 0</div>
            <button type="button" class="btn-checkout" id="checkoutBtn" style="display: none;">Checkout Keranjang</button>
        </div>
    </header>

    <script>
        // Profile dropdown toggle
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
                // tutup cart dropdown jika terbuka
                document.getElementById('cartDropdown')?.classList.remove('active');
            });
            document.addEventListener('click', function() {
                profileDropdown.classList.remove('active');
            });
            profileDropdown.addEventListener('click', function(e) { e.stopPropagation(); });
        }

        // Hamburger toggle (for sidebar pages)
        document.getElementById('hamburger')?.addEventListener('click', function() {
            this.classList.toggle('active');
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) sidebar.classList.toggle('hidden');
        });
        
        // Cart initialization handled in the shared sphinxCart script below
    </script>

<div class="main-content">

<script>
// Global cart helper available on all pages
window.sphinxCart = (function(){
    const KEY = 'sphinx_cart';
    function load(){
        try{ return JSON.parse(localStorage.getItem(KEY) || '[]'); }catch(e){ return []; }
    }
    function save(cart){ localStorage.setItem(KEY, JSON.stringify(cart || [])); }
    function totalAmount(cart){
        cart = cart || load();
        return cart.reduce((sum, it)=>{
            const price = parseInt(String(it.price||'').replace(/[^0-9]/g,'')) || 0;
            return sum + (price * (parseInt(it.qty||it.quantity||1,10)||1));
        },0);
    }
    function formatRupiah(v){ return 'Rp '+String(v).replace(/\B(?=(\d{3})+(?!\d))/g,'.'); }
    function updateCartBadge(){
        const el = document.getElementById('cartCount');
        if(!el) return;
        const cart = load();
        const totalItems = cart.reduce((s,i)=> s + (parseInt(i.qty||i.quantity||1,10)||1), 0);
        el.textContent = totalItems;
    }
    function renderDropdown(){
        const cart = load();
        const container = document.getElementById('cartItems');
        const totalEl = document.getElementById('cartTotal');
        const checkoutBtn = document.getElementById('checkoutBtn');
        if(!container || !totalEl) return;
        container.innerHTML = '';
        if(cart.length === 0){
            container.innerHTML = '<div class="cart-empty">Keranjang kosong</div>';
            totalEl.textContent = 'Total: Rp 0';
            if(checkoutBtn) checkoutBtn.style.display = 'none';
            return;
        }
        cart.forEach((it, idx)=>{
            const div = document.createElement('div'); div.className='cart-item';
            div.innerHTML = `
                <img src="${encodeURI(it.image||'')||''}" alt="">
                <div class="cart-item-info">
                    <strong>${(it.name||'Produk')}</strong>
                    <div class="cart-item-price">${it.qty||1} × ${it.price||'-'}</div>
                </div>
                <button class="cart-remove" data-idx="${idx}"><i class="fa-solid fa-trash"></i></button>
            `.trim();
            container.appendChild(div);
        });
        const total = totalAmount(cart);
        totalEl.textContent = 'Total: ' + formatRupiah(total);
        if (checkoutBtn) {
            checkoutBtn.style.display = 'block';
            // bind to checkoutFromCart so behavior is consistent
            try { checkoutBtn.onclick = checkoutFromCart; } catch(e) {}
        }
    }
    function addItem(item){
        const cart = load();
        const existing = cart.find(i=> i.name === item.name);
        if(existing){ existing.qty = (parseInt(existing.qty||1,10)||1) + (parseInt(item.qty||1,10)||1); }
        else cart.push(Object.assign({}, item));
        save(cart); updateCartBadge(); renderDropdown();
    }
    function removeItem(index){
        const cart = load(); if(index < 0 || index >= cart.length) return; cart.splice(index,1); save(cart); updateCartBadge(); renderDropdown();
    }
    function clear(){ save([]); updateCartBadge(); renderDropdown(); }
    function checkoutFromCart(){
        const cart = load();
        if(!cart || cart.length===0){ alert('Keranjang kosong'); return; }
        const encoded = encodeURIComponent(JSON.stringify(cart));
        // redirect to beli.php with cart param
        window.location.href = 'beli.php?cart=' + encoded;
    }
    // bind UI
    document.addEventListener('DOMContentLoaded', function(){
        updateCartBadge(); renderDropdown();
        const icon = document.getElementById('cartIcon');
        const dropdown = document.getElementById('cartDropdown');
        if(icon && dropdown){
            icon.addEventListener('click', function(e){ dropdown.classList.toggle('active'); });
            document.addEventListener('click', function(ev){ if(!icon.contains(ev.target) && !dropdown.contains(ev.target)) dropdown.classList.remove('active'); });
        }
        
        // Ensure checkout button always redirects to beli.php with cart JSON (same as product buy flow)
        const checkoutBtnEl = document.getElementById('checkoutBtn');
        if (checkoutBtnEl) {
            checkoutBtnEl.addEventListener('click', function(ev){
                ev.preventDefault();
                const cart = load();
                if (!cart || cart.length === 0){ alert('Keranjang kosong'); return; }
                try {
                    const encoded = encodeURIComponent(JSON.stringify(cart));
                    // close dropdown then redirect
                    const dropdownEl = document.getElementById('cartDropdown');
                    if (dropdownEl) dropdownEl.classList.remove('active');
                    window.location.href = 'beli.php?cart=' + encoded;
                } catch (e) {
                    window.location.href = 'beli.php';
                }
            });
        }

        document.getElementById('cartItems')?.addEventListener('click', function(ev){
            const btn = ev.target.closest('.cart-remove'); if(!btn) return; const idx = parseInt(btn.dataset.idx,10); removeItem(idx);
        });
    });
    return { load, save, addItem, removeItem, clear, updateCartBadge, renderDropdown, checkoutFromCart, totalAmount };
})();
</script>


