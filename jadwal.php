<?php
$username = "@sphnx_piercing";
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Reservasi - Sphnx Piercing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <style>
        /* --- CSS DASAR (SAMA SEPERTI DASHBOARD) --- */
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
            --red-soft: #ff5b5b;
        }
        *{margin:0;padding:0;box-sizing:border-box;}

        body{
            font-family:"Poppins",sans-serif;
            background:#111;
            color:var(--text);
        }
        .app{ display:flex; min-height:100vh; background:var(--bg-main); }
        
        /* SIDEBAR STYLE */
        .sidebar{
            width:210px; background:var(--bg-sidebar); padding:18px 16px;
            display:flex; flex-direction:column; align-items:center;
            border-right:1px solid rgba(0,0,0,.4);
            position:fixed; left:0; top:0; bottom:0; height:100vh; z-index:60;
        }
        .brand{ text-align:center; margin-bottom:32px; }
        .brand img{ width:90px;height:90px; border-radius:50%; border:3px solid var(--accent); object-fit:cover; }
        .brand span{ display:block; margin-top:8px; font-size:13px; }
        .menu{ width:100%; list-style:none; flex:1; }
        .menu li{ margin-bottom:14px; }
        .menu a{
            display:flex; align-items:center; gap:10px; padding:10px 12px;
            border-radius:999px; font-size:13px; text-decoration:none;
            color:var(--text-soft); transition:.2s;
        }
        .menu a i{ width:20px; text-align:center; }
        .menu a:hover, .menu a.active{ background:var(--bg-main-dark); color:var(--lime); }
        .sidebar-footer{ width:100%; margin-top:auto; padding-top:12px; border-top:1px solid rgba(255,255,255,.08); }

        /* MAIN CONTENT STYLE */
        .main{
            flex:1; padding:20px 28px; background:var(--bg-main);
            display:flex; flex-direction:column; margin-left:210px;
        }
        .topbar{ display:flex; align-items:center; gap:20px; margin-bottom:24px; }
        .search-box{
            flex:1; background:var(--accent); padding:10px 16px;
            border-radius:999px; display:flex; align-items:center; gap:10px;
        }
        .search-box input{ flex:1; border:none; outline:none; background:transparent; color:var(--text); font-size:14px; }
        .search-box input::placeholder{ color:#f6f6f6; opacity:0.8; }
        .top-icons{ display:flex; align-items:center; gap:16px; font-size:18px; }

        /* --- CSS KHUSUS HALAMAN JADWAL --- */
        .schedule-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr; 
            gap: 25px;
        }

        .form-box {
            background: var(--bg-card);
            padding: 25px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .form-box h2 { font-size: 20px; margin-bottom: 20px; color: var(--lime); }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; color: var(--text-soft); margin-bottom: 8px; }
        
        .form-control {
            width: 100%;
            padding: 12px;
            background: var(--bg-main-dark);
            border: 1px solid var(--accent);
            border-radius: 8px;
            color: white;
            font-family: inherit;
        }
        .form-control:focus { outline: 2px solid var(--lime); border-color: transparent; }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--lime);
            color: var(--bg-main-dark);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-submit:hover { background: #6fe04a; }

        .schedule-list h2 { font-size: 20px; margin-bottom: 20px; color: var(--text); }
        
        .appointment-card {
            background: var(--bg-card);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--lime);
            transition: transform 0.2s, opacity 0.3s ease-out;
            animation: fadeIn 0.4s ease-out; /* Efek muncul */
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .appointment-card:hover { transform: translateX(5px); background: var(--bg-main-dark); }
        
        .date-box {
            background: var(--bg-main);
            padding: 10px 15px;
            border-radius: 8px;
            text-align: center;
            min-width: 80px;
        }
        .date-box .day { font-size: 24px; font-weight: bold; color: var(--lime); display: block; line-height: 1; }
        .date-box .month { font-size: 12px; color: var(--text-soft); text-transform: uppercase; }

        .info-box { flex: 1; }
        .info-box h3 { font-size: 16px; margin-bottom: 5px; }
        .info-box p { font-size: 13px; color: var(--text-soft); display: flex; align-items: center; gap: 8px; margin-bottom: 4px; }
        
        .card-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            width: 100px;
        }
        .status-upcoming { background: rgba(130, 255, 91, 0.2); color: var(--lime); }
        .status-pending { background: rgba(255, 165, 0, 0.2); color: orange; }

        .btn-cancel {
            background: rgba(255, 91, 91, 0.1);
            color: var(--red-soft);
            border: 1px solid var(--red-soft);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            width: 100px;
        }
        .btn-cancel:hover { background: var(--red-soft); color: white; }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar { width: 60px; padding: 12px 6px; }
            .brand { display: none; }
            .sidebar-footer { display: none; }
            .menu a { font-size: 0; padding: 10px; justify-content: center; }
            .menu a i { font-size: 18px; width: auto; }
            .main { margin-left: 60px; }
            .schedule-container { grid-template-columns: 1fr; }
            .appointment-card { flex-direction: column; align-items: flex-start; }
            .card-actions { align-items: flex-start; flex-direction: row; margin-top: 10px; }
        }

        @media (max-width: 600px) {
            .main { padding: 12px 10px; }
            .appointment-card { padding: 14px; }
            .topbar { flex-wrap: wrap; gap: 8px; }
            .search-box { min-width: 0; }
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
            <li><a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>"><i class="fa-solid fa-house"></i>Dashboard</a></li>
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
        <div class="topbar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari jadwal...">
            </div>
            <div class="top-icons">
                <i class="fa-regular fa-bell"></i>
                <i class="fa-regular fa-user"></i>
            </div>
        </div>

        <div class="schedule-container">
            
            <div class="form-box">
                <h2><i class="fa-solid fa-plus-circle"></i> Buat Reservasi Baru</h2>
                <form id="bookingForm"> 
                    <div class="form-group">
                        <label>Pilih Layanan</label>
                        <select id="layananInput" class="form-control">
                            <option>Telinga (Ear Lobe)</option>
                            <option>Hidung (Nose)</option>
                            <option>Alis (Eyebrow)</option>
                            <option>Bibir (Lip)</option>
                            <option>Industrial Piercing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal & Waktu</label>
                        <input type="date" id="tanggalInput" class="form-control" style="margin-bottom:10px;" required>
                        <input type="time" id="waktuInput" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Catatan Tambahan (Opsional)</label>
                        <textarea id="catatanInput" class="form-control" rows="4" placeholder="Request khusus..."></textarea>
                    </div>

                    <button type="button" id="btnBooking" class="btn-submit">Booking Sekarang</button>
                </form>
            </div>

            <div class="schedule-list" id="listJadwal">
                <h2>Jadwal Mendatang</h2>

                <div class="appointment-card">
                    <div class="date-box">
                        <span class="day">25</span>
                        <span class="month">Okt</span>
                    </div>
                    <div class="info-box">
                        <h3>Industrial Piercing</h3>
                        <p><i class="fa-regular fa-clock"></i> 14:00 - 15:00 WIB</p>
                        <p><i class="fa-solid fa-user-doctor"></i> Dr. Sphnx</p>
                    </div>
                    <div class="card-actions">
                        <span class="status-badge status-upcoming">Disetujui</span>
                        <button type="button" class="btn-cancel" onclick="this.closest('.appointment-card').remove()">Batal</button>
                    </div>
                </div>

                <div class="appointment-card" style="border-left-color: orange;">
                    <div class="date-box">
                        <span class="day">02</span>
                        <span class="month">Nov</span>
                    </div>
                    <div class="info-box">
                        <h3>Nose Piercing</h3>
                        <p><i class="fa-regular fa-clock"></i> 10:00 - 11:00 WIB</p>
                        <p><i class="fa-solid fa-user-doctor"></i> Dr. Sphnx</p>
                    </div>
                    <div class="card-actions">
                        <span class="status-badge status-pending">Menunggu</span>
                        <button type="button" class="btn-cancel" onclick="this.closest('.appointment-card').remove()">Batal</button>
                    </div>
                </div>

            </div>

        </div>

    </main>
</div>

<script>
    document.getElementById('btnBooking').addEventListener('click', function() {
        const layanan = document.getElementById('layananInput').value;
        const tanggal = document.getElementById('tanggalInput').value;
        const waktu = document.getElementById('waktuInput').value;

        if(tanggal === '' || waktu === '') {
            alert('Mohon lengkapi tanggal dan waktu reservasi!');
            return;
        }

        const dateObj = new Date(tanggal);
        const hari = String(dateObj.getDate()).padStart(2, '0');
        const daftarBulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"];
        const bulan = daftarBulan[dateObj.getMonth()];

        let [jam, menit] = waktu.split(':');
        let jamSelesai = String(parseInt(jam) + 1).padStart(2, '0');
        let waktuAkhir = `${jamSelesai}:${menit}`;

        const cardBaru = document.createElement('div');
        cardBaru.className = 'appointment-card';
        cardBaru.style.borderLeftColor = 'orange'; 
        
        cardBaru.innerHTML = `
            <div class="date-box">
                <span class="day">${hari}</span>
                <span class="month">${bulan}</span>
            </div>
            <div class="info-box">
                <h3>${layanan}</h3>
                <p><i class="fa-regular fa-clock"></i> ${waktu} - ${waktuAkhir} WIB</p>
                <p><i class="fa-solid fa-user-doctor"></i> Dr. Sphnx</p>
            </div>
            <div class="card-actions">
                <span class="status-badge status-pending">Menunggu</span>
                <button type="button" class="btn-cancel" onclick="this.closest('.appointment-card').remove()">Batal</button>
            </div>
        `;

        const listJadwal = document.getElementById('listJadwal');
        listJadwal.insertBefore(cardBaru, listJadwal.children[1]);

        document.getElementById('bookingForm').reset();
    });
</script>

</body>
</html>