<?php
$current_page = basename($_SERVER['PHP_SELF']);
include 'header.php';
?>
    <link rel="stylesheet" href="css/jadwal.css">

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
            <div class="top-icons">
                <!-- <i class="fa-regular fa-bell"></i>
                <i class="fa-regular fa-user"></i> -->
            </div>
        </div>

        <div class="schedule-container">
            
            <div class="form-box">
                <h2><i class="fa-solid fa-plus-circle"></i> Buat Reservasi Baru</h2>
                <form id="bookingForm"> 
                    <div class="form-group">
                        <label>Pilih Layanan</label>
                        <select id="layananInput" class="form-control">
                            <option value="Telinga (Ear Lobe)" data-harga="85000">Telinga (Ear Lobe)</option>
                            <option value="Hidung (Nose)" data-harga="100000">Hidung (Nose)</option>
                            <option value="Alis (Eyebrow)" data-harga="120000">Alis (Eyebrow)</option>
                            <option value="Bibir (Lip)" data-harga="110000">Bibir (Lip)</option>
                            <option value="Industrial Piercing" data-harga="150000">Industrial Piercing</option>
                        </select>
                        <span class="price-tag" id="hargaTag"><i class="fa-solid fa-tag"></i> Rp 85.000</span>
                    </div>

                    <div class="form-group">
                        <label>Tanggal & Waktu</label>
                        <input type="date" id="tanggalInput" class="form-control" style="margin-bottom:10px;" required>
                        <input type="time" id="waktuInput" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Titik Piercing</label>
                        <input type="number" id="jumlahInput" class="form-control" min="1" max="10" value="1" placeholder="Masukkan jumlah...">
                    </div>

                    <div class="form-group">
                        <label>Detail Reservasi</label>
                        <div class="detail-box" id="detailBox">
                            <strong>Layanan:</strong> Telinga (Ear Lobe)<br>
                            <strong>Harga:</strong> Rp 85.000 / titik<br>
                            <strong>Hari & Waktu:</strong> —<br>
                            <strong>Jumlah:</strong> 1 titik &nbsp;|&nbsp; <strong>Total:</strong> Rp 85.000
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan Tambahan (Opsional)</label>
                        <textarea id="catatanInput" class="form-control" rows="3" placeholder="Request khusus, alergi, atau informasi lain..."></textarea>
                    </div>

                    <button type="button" id="btnBooking" class="btn-submit">Booking Sekarang</button>
                </form>
            </div>

            <div class="schedule-list" id="listJadwal">
                <h2>Jadwal Mendatang</h2>
                <div class="empty-state" id="emptyState">
                    <i class="fa-regular fa-calendar-xmark"></i>
                    <p>Belum ada jadwal reservasi.<br>Buat reservasi baru di sebelah kiri.</p>
                </div>
            </div>

        </div>

    </main>
</div>

<!-- Modal Konfirmasi Pembayaran -->
<div class="modal-overlay" id="modalPembayaran">
    <div class="modal-box">
        <div class="modal-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h3>Reservasi Berhasil!</h3>
        <p>Detail reservasi kamu:</p>
        <div class="modal-detail" id="modalDetailIsi">
            <!-- diisi JS -->
        </div>
        <div class="modal-note">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <strong>Informasi Pembayaran</strong><br>
            Pembayaran dilakukan <strong>setelah pemasangan selesai di tempat</strong> (bayar di studio). Tidak ada pembayaran di muka.
        </div>
        <button class="btn-modal-ok" id="btnModalOk">Mengerti, Lanjutkan</button>
    </div>
</div>

<script>
    const hargaMap = {
        'Telinga (Ear Lobe)': 85000,
        'Hidung (Nose)': 100000,
        'Alis (Eyebrow)': 120000,
        'Bibir (Lip)': 110000,
        'Industrial Piercing': 150000
    };

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    function updateDetail() {
        const layananEl = document.getElementById('layananInput');
        const layanan = layananEl.value;
        const harga = hargaMap[layanan] || 0;
        const jumlah = parseInt(document.getElementById('jumlahInput').value) || 1;
        const tanggal = document.getElementById('tanggalInput').value;
        const waktu = document.getElementById('waktuInput').value;

        // Update price tag
        document.getElementById('hargaTag').innerHTML = '<i class="fa-solid fa-tag"></i> ' + formatRupiah(harga);

        // Format hari & waktu
        let hariWaktu = '—';
        if (tanggal) {
            const dateObj = new Date(tanggal);
            const namaHari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][dateObj.getDay()];
            const tgl = dateObj.toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric' });
            hariWaktu = namaHari + ', ' + tgl + (waktu ? ' — ' + waktu + ' WIB' : '');
        } else if (waktu) {
            hariWaktu = waktu + ' WIB';
        }

        const total = harga * jumlah;
        document.getElementById('detailBox').innerHTML =
            '<strong>Layanan:</strong> ' + layanan + '<br>' +
            '<strong>Harga:</strong> ' + formatRupiah(harga) + ' / titik<br>' +
            '<strong>Hari & Waktu:</strong> ' + hariWaktu + '<br>' +
            '<strong>Jumlah:</strong> ' + jumlah + ' titik &nbsp;|&nbsp; <strong>Total:</strong> ' + formatRupiah(total);
    }

    document.getElementById('layananInput').addEventListener('change', updateDetail);
    document.getElementById('jumlahInput').addEventListener('input', updateDetail);
    document.getElementById('tanggalInput').addEventListener('change', updateDetail);
    document.getElementById('waktuInput').addEventListener('change', updateDetail);

    document.getElementById('btnBooking').addEventListener('click', function() {
        const layanan = document.getElementById('layananInput').value;
        const tanggal = document.getElementById('tanggalInput').value;
        const waktu = document.getElementById('waktuInput').value;
        const jumlah = parseInt(document.getElementById('jumlahInput').value) || 1;
        const harga = hargaMap[layanan] || 0;
        const total = harga * jumlah;

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
                <p><i class="fa-solid fa-hashtag"></i> ${jumlah} titik &nbsp;|&nbsp; <strong style="color:var(--lime)">${formatRupiah(total)}</strong></p>
                <p><i class="fa-solid fa-user-doctor"></i> Dr. Sphnx</p>
            </div>
            <div class="card-actions">
                <span class="status-badge status-pending">Menunggu</span>
                <button type="button" class="btn-cancel" onclick="this.closest('.appointment-card').remove(); const es=document.getElementById('emptyState'); if(es && document.querySelectorAll('.appointment-card').length===0) es.style.display='';">Batal</button>
            </div>
        `;

        const listJadwal = document.getElementById('listJadwal');
        const emptyState = document.getElementById('emptyState');
        if (emptyState) emptyState.style.display = 'none';
        listJadwal.insertBefore(cardBaru, listJadwal.children[1]);

        // Tampilkan modal pembayaran
        const dateObjModal = new Date(tanggal);
        const namaHariModal = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][dateObjModal.getDay()];
        const tglModal = dateObjModal.toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric' });
        document.getElementById('modalDetailIsi').innerHTML =
            '<span>Layanan</span> &nbsp; <strong>' + layanan + '</strong><br>' +
            '<span>Harga</span> &nbsp;&nbsp;&nbsp;&nbsp; <strong>' + formatRupiah(harga) + ' / titik</strong><br>' +
            '<span>Jumlah</span> &nbsp;&nbsp; <strong>' + jumlah + ' titik</strong><br>' +
            '<span>Hari</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>' + namaHariModal + ', ' + tglModal + '</strong><br>' +
            '<span>Waktu</span> &nbsp;&nbsp; <strong>' + waktu + ' – ' + waktuAkhir + ' WIB</strong><br>' +
            '<span>Total</span> &nbsp;&nbsp;&nbsp;&nbsp; <strong style="color:var(--lime)">' + formatRupiah(total) + '</strong>';

        document.getElementById('modalPembayaran').classList.add('active');

        document.getElementById('bookingForm').reset();
        updateDetail();
    });

    document.getElementById('btnModalOk').addEventListener('click', function() {
        document.getElementById('modalPembayaran').classList.remove('active');
    });
</script>

</body>
</html>