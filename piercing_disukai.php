<?php
$current_page = basename($_SERVER['PHP_SELF']);
$page_title = "Piercing Yang Disukai";
$page_heading = "Piercing Yang Disukai";
$page_description = "Lihat daftar piercing favorit pengguna dan tren yang sedang populer di kalangan pelanggan.";
include 'header.php';
?>
    <link rel="stylesheet" href="css/piercing_disukai.css">
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
            
            <div id="favoritesContainer">
                <!-- Favorites will be loaded here by JavaScript -->
            </div>
            
<<<<<<< HEAD
=======
            <!-- Popular Products Section -->
            <div class="popular-section">
                <h2>Produk Populer</h2>
                <div class="favorites-list">
                    <div class="favorite-card">
                        <div class="popularity-badge">
                            <i class="fa-solid fa-heart"></i> 45
                        </div>
                        <img src="gambar/cubic-zironia.jpg" alt="Cubic Zirconia">
                        <div class="favorite-card-name">Cubic Zirconia</div>
                        <div class="favorite-price">Rp 25.000</div>
                    </div>
                    <div class="favorite-card">
                        <div class="popularity-badge">
                            <i class="fa-solid fa-heart"></i> 38
                        </div>
                        <img src="gambar/titanium-earrings.jpg" alt="Titanium Earrings">
                        <div class="favorite-card-name">Titanium Earrings</div>
                        <div class="favorite-price">Rp 35.000</div>
                    </div>
                    <div class="favorite-card">
                        <div class="popularity-badge">
                            <i class="fa-solid fa-heart"></i> 32
                        </div>
                        <img src="gambar/spkie-ohrring.jpg" alt="Spike Ohrring">
                        <div class="favorite-card-name">Spike Ohrring</div>
                        <div class="favorite-price">Rp 28.000</div>
                    </div>
                    <div class="favorite-card">
                        <div class="popularity-badge">
                            <i class="fa-solid fa-heart"></i> 29
                        </div>
                        <img src="gambar/kyoto-series.jpg" alt="Kyoto Series">
                        <div class="favorite-card-name">Kyoto Series</div>
                        <div class="favorite-price">Rp 42.000</div>
                    </div>
                    <div class="favorite-card">
                        <div class="popularity-badge">
                            <i class="fa-solid fa-heart"></i> 27
                        </div>
                        <img src="gambar/ear-piercing-ball.jpg" alt="Ear Piercing Ball">
                        <div class="favorite-card-name">Ear Piercing Ball</div>
                        <div class="favorite-price">Rp 18.000</div>
                    </div>
                    <div class="favorite-card">
                        <div class="popularity-badge">
                            <i class="fa-solid fa-heart"></i> 24
                        </div>
                        <img src="gambar/barbell-earrings.jpg" alt="Barbell Earrings">
                        <div class="favorite-card-name">Barbell Earrings</div>
                        <div class="favorite-price">Rp 30.000</div>
                    </div>
                </div>
            </div>
            
>>>>>>> cee3210 (Update)
            <a class="btn-back" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i>Kembali ke Dashboard</a>
        </section>
    </main>
</div>

<script>
    const favoriteKey = 'piercing_favorites';
    const productImages = {
        'Cubic Zirconia': 'gambar/cubic-zironia.jpg',
        'Titanium Earrings': 'gambar/titanium-earrings.jpg',
        'Spike Ohrring': 'gambar/spkie-ohrring.jpg',
        'Kyoto Series': 'gambar/kyoto-series.jpg',
        'Ear Piercing Ball': 'gambar/ear-piercing-ball.jpg',
        'Barbell Earrings': 'gambar/barbell-earrings.jpg',
        'Tindik Bunga': 'gambar/Tindik-Bunga.png',
        'Anting Jepit': 'gambar/Anting-Jepit.png',
        'Barre de Surface': 'gambar/Barre-de-surface.png',
        'Circular Barbell': 'gambar/Circular-Barbell.png',
        'Dparis Model Bintang': 'gambar/Dparis-Model-Bintang.png',
        'Titanium Straight Barbel': 'gambar/Titanium-Straight-Barbel.png',
        'Piercing Nostril Em Aço': 'gambar/Piercing-Nostril-Em-Aço.png'
    };

    function loadFavorites() {
        const favorites = JSON.parse(localStorage.getItem(favoriteKey) || '[]');
        const container = document.getElementById('favoritesContainer');

        if (favorites.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <i class="fa-regular fa-heart"></i>
                    <h2>Belum Ada Favorit</h2>
                    <p>Klik ikon hati di Dashboard untuk menambahkan piercing ke favorit Anda.</p>
                </div>
            `;
            return;
        }

        let html = '<div class="favorites-list">';
        favorites.forEach(productName => {
            const imageSrc = productImages[productName] || 'placeholder.jpg';
            html += `
                <div class="favorite-card">
                    <button class="remove-btn" data-product="${productName}" title="Hapus dari favorit">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    <img src="${imageSrc}" alt="${productName}">
                    <div class="favorite-card-name">${productName}</div>
                </div>
            `;
        });
        html += '</div>';
        container.innerHTML = html;

        // Attach remove button listeners
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productName = this.dataset.product;
                let favorites = JSON.parse(localStorage.getItem(favoriteKey) || '[]');
                favorites = favorites.filter(name => name !== productName);
                localStorage.setItem(favoriteKey, JSON.stringify(favorites));
                loadFavorites(); // Reload display
            });
        });
    }

    // Load favorites saat halaman load
    window.addEventListener('DOMContentLoaded', loadFavorites);
</script>
</body>
</html>

