<?php
$username = "@sphnx_piercing";
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Metode Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <style>
        /* --- CSS VARIABLE (SAMA) --- */
        :root {
            --bg-main: #2f0c58;
            --bg-main-dark: #20103a;
            --bg-sidebar: #240744;
            --bg-card: #14062b;
            --accent: #a54ccf;
            --text: #f4f4f4;
            --text-soft: #cdcdcd;
            --lime: #82ff5b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { font-family: "Poppins", sans-serif; background: #111; color: var(--text); }

        .app { display: flex; min-height: 100vh; background: var(--bg-main); }

        /* SIDEBAR */
        .sidebar {
            width: 210px; background: var(--bg-sidebar); padding: 18px 16px;
            display: flex; flex-direction: column; align-items: center;
            border-right: 1px solid rgba(0, 0, 0, .4);
            position: fixed; left: 0; top: 0; bottom: 0; height: 100vh; z-index: 60;
        }
        .brand { text-align: center; margin-bottom: 32px; }
        .brand img { width: 90px; height: 90px; border-radius: 50%; border: 3px solid var(--accent); object-fit: cover; }
        .brand span { display: block; margin-top: 8px; font-size: 13px; }
        .menu { width: 100%; list-style: none; flex: 1; }
        .menu li { margin-bottom: 14px; }
        .menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 999px; font-size: 13px; text-decoration: none; color: var(--text-soft); transition: .2s; }
        .menu a i { width: 20px; text-align: center; }
        .menu a:hover, .menu a.active { background: var(--bg-main-dark); color: var(--lime); }
        .sidebar-footer { width: 100%; margin-top: auto; padding-top: 12px; border-top: 1px solid rgba(255, 255, 255, .08); }

        /* MAIN CONTENT */
        .main { flex: 1; padding: 20px 40px; background: var(--bg-main); display: flex; flex-direction: column; margin-left: 210px; }
        .header-payment { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .search-payment { background: var(--accent); padding: 8px 15px; border-radius: 8px; width: 300px; display: flex; align-items: center; gap: 10px; }
        .search-payment input { background: transparent; border: none; outline: none; color: white; width: 100%; }
        .search-payment input::placeholder { color: #eee; }

        /* OPSI PEMBAYARAN */
        .payment-options { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .pay-card { background: var(--bg-card); padding: 30px; border-radius: 12px; text-align: center; cursor: pointer; border: 2px solid transparent; transition: 0.3s; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 15px; }
        .pay-card i { font-size: 40px; color: var(--text); }
        .pay-card span { font-size: 18px; font-weight: 500; }
        .method-total { margin-top: 8px; font-size: 14px; color: var(--text-soft); display: none; }
        .pay-card.active .method-total { display: block; }

        /* Class ini yang akan membuat kartu tidak bisa diklik saat belum ada pesanan */
        .pay-card.disabled { opacity: 0.45; pointer-events: none; border-color: rgba(255, 255, 255, .08); background: rgba(255, 255, 255, .04); cursor: not-allowed; }

        .payment-timer { margin-top: 20px; padding: 16px 18px; border-radius: 12px; background: rgba(255, 255, 255, .05); border: 1px solid rgba(255, 255, 255, .08); color: var(--text); display: none; justify-content: space-between; align-items: center; }
        .payment-timer span { font-size: 14px; }
        .payment-timer strong { color: var(--lime); font-size: 16px; }

        .pay-card:hover:not(.disabled) { background: var(--bg-main-dark); transform: translateY(-5px); }
        .pay-card.active { border-color: var(--lime); background: rgba(130, 255, 91, 0.05); }
        .pay-card.active i, .pay-card.active span { color: var(--lime); }

        /* AREA DETAIL PEMBAYARAN */
        .payment-details-area { background: var(--bg-card); border-radius: 12px; padding: 25px; min-height: 250px; display: flex; align-items: center; }
        .no-selection { width: 100%; text-align: center; font-size: 18px; font-weight: 500; color: var(--text); text-transform: uppercase; letter-spacing: 1px; }
        .details-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; width: 100%; align-items: start; animation: fadeIn 0.4s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .bill-info h3 { color: var(--lime); margin-bottom: 15px; font-size: 16px; }
        .bill-row { display: flex; margin-bottom: 8px; font-size: 14px; }
        .bill-label { width: 120px; color: var(--text); }
        .bill-sep { margin-right: 10px; }
        .bill-val { color: var(--text); font-weight: 400; }
        .method-row { margin-top: 20px; display: flex; align-items: center; }
        .btn-bayar { background: var(--text-soft); color: #333; padding: 5px 20px; border-radius: 6px; border: none; font-weight: 600; margin-left: 20px; cursor: pointer; }
        .btn-bayar:hover { background: var(--lime); }
        .payment-instruction { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; }
        .qr-frame { background: white; padding: 10px; border-radius: 10px; text-align: center; color: black; width: 200px; }
        .qr-frame img { width: 100%; height: auto; }
        .qr-title { font-weight: bold; font-size: 18px; margin-bottom: 5px; display: block; }
        .qr-id { font-size: 10px; display: block; margin-bottom: 5px; }
        .transfer-info { width: 100%; background: var(--bg-main-dark); padding: 20px; border-radius: 10px; }
        .bank-row { display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 10px; }
        .bank-row:last-child { border: none; }
        .bank-label { color: var(--text-soft); }
        .bank-val { font-weight: 600; color: var(--lime); font-size: 16px; text-align: right; }

        @media (max-width: 900px) {
            .app { flex-direction: column; }
            .sidebar { position: static; width: 100%; height: auto; flex-direction: row; overflow-x: auto; }
            .main { margin-left: 0; padding: 20px; }
            .payment-options { grid-template-columns: 1fr; }
            .details-grid { grid-template-columns: 1fr; gap: 20px; }
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
        <div class="header-payment">
            <div class="search-payment">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="paymentSearch" type="text" placeholder="Metode Pembayaran" autocomplete="off">
            </div>
        </div>

        <div class="payment-options">
            <div class="pay-card" data-method="cash" onclick="selectMethod('cash', this)">
                <i class="fa-solid fa-money-bill"></i>
                <span>Cash</span>
                <span class="method-total">-</span>
            </div>
            <div class="pay-card" data-method="transfer" onclick="selectMethod('transfer', this)">
                <i class="fa-solid fa-money-bill-transfer"></i>
                <span>Transfer</span>
                <span class="method-total">-</span>
            </div>
            <div class="pay-card" data-method="qris" onclick="selectMethod('qris', this)">
                <i class="fa-solid fa-qrcode"></i>
                <span>QRIS</span>
                <span class="method-total">-</span>
            </div>
        </div>

        <div class="payment-details-area" id="detailArea">
            <div class="no-selection" id="defaultMsg">
                MEMUAT DATA...
            </div>

            <div class="details-grid" id="contentGrid" style="display: none;">
                <div class="bill-info">
                    <h3>Perlu Dibayar</h3>
                    <div class="bill-row">
                        <span class="bill-label">Jenis Produk</span><span class="bill-sep">:</span>
                        <span class="bill-val" id="selectedProductType">JASA/PRODUK</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Nama Produk</span><span class="bill-sep">:</span>
                        <span class="bill-val" id="selectedProductName">PASANG/ANTING</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Jumlah</span><span class="bill-sep">:</span>
                        <span class="bill-val" id="selectedQuantity">3 Anting</span>
                    </div>
                    <div class="bill-row">
                        <span class="bill-label">Total</span><span class="bill-sep">:</span>
                        <span class="bill-val" id="selectedTotal">Rp 120.000</span>
                    </div>
                    
                    <div class="method-row">
                        <span class="bill-label">Metode</span><span class="bill-sep">:</span>
                        <span class="bill-val" id="selectedMethodName" style="text-transform: capitalize;">-</span>
                        <button class="btn-bayar">Bayar</button>
                    </div>
                </div>

                <div class="payment-instruction" id="rightContent">
                </div>
            </div>
        </div>
        <div class="payment-timer" id="paymentTimer">
            <span>Waktu tersisa untuk menyelesaikan pembayaran:</span>
            <strong id="timerValue">00:00</strong>
        </div>
    </main>
</div>

<script>
    function formatRupiah(value) {
        if (!value || isNaN(parseInt(value))) return value;
        return 'Rp ' + parseInt(value, 10).toLocaleString('id-ID');
    }

    let paymentTimerInterval = null;
    let currentPaymentType = null;
    let currentTimerSeconds = 0;
    let paymentExpired = false;
    
    // Variabel kunci untuk mengecek apakah user sedang dalam proses pembelian
    let isTransactionActive = false; 

    function formatTimer(seconds, type) {
        if (type === 'cash') {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        }
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    function setTimerText(type, seconds) {
        const timerBox = document.getElementById('paymentTimer');
        const timerValue = document.getElementById('timerValue');
        timerValue.innerText = formatTimer(seconds, type);
        timerBox.style.display = 'flex';
    }

    function clearPaymentTimer() {
        if (paymentTimerInterval) {
            clearInterval(paymentTimerInterval);
            paymentTimerInterval = null;
        }
    }

    function startPaymentTimer(type) {
        clearPaymentTimer();
        currentPaymentType = type;
        paymentExpired = false;
        currentTimerSeconds = type === 'cash' ? 24 * 60 * 60 : 60;
        setTimerText(type, currentTimerSeconds);

        paymentTimerInterval = setInterval(() => {
            currentTimerSeconds -= 1;
            if (currentTimerSeconds < 0) {
                clearPaymentTimer();
                paymentExpired = true;
                document.getElementById('timerValue').innerText = 'EXPIRED';
                alert('Pembayaran gagal: Waktu pembayaran habis. Silakan pilih metode lagi.');
                return;
            }
            setTimerText(type, currentTimerSeconds);
        }, 1000);
    }

    function completePayment(type, amount) {
        if (paymentExpired) {
            alert('Pembayaran sudah hangus. Silakan pilih kembali metode pembayaran.');
            return;
        }
        
        clearPaymentTimer();
        document.getElementById('paymentTimer').style.display = 'none';
        document.getElementById('rightContent').innerHTML = `
            <div style="text-align:center; color:var(--text-soft);">
                <i class="fa-solid fa-circle-check" style="font-size:50px; color:var(--lime); margin-bottom:15px;"></i>
                <p>Pembayaran berhasil untuk metode <strong>${getMethodLabel(type)}</strong>.<br>Terima kasih telah bertransaksi.</p>
            </div>
        `;
        alert('Pembayaran berhasil! Mengarahkan ke Riwayat...');

        const params = parseQueryParams();
        const product = params.get('product') || '';
        const quantity = params.get('quantity') || '1';
        const total = params.get('total') || amount || '0';
        const paymentMethod = params.get('payment_method') || getMethodLabel(type);
        
        const orderId = `order_${Date.now()}_${Math.floor(Math.random() * 10000)}`;
        
        const historyParams = new URLSearchParams();
        historyParams.set('order_complete', '1');
        historyParams.set('order_id', orderId);
        historyParams.set('product', product);
        historyParams.set('quantity', quantity);
        historyParams.set('total', total);
        historyParams.set('payment_method', paymentMethod);

        window.location.href = 'riwayat.php?' + historyParams.toString();
    }

    function updateMethodTotals(selected, totalValue) {
        const cards = document.querySelectorAll('.pay-card');
        cards.forEach(card => {
            const totalEl = card.querySelector('.method-total');
            if (!totalEl) return;
            if (card.dataset.method === selected) {
                totalEl.innerText = formatRupiah(totalValue);
            } else {
                totalEl.innerText = '';
            }
        });
    }

    function getMethodLabel(type) {
        if (!type) return '-';
        if (type === 'cash') return 'Cash';
        if (type === 'qris') return 'QRIS';
        if (type === 'transfer') return 'Transfer Bank';
        return type.charAt(0).toUpperCase() + type.slice(1);
    }

    function selectMethod(type, element) {
        // CEK PENTING: Jika tidak ada transaksi, hentikan eksekusi klik!
        if (!isTransactionActive) return; 

        const cards = document.querySelectorAll('.pay-card');
        cards.forEach(card => card.classList.remove('active'));

        element.classList.add('active');

        document.getElementById('defaultMsg').style.display = 'none';
        document.getElementById('contentGrid').style.display = 'grid';

        document.getElementById('selectedMethodName').innerText = getMethodLabel(type);
        updateMethodTotals(type, window.__methodTotalValue || 0);

        const rightBox = document.getElementById('rightContent');
        
        if (type === 'qris') {
            rightBox.innerHTML = `
                <div class="qr-frame">
                    <span class="qr-title">PIERCING</span>
                    <span class="qr-id">NMID : ID10190000213</span>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=PembayaranSphinx" alt="QRIS">
                    <span style="font-size:10px; margin-top:5px; display:block;">Scan untuk membayar</span>
                </div>
                <button class="btn-bayar" id="paymentActionButton">Bayar Sekarang</button>
            `;
        } else if (type === 'transfer') {
            rightBox.innerHTML = `
                <div class="transfer-info">
                    <h3 style="color:var(--lime); margin-bottom:15px; text-align:center;">Transfer</h3>
                    <div class="bank-row">
                        <span class="bank-label">Bank</span>
                        <span class="bank-val">BCA</span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-label">No. Rekening</span>
                        <span class="bank-val">13256784321</span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-label">Nama Pemilik</span>
                        <span class="bank-val">PiercingSpxJogja</span>
                    </div>
                </div>
                <button class="btn-bayar" id="paymentActionButton">Bayar Sekarang</button>
            `;
        } else if (type === 'cash') {
            rightBox.innerHTML = `
                <div style="text-align:center; color:var(--text-soft);">
                    <i class="fa-solid fa-cash-register" style="font-size:50px; color:var(--lime); margin-bottom:15px;"></i>
                    <p>Silakan lakukan pembayaran<br>di meja kasir.</p>
                </div>
                <button class="btn-bayar" id="paymentActionButton">Bayar Sekarang</button>
            `;
        }

        startPaymentTimer(type);
    }

    document.addEventListener('click', function(event) {
        if (event.target && event.target.id === 'paymentActionButton') {
            completePayment(currentPaymentType, window.__methodTotalValue || 0);
        }
    });

    document.getElementById('paymentSearch').addEventListener('input', function() {
        if (!isTransactionActive) return; // Matikan fungsi pencarian jika belum beli
        
        const query = this.value.trim().toLowerCase();
        const cards = Array.from(document.querySelectorAll('.pay-card'));

        if (!query) {
            cards.forEach(card => card.classList.remove('active'));
            document.getElementById('defaultMsg').style.display = 'block';
            document.getElementById('contentGrid').style.display = 'none';
            document.getElementById('selectedMethodName').innerText = '-';
            document.getElementById('rightContent').innerHTML = '';
            return;
        }

        const matchedCard = cards.find(card => {
            const methodName = card.querySelector('span')?.innerText.toLowerCase() || '';
            const methodType = card.dataset.method || '';
            return methodName.includes(query) || methodType.includes(query);
        });

        if (matchedCard) {
            selectMethod(matchedCard.dataset.method, matchedCard);
        }
    });

    function parseQueryParams() {
        return new URLSearchParams(window.location.search);
    }

    function normalizeMethod(method) {
        if (!method) return null;
        const key = method.toLowerCase();
        if (key.includes('cash')) return 'cash';
        if (key.includes('gopay')) return 'cash';
        if (key.includes('qris')) return 'qris';
        if (key.includes('transfer')) return 'transfer';
        return null;
    }

    window.addEventListener('DOMContentLoaded', () => {
        const params = parseQueryParams();
        const methodParam = normalizeMethod(params.get('payment_method'));
        const productParam = params.get('product');
        const quantityParam = params.get('quantity');
        const totalParam = params.get('total');

        // LOGIKA PENGECEKAN: Apakah ada URL data produk/total?
        isTransactionActive = !!(productParam || totalParam);

        if (!isTransactionActive) {
            // 1. JIKA TIDAK ADA TRANSAKSI -> Kunci semua tombol
            document.querySelectorAll('.pay-card').forEach(card => card.classList.add('disabled'));
            document.getElementById('defaultMsg').innerText = "BELUM ADA TRANSAKSI. SILAKAN LAKUKAN PEMBELIAN TERLEBIH DAHULU.";
            document.getElementById('paymentSearch').disabled = true; // Kunci kolom pencarian
        } else {
            // 2. JIKA ADA TRANSAKSI -> Aktifkan & Isi data dari Checkout
            document.getElementById('defaultMsg').innerText = "PILIH METODE PEMBAYARAN TERLEBIH DAHULU DI ATAS!";
            
            document.getElementById('selectedProductType').innerText = 'Produk/Jasa';
            document.getElementById('selectedProductName').innerText = productParam || 'Pesanan Anda';
            document.getElementById('selectedQuantity').innerText = quantityParam ? `${quantityParam} pcs` : '1 pcs';
            document.getElementById('selectedTotal').innerText = totalParam ? formatRupiah(totalParam) : 'Rp 0';
            
            window.__methodTotalValue = totalParam || 0;

            // Jika dari halaman checkout pengguna sudah memilih metode (misal dropdown: QRIS)
            if (methodParam) {
                const card = Array.from(document.querySelectorAll('.pay-card')).find(c => c.dataset.method === methodParam);
                if (card) {
                    selectMethod(methodParam, card);
                }
            }
        }
    });
</script>

</body>
</html>