<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
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
    <link rel="stylesheet" href="../css-customer/header.css">
    <?php if (!empty($page_css)): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($page_css, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>
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
            <a href="maps.php" style="text-decoration:none; color:var(--text-soft); font-size:14px; display:flex; align-items:center; gap:6px; transition:.2s;" onmouseover="this.style.color='var(--lime)'" onmouseout="this.style.color='var(--text-soft)'"><i class="fa-solid fa-location-dot"></i> Maps</a>
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


