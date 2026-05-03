<?php
$current_page = basename($_SERVER['PHP_SELF']);
$page_css = '../css-customer/jadwal.css?v=' . filemtime(__DIR__ . '/../css-customer/jadwal.css');
$username = '@sphnx_piercing';
include 'header.php';
?>

<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <img src="../gambar/logo2.jpeg" alt="Logo">
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

<style>
/* === PENGATURAN TAMPILAN KALENDER & WAKTU === */
.datetime-picker {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 14px !important;
    margin-top: 6px !important;
}
.cal-panel, .time-panel {
    background: #20103a !important;
    border-radius: 14px !important;
    padding: 16px !important;
    border: 1.5px solid #82ff5b !important;
    display: flex !important;
    flex-direction: column !important;
}
.cal-panel h3, .time-panel h3 {
    font-size: 13px; font-weight: 600; color: #82ff5b;
    display: flex; align-items: center; gap: 7px;
    padding-bottom: 10px; margin-bottom: 10px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.cal-header {
    display: flex; align-items: center;
    justify-content: space-between; margin-bottom: 8px;
}
.cal-month-year { font-size: 13px; font-weight: 700; color: #f4f4f4; }
.cal-nav {
    background: transparent; border: none; color: #cdcdcd;
    cursor: pointer; width: 28px; height: 28px;
    border-radius: 50%; display: flex; align-items: center;
    justify-content: center; font-size: 11px; transition: 0.2s;
}
.cal-nav:hover { background: rgba(255,255,255,0.1); color: #82ff5b; }
.cal-days-header {
    display: grid !important;
    grid-template-columns: repeat(7, 1fr) !important;
    margin-bottom: 2px;
}
.cal-days-header span {
    text-align: center; font-size: 10px; color: #cdcdcd; padding: 3px 0;
}
.sunday-label { color: #ff6b6b !important; }
.cal-dates {
    display: grid !important;
    grid-template-columns: repeat(7, 1fr) !important;
    gap: 1px; flex: 1; margin-bottom: 12px;
}
.cal-date-btn {
    background: transparent; border: none; color: #f4f4f4;
    cursor: pointer; font-size: 11px; width: 100%;
    aspect-ratio: 1; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    transition: 0.15s; font-family: inherit;
}
.cal-date-btn:hover:not(.other-month):not(.selected) { background: rgba(255,255,255,0.1); }
.cal-date-btn.selected { background: #82ff5b !important; color: #111 !important; font-weight: 700; }
.cal-date-btn.sunday { color: #ff6b6b; }
.cal-date-btn.sunday.selected { color: #111 !important; }
.cal-date-btn.other-month { color: rgba(255,255,255,0.18); cursor: default; }
.btn-konfirmasi {
    width: 100%; padding: 10px; background: #82ff5b; color: #111;
    border: none; border-radius: 10px; font-weight: 700; font-size: 13px;
    cursor: pointer; font-family: inherit; transition: opacity 0.2s; margin-top: auto;
}
.btn-konfirmasi:hover { opacity: 0.88; }
.time-selected-date {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px; padding: 8px 10px;
    font-size: 12px; color: #f4f4f4;
    display: flex; align-items: center; gap: 7px; margin-bottom: 10px;
}
.time-selected-date i { color: #82ff5b; }
.time-slots {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 7px; margin-bottom: 12px; flex: 1; align-content: start;
}
.time-slot-btn {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.22);
    color: #f4f4f4; font-size: 12px; padding: 9px 2px;
    border-radius: 8px; cursor: pointer; transition: 0.2s;
    font-family: inherit; text-align: center;
}
.time-slot-btn:hover:not(.selected) { border-color: #82ff5b; color: #82ff5b; }
.time-slot-btn.selected {
    background: #82ff5b !important; border-color: #82ff5b !important;
    color: #111 !important; font-weight: 700; font-size: 10px;
}
</style>

                    <div class="form-group">
                        <label>Tanggal & Waktu</label>
                        <div class="datetime-picker">
                            <!-- Panel Kalender -->
                            <div class="cal-panel">
                                <h3><i class="fa-regular fa-calendar"></i> Pilih Tanggal</h3>
                                <div class="cal-header">
                                    <button type="button" class="cal-nav" id="calPrev"><i class="fa-solid fa-chevron-left"></i></button>
                                    <span class="cal-month-year" id="calMonthYear"></span>
                                    <button type="button" class="cal-nav" id="calNext"><i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                                <div class="cal-days-header">
                                    <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span class="sunday-label">Ming</span>
                                </div>
                                <div class="cal-dates" id="calDates"></div>
                            </div>
                            <!-- Panel Waktu -->
                            <div class="time-panel">
                                <h3><i class="fa-regular fa-clock"></i> Pilih Waktu</h3>
                                <div class="time-selected-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span id="timeSelectedDateText">Pilih tanggal dulu</span>
                                </div>
                                <div class="time-slots" id="timeSlots"></div>
                            </div>
                        </div>
                        <input type="hidden" id="tanggalInput">
                        <input type="hidden" id="waktuInput">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Titik Piercing</label>
                        <div class="qty-wrapper">
                            <input type="number" id="jumlahInput" class="form-control" min="1" max="10" value="1" placeholder="Masukkan jumlah..." style="-moz-appearance:textfield; appearance:textfield; padding-right:36px;">
                            <div class="qty-spinners">
                                <button type="button" class="qty-spin-btn" id="jumlahPlus"><i class="fa-solid fa-chevron-up"></i></button>
                                <button type="button" class="qty-spin-btn" id="jumlahMinus"><i class="fa-solid fa-chevron-down"></i></button>
                            </div>
                        </div>
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

        // Perbarui label harga sesuai layanan dipilih
        document.getElementById('hargaTag').innerHTML = '<i class="fa-solid fa-tag"></i> ' + formatRupiah(harga);

        // Format tampilan hari dan waktu reservasi
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

    // Tombol +/- untuk jumlah titik piercing
    document.getElementById('jumlahPlus').addEventListener('click', function() {
        const el = document.getElementById('jumlahInput');
        const max = parseInt(el.max) || 10;
        const val = parseInt(el.value) || 1;
        if (val < max) { el.value = val + 1; updateDetail(); }
    });
    document.getElementById('jumlahMinus').addEventListener('click', function() {
        const el = document.getElementById('jumlahInput');
        const min = parseInt(el.min) || 1;
        const val = parseInt(el.value) || 1;
        if (val > min) { el.value = val - 1; updateDetail(); }
    });

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

        // Tampilkan modal ringkasan pembayaran
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

    // ===== KALENDER & PILIHAN WAKTU =====
    const availableSlots = ['10:00','11:00','13:00','14:00','15:00','17:00','18:00','19:00'];
    const namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const bulanShort = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
    const hariShort  = ['Ming','Sen','Sel','Rab','Kam','Jum','Sab'];

    let calMonth = new Date().getMonth();
    let calYear  = new Date().getFullYear();
    let calSelectedDate  = null;
    let selectedSlot     = null;

    function renderCalendar() {
        document.getElementById('calMonthYear').textContent = namaBulan[calMonth] + ' ' + calYear;
        const calDates = document.getElementById('calDates');
        const firstDay  = new Date(calYear, calMonth, 1).getDay();
        const startOff  = (firstDay === 0) ? 6 : firstDay - 1; // Mulai dari hari Senin
        const daysTotal = new Date(calYear, calMonth + 1, 0).getDate();
        const prevDays  = new Date(calYear, calMonth, 0).getDate();
        let html = '';
        for (let i = startOff - 1; i >= 0; i--)
            html += `<button type="button" class="cal-date-btn other-month" disabled>${prevDays - i}</button>`;
        for (let d = 1; d <= daysTotal; d++) {
            const dow = new Date(calYear, calMonth, d).getDay();
            const isSun = dow === 0;
            const isSel = calSelectedDate &&
                calSelectedDate.getDate() === d &&
                calSelectedDate.getMonth() === calMonth &&
                calSelectedDate.getFullYear() === calYear;
            html += `<button type="button" class="cal-date-btn${isSun ? ' sunday' : ''}${isSel ? ' selected' : ''}" data-day="${d}">${d}</button>`;
        }
        const filled = startOff + daysTotal;
        const rem = (Math.ceil(filled / 7) * 7) - filled;
        for (let d = 1; d <= rem; d++)
            html += `<button type="button" class="cal-date-btn other-month" disabled>${d}</button>`;
        calDates.innerHTML = html;
        calDates.querySelectorAll('.cal-date-btn:not(.other-month)').forEach(btn => {
            btn.addEventListener('click', function() {
                calSelectedDate = new Date(calYear, calMonth, parseInt(this.dataset.day));
                selectedSlot = null;
                renderCalendar();
                renderTimePanel();
                syncHidden();
            });
        });
    }

    function renderTimePanel() {
        const dateText = document.getElementById('timeSelectedDateText');
        const slotsEl  = document.getElementById('timeSlots');
        if (!calSelectedDate) {
            dateText.textContent = 'Pilih tanggal dulu';
            slotsEl.innerHTML = '';
            return;
        }
        const d = calSelectedDate.getDate();
        const m = calSelectedDate.getMonth();
        const y = calSelectedDate.getFullYear();
        dateText.textContent = `${hariShort[calSelectedDate.getDay()]}, ${d} ${bulanShort[m]} ${y}`;
        let html = '';
        availableSlots.forEach(slot => {
            const isSel = selectedSlot === slot;
            const [h] = slot.split(':');
            const end  = String(parseInt(h) + 1).padStart(2,'0') + ':00';
            const label = isSel ? `${slot}-${end}` : slot.replace(':','.');
            html += `<button type="button" class="time-slot-btn${isSel ? ' selected' : ''}" data-slot="${slot}">${label}</button>`;
        });
        slotsEl.innerHTML = html;
        slotsEl.querySelectorAll('.time-slot-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                selectedSlot = this.dataset.slot;
                renderTimePanel();
                syncHidden();
            });
        });
    }

    function syncHidden() {
        if (calSelectedDate) {
            const y = calSelectedDate.getFullYear();
            const m = String(calSelectedDate.getMonth() + 1).padStart(2,'0');
            const d = String(calSelectedDate.getDate()).padStart(2,'0');
            document.getElementById('tanggalInput').value = `${y}-${m}-${d}`;
        } else {
            document.getElementById('tanggalInput').value = '';
        }
        document.getElementById('waktuInput').value = selectedSlot || '';
        updateDetail();
    }

    document.getElementById('calPrev').addEventListener('click', function() {
        calMonth--; if (calMonth < 0) { calMonth = 11; calYear--; } renderCalendar();
    });
    document.getElementById('calNext').addEventListener('click', function() {
        calMonth++; if (calMonth > 11) { calMonth = 0; calYear++; } renderCalendar();
    });
    document.getElementById('bookingForm').addEventListener('reset', function() {
        calSelectedDate = null; selectedSlot = null; renderCalendar(); renderTimePanel(); syncHidden();
    });

    renderCalendar();
    renderTimePanel();
</script>

</body>
</html>