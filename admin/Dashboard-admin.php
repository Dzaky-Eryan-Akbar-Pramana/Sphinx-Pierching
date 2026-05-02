<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: ../php-customer/Login.php');
    exit;
}
$admin_name = 'Admin';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ADMIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="admin-wrapper">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-logo">
            <img src="../gambar/logo2.jpeg" alt="Logo">
            <span>@sphinx_piercing</span>
        </div>

        <ul class="sidebar-menu">
            <li class="active">
                <a href="Dashboard-admin.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="Customer-admin.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Customer</span>
                </a>
            </li>
            <li>
                <a href="Produk-admin.php">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="KelolaJadwal-admin.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Kelola Jadwal</span>
                </a>
            </li>
            <li>
                <a href="KelolaPesanan-admin.php">
                    <i class="fa-solid fa-cube"></i>
                    <span>Kelola Pesanan</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <a href="#" class="sidebar-bantuan">
                <i class="fa-solid fa-circle-question"></i>
                <span>Bantuan</span>
            </a>
            <a href="logout-admin.php" class="sidebar-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">

        <!-- Top Bar -->
        <div class="admin-topbar">
            <div class="topbar-title">
                <h1>Admin Dasboard</h1>
                <span class="breadcrumb">Dasboard</span>
            </div>
            <div class="topbar-icons">
                <button class="icon-btn" title="Notifikasi"><i class="fa-regular fa-bell"></i></button>
                <button class="icon-btn" title="Profil"><i class="fa-regular fa-user"></i></button>
            </div>
        </div>

        <!-- Banner -->
        <div class="admin-banner">
            <a href="Dashboard-admin.php">Admin Dasboard</a>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Total Customer</span>
                    <span class="stat-value">100</span>
                    <span class="stat-sub positive">+5.2% (Bulan Ini)</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fa-solid fa-money-bill-wave"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Pendapatan Bulan Ini</span>
                    <span class="stat-value">Rp 2.500.00</span>
                    <span class="stat-sub positive">+5% (Harian)</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Jadwal Menunggu Verifikasi</span>
                    <span class="stat-value">8</span>
                    <span class="stat-sub warning">Membutuhkan Tindakan</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <div class="stat-info">
                    <span class="stat-label">Stok Produk Rendah</span>
                    <span class="stat-value">5 Produk</span>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="admin-bottom">

            <!-- Chart -->
            <div class="chart-box">
                <div class="chart-title">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Pendapata Mingguan (Rp Juta)</span>
                </div>
                <canvas id="weeklyChart"></canvas>
                <div class="chart-summary">
                    <span>Tertinggi : Jumat<br>Rp 9.1 Jt</span>
                    <span>Rata-Rata :<br>Rp 6.9 Jt</span>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="orders-box">
                <div class="orders-title">
                    <i class="fa-solid fa-clipboard-list"></i>
                    ORDER TERBARU
                </div>
                <div class="order-list">
                    <div class="order-item">
                        <span class="order-id">#4091</span>
                        <div class="order-info">
                            <strong>Reza Firmansyah</strong>
                            <small>Nouse Ring Titanium</small>
                        </div>
                        <span class="badge lunas">Lunas</span>
                        <span class="order-price">Rp 185 k</span>
                    </div>
                    <div class="order-item">
                        <span class="order-id">#4091</span>
                        <div class="order-info">
                            <strong>Reza Firmansyah</strong>
                            <small>Nouse Ring Titanium</small>
                        </div>
                        <span class="badge proses">Proses</span>
                        <span class="order-price">Rp 185 k</span>
                    </div>
                    <div class="order-item">
                        <span class="order-id">#4091</span>
                        <div class="order-info">
                            <strong>Reza Firmansyah</strong>
                            <small>Nouse Ring Titanium</small>
                        </div>
                        <span class="badge batal">Batal</span>
                        <span class="order-price">Rp 185 k</span>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            datasets: [{
                data: [60, 65, 50, 30, 91, 25],
                backgroundColor: ['#4a9eff', '#4a9eff', '#5bc8ff', '#3a7aff', '#7bddff', '#4a9eff'],
                borderRadius: 5,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 80,
                    ticks: { color: '#9a9ab0', stepSize: 20, font: { family: 'Poppins', size: 11 } },
                    grid: { color: 'rgba(255,255,255,0.05)' }
                },
                x: {
                    ticks: { color: '#9a9ab0', font: { family: 'Poppins', size: 11 } },
                    grid: { display: false }
                }
            }
        }
    });
</script>

</body>
</html>
