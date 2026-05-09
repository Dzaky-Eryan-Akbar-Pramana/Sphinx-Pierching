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
    <title>Customer - ADMIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
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
            <li>
                <a href="Dashboard-admin.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="active">
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
                <h1>Customer</h1>
                <span class="breadcrumb">Dashboard &rsaquo; Customer</span>
            </div>
            <div class="topbar-icons">
                <button class="icon-btn" title="Notifikasi"><i class="fa-regular fa-bell"></i></button>
                <button class="icon-btn" title="Profil"><i class="fa-regular fa-user"></i></button>
            </div>
        </div>

        <!-- Banner -->
        <div class="admin-banner">
            <span>Data Customer</span>
        </div>

        <!-- Filter Section -->
        <div class="customer-filter-bar">
            <div class="filter-group">
                <label>Cari Nama Customer</label>
                <div class="filter-input-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchNama" placeholder="Cari Nama..." oninput="filterTable()">
                </div>
            </div>
            <div class="filter-group">
                <label>Filter Pesanan</label>
                <select id="filterPesanan" onchange="filterTable()">
                    <option value="">Semua Pesanan</option>
                    <option value="Piercing Servis">Piercing Servis</option>
                    <option value="Aftercare Kit">Aftercare Kit</option>
                    <option value="Aksesoris">Aksesoris</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Filter Layanan</label>
                <select id="filterLayanan" onchange="filterTable()">
                    <option value="">Semua Layanan</option>
                    <option value="AKTIF">Aktif</option>
                    <option value="MEMBER">Member</option>
                </select>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="customer-table-wrap">
            <table class="customer-table" id="customerTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Whatsapp</th>
                        <th>Layanan Terakhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>101</td>
                        <td>Nayaka Bagus</td>
                        <td>085119124857</td>
                        <td>Piercing Servis</td>
                        <td><span class="status-badge member">MEMBER</span></td>
                        <td><a href="DetailCustomer-admin.php?id=101" class="btn-detail">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Rahardian</td>
                        <td>085119124857</td>
                        <td>Aftercare Kit</td>
                        <td><span class="status-badge aktif">AKTIF</span></td>
                        <td><a href="DetailCustomer-admin.php?id=102" class="btn-detail">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>103</td>
                        <td>Tisa nin</td>
                        <td>085119124857</td>
                        <td>Piercing Servis</td>
                        <td><span class="status-badge aktif">AKTIF</span></td>
                        <td><a href="DetailCustomer-admin.php?id=103" class="btn-detail">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>104</td>
                        <td>Nina aja</td>
                        <td>085119124857</td>
                        <td>Aftercare Kit</td>
                        <td><span class="status-badge member">MEMBER</span></td>
                        <td><a href="DetailCustomer-admin.php?id=104" class="btn-detail">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>105</td>
                        <td>Maulida</td>
                        <td>085119124857</td>
                        <td>Piercing Servis</td>
                        <td><span class="status-badge member">MEMBER</span></td>
                        <td><a href="DetailCustomer-admin.php?id=105" class="btn-detail">Lihat Detail</a></td>
                    </tr>
                    <tr>
                        <td>106</td>
                        <td>Maulida</td>
                        <td>085119124857</td>
                        <td>Piercing Servis</td>
                        <td><span class="status-badge member">MEMBER</span></td>
                        <td><a href="DetailCustomer-admin.php?id=106" class="btn-detail">Lihat Detail</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
</div>

<script>
function filterTable() {
    const nama     = document.getElementById('searchNama').value.toLowerCase();
    const pesanan  = document.getElementById('filterPesanan').value.toLowerCase();
    const layanan  = document.getElementById('filterLayanan').value.toLowerCase();
    const rows     = document.querySelectorAll('#customerTable tbody tr');

    rows.forEach(row => {
        const namaTd    = row.cells[1].textContent.toLowerCase();
        const pesananTd = row.cells[3].textContent.toLowerCase();
        const layananTd = row.cells[4].textContent.toLowerCase();

        const matchNama    = namaTd.includes(nama);
        const matchPesanan = pesanan === '' || pesananTd.includes(pesanan);
        const matchLayanan = layanan === '' || layananTd.includes(layanan);

        row.style.display = (matchNama && matchPesanan && matchLayanan) ? '' : 'none';
    });
}
</script>

</body>
</html>
