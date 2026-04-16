<?php
$username = "@sphnx_piercing";
$current_page = basename($_SERVER['PHP_SELF']);
$page_title = "Piercing Yang Disukai";
$page_heading = "Piercing Yang Disukai";
$page_description = "Lihat daftar piercing favorit pengguna dan tren yang sedang populer di kalangan pelanggan.";
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
        :root{
            --bg-main:#2f0c58;
            --bg-main-dark:#20103a;
            --bg-sidebar:#240744;
            --bg-card:#14062b;
            --accent:#a54ccf;
            --text:#f4f4f4;
            --text-soft:#cdcdcd;
            --lime:#82ff5b;
        }
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:"Poppins",sans-serif; background:#111; color:var(--text);}
        .app{display:flex; min-height:100vh; background:var(--bg-main);}
        .sidebar{width:210px; background:var(--bg-sidebar); padding:18px 16px; display:flex; flex-direction:column; align-items:center; border-right:1px solid rgba(0,0,0,.4); position:fixed; left:0; top:0; bottom:0; height:100vh; z-index:60;}
        .brand{text-align:center; margin-bottom:32px;}
        .brand img{width:90px;height:90px; border-radius:50%; border:3px solid var(--accent); object-fit:cover;}
        .brand span{display:block; margin-top:8px; font-size:13px;}
        .menu{width:100%; list-style:none; flex:1;}
        .menu li{margin-bottom:14px;}
        .menu a{display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:999px; font-size:13px; text-decoration:none; color:var(--text-soft); transition:.2s;}
        .menu a i{width:20px; text-align:center;}
        .menu a:hover, .menu a.active{background:var(--bg-main-dark); color:var(--lime);}
        .sidebar-footer{width:100%; margin-top:auto; padding-top:12px; border-top:1px solid rgba(255,255,255,.08);}
        .main{flex:1; padding:20px 28px; background:var(--bg-main); display:flex; flex-direction:column; margin-left:210px;}
        .topbar{display:flex; align-items:center; gap:20px; margin-bottom:24px;}
        .top-icons{display:flex; align-items:center; gap:16px; font-size:18px;}
        .feature-page{background:var(--bg-card); border-radius:16px; padding:32px; width:100%;}
        .feature-page h1{font-size:32px; color:var(--lime); margin-bottom:18px;}
        .feature-page p{color:var(--text-soft); line-height:1.8; margin-bottom:24px;}
        
        .favorites-list{display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:20px; margin:30px 0;}
        .favorite-card{background:var(--bg-main-dark); border-radius:14px; overflow:hidden; transition:.3s; position:relative;}
        .favorite-card:hover{transform:translateY(-5px); box-shadow:0 8px 24px rgba(130,255,91,0.1);}
        .favorite-card img{width:100%; aspect-ratio:1/1; object-fit:cover; display:block;}
        .favorite-card-name{padding:12px; color:var(--text-soft); font-size:14px; text-align:center;}
        .remove-btn{position:absolute; top:8px; right:8px; background:rgba(0,0,0,0.6); border:none; cursor:pointer; width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; transition:.2s;}
        .remove-btn:hover{background:rgba(255,59,48,0.8);}
        .remove-btn i{color:var(--text-soft); font-size:16px;}
        
        .empty-state{text-align:center; padding:60px 20px; color:var(--text-soft);}
        .empty-state i{font-size:64px; color:var(--lime); margin-bottom:20px; opacity:0.5;}
        
        .btn-back{display:inline-flex; align-items:center; gap:8px; margin-top:30px; padding:10px 18px; border-radius:10px; background:var(--accent); color:var(--text); text-decoration:none; font-weight:600;}
        .btn-back:hover{background:var(--lime); color:#111;}
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

            .favorites-list {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
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
            </div>
        </div>
        <section class="feature-page">
            <h1><?= htmlspecialchars($page_heading) ?></h1>
            <p><?= htmlspecialchars($page_description) ?></p>
            
            <div id="favoritesContainer">
                <!-- Favorites will be loaded here by JavaScript -->
            </div>
            
            <a class="btn-back" href="dashboard.php"><i class="fa-solid fa-arrow-left"></i>Kembali ke Dashboard</a>
        </section>
    </main>
</div>

<script>
    const favoriteKey = 'piercing_favorites';
    const productImages = {
        'Cubic Zirconia': 'cubic-zironia.jpg',
        'Titanium Earrings': 'titanium-earrings.jpg',
        'Spike Ohrring': 'spkie-ohrring.jpg',
        'Kyoto Series': 'kyoto-series.jpg',
        'Ear Piercing Ball': 'ear-piercing-ball.jpg',
        'Barbell Earrings': 'barbell-earrings.jpg',
        'Tindik Bunga': 'Tindik-Bunga.png',
        'Anting Jepit': 'Anting-Jepit.png',
        'Barre de Surface': 'Barre-de-surface.png',
        'Circular Barbell': 'Circular-Barbell.png',
        'Dparis Model Bintang': 'Dparis-Model-Bintang.png',
        'Titanium Straight Barbel': 'Titanium-Straight-Barbel.png',
        'Piercing Nostril Em Aço': 'Piercing-Nostril-Em-Aço.png'
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

