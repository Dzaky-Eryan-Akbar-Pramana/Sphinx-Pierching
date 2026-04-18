<?php
session_start();

$username = "@sphnx_piercing";

// Mendeteksi nama file saat ini agar menu sidebar menyala otomatis
$current_page = basename($_SERVER['PHP_SELF']);

function sanitize_text($text) {
    return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
}

if (!isset($_SESSION['order_history'])) {
    $_SESSION['order_history'] = [];
}

if (isset($_GET['order_complete']) && $_GET['order_complete'] === '1' && !empty($_GET['order_id'])) {
    $orderId = sanitize_text($_GET['order_id']);

    if (!isset($_SESSION['order_history'][$orderId])) {
        $shippingLabel = 'Lainnya';
        if (isset($_GET['shipping'])) {
            $shipping = strtolower(trim($_GET['shipping']));
            if ($shipping === 'ambil') {
                $shippingLabel = 'Ambil di Toko';
            } elseif ($shipping === 'spx') {
                $shippingLabel = 'SPX';
            } elseif ($shipping === 'gosend') {
                $shippingLabel = 'GoSend';
            } else {
                $shippingLabel = ucfirst($shipping);
            }
        }

        $_SESSION['order_history'][$orderId] = [
            'order_id' => $orderId,
            'service_name' => sanitize_text($_GET['product'] ?? 'Produk'),
            'quantity' => sanitize_text($_GET['quantity'] ?? '1'),
            'total' => sanitize_text($_GET['total'] ?? '0'),
            'payment_method' => sanitize_text($_GET['payment_method'] ?? '-'),
            'shipping' => $shippingLabel,
            'recipient_name' => sanitize_text($_GET['recipient_name'] ?? '-'),
            'recipient_phone' => sanitize_text($_GET['recipient_phone'] ?? '-'),
            'recipient_address' => sanitize_text($_GET['recipient_address'] ?? '-'),
            'status' => sanitize_text($_GET['order_status'] ?? 'Selesai'),
            'payment_note' => sanitize_text($_GET['payment_note'] ?? ''),
            'date' => date('d F Y'),
            'time' => date('H:i'),
        ];
    }

    header('Location: riwayat.php');
    exit;
}

$orderHistory = array_values($_SESSION['order_history']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <style>
        /* --- CSS VARIABLE (SAMA SEPERTI SEBELUMNYA) --- */
        :root{
            --bg-main:#2f0c58;
            --bg-main-dark:#20103a;
            --bg-sidebar:#240744;
            --bg-card:#14062b; /* Warna Kartu di Gambar */
            --accent:#a54ccf;
            --text:#f4f4f4;
            --text-soft:#cdcdcd;
            --lime:#82ff5b; /* Warna Hijau Tombol */
        }
        *{margin:0;padding:0;box-sizing:border-box;}

        body{ font-family:"Poppins",sans-serif; background:#111; color:var(--text); }
        .app{ display:flex; min-height:100vh; background:var(--bg-main); }
       
        /* --- SIDEBAR STYLE (TETAP) --- */
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

        /* --- MAIN CONTENT STYLE --- */
        .main{
            flex:1; padding:20px 40px; background:var(--bg-main);
            display:flex; flex-direction:column; margin-left:210px;
        }

        /* Header Kanan (Jasa, Maps, User) */
        .header-top {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px;
        }
        .page-title { font-size: 28px; font-weight: 500; }
        .top-nav { display: flex; gap: 20px; align-items: center; font-size: 14px; }
        .top-nav a { text-decoration: none; color: var(--text-soft); }
        .top-nav a:hover { color: var(--lime); }
        .user-icon { font-size: 18px; }

        /* --- CARD STYLE (SESUAI GAMBAR) --- */
        .order-card {
            background-color: var(--bg-card);
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 20px;
            position: relative;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            display: flex;
            justify-content: space-between; /* Kiri konten, Kanan status/tombol */
        }

        .card-left { flex: 1; display: flex; flex-direction: column; gap: 4px; }
        .order-id { font-size: 16px; font-weight: 500; color: var(--text); margin-bottom: 5px; }
        .service-name { font-size: 18px; font-weight: 400; color: var(--text); margin-bottom: 2px; }
        .sub-info { font-size: 14px; color: var(--text-soft); margin-bottom: 2px;}
        .price { font-size: 16px; font-weight: 500; margin-top: 5px; color: var(--text); }
        
        .payment-method { display: flex; align-items: center; gap: 5px; margin-top: 5px; color: var(--text-soft); font-size: 14px; }

        .card-right {
            display: flex; flex-direction: column; 
            justify-content: space-between; 
            align-items: flex-end;
            min-width: 180px;
        }

        .order-date { font-size: 12px; color: var(--text-soft); margin-bottom: 10px; }

        .status-badge {
            display: flex; align-items: center; gap: 5px;
            font-size: 14px; font-weight: 500; margin-bottom: auto; /* Push buttons down */
        }
        .status-success { color: var(--lime); }
        .status-shipping { color: var(--text-soft); }

        /* Tombol Aksi */
        .action-buttons { display: flex; gap: 10px; margin-top: 15px; }
        
        .btn {
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
        }
        
        /* Tombol "Lihat Detail" (Dark) */
        .btn-detail {
            background: #2a2a2a; /* Abu-abu gelap */
            color: var(--lime);
            border: 1px solid transparent;
        }
        .btn-detail:hover { background: #333; }

        /* Tombol Utama (Hijau) */
        .btn-primary {
            background: var(--lime);
            color: #000;
            border: none;
        }
        .btn-primary:hover { opacity: 0.9; }


        /* --- MODAL DETAIL (POPUP) --- */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; z-index: 100; left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.7);
            align-items: center; justify-content: center;
        }
        
        .modal-content {
            background-color: var(--bg-card);
            padding: 0; /* Padding diatur di dalam header/body */
            border-radius: 12px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 25px 30px 10px;
        }
        .modal-header h2 { font-size: 28px; font-weight: 500; }

        .modal-body {
            padding: 10px 30px 40px;
        }
        
        /* Layout Grid Detail sesuai gambar */
        .detail-row {
            display: flex; justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .detail-label { color: var(--text-soft); }
        .detail-value { text-align: right; color: var(--text); font-weight: 400; }
        
        .detail-price {
            font-size: 18px; font-weight: 500; margin-top: 20px;
            text-align: right; width: 100%; display: block;
        }
        
        .close-btn {
            float: right; font-size: 24px; cursor: pointer; color: var(--text-soft); margin-top: -10px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar { width: 60px; padding: 12px 6px; }
            .brand { display: none; }
            .sidebar-footer { display: none; }
            .menu a { font-size: 0; padding: 10px; justify-content: center; }
            .menu a i { font-size: 18px; width: auto; }
            .main { margin-left: 60px; padding: 16px 20px; }
            .order-card { flex-direction: column; gap: 15px; }
            .card-right { align-items: flex-start; min-width: auto; }
            .action-buttons { width: 100%; justify-content: space-between; }
            .order-date { position: static; }
        }

        @media (max-width: 600px) {
            .main { padding: 12px 10px; }
            .page-title { font-size: 20px; }
            .order-card { padding: 14px; }
            .btn { padding: 6px 12px; font-size: 11px; }
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
        
        <div class="header-top">
            <h1 class="page-title">Riwayat Pemesanan</h1>
            <!-- <nav class="top-nav">
                <a href="#">Jasa</a>
                <a href="#">Maps</a>
                <a href="#" class="user-icon"><i class="fa-regular fa-user"></i></a>
            </nav> -->
        </div>

        <?php if (empty($orderHistory)): ?>
            <div class="order-card">
                <div class="card-left">
                    <div class="order-id">Belum Ada Riwayat</div>
                    <div class="service-name">Tidak ada pesanan selesai</div>
                    <div class="sub-info">Lakukan pembelian dan pembayaran agar pesanan muncul di sini.</div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($orderHistory as $order): ?>
                <div class="order-card">
                    <div class="card-left">
                        <div class="order-id"><?= sanitize_text($order['order_id']) ?></div>
                        <div class="service-name"><?= sanitize_text($order['service_name']) ?></div>
                        <div class="sub-info">Jumlah: <?= sanitize_text($order['quantity']) ?></div>
                        <div class="sub-info">Metode: <?= sanitize_text($order['payment_method']) ?></div>
                        <?php if (!empty($order['payment_note'])): ?>
                        <div class="sub-info" style="color:var(--lime); font-weight:600;"><?= sanitize_text($order['payment_note']) ?></div>
                        <?php endif; ?>
                        <div class="sub-info">Pengiriman: <?= sanitize_text($order['shipping']) ?></div>
                        <div class="price">Rp <?= number_format((int)$order['total'], 0, ',', '.') ?></div>
                    </div>

                    <div class="card-right">
                        <div class="order-date"><?= sanitize_text($order['date']) ?> <?= sanitize_text($order['time']) ?></div>
                        <div class="status-badge <?= $order['status'] === 'Selesai' ? 'status-success' : 'status-shipping' ?>">
                            <i class="fa-solid fa-circle-check"></i> <?= sanitize_text($order['status']) ?>
                        </div>
                        <div class="action-buttons">
                            <button class="btn btn-detail" type="button"
                                data-order-id="<?= sanitize_text($order['order_id']) ?>"
                                data-service="<?= sanitize_text($order['service_name']) ?>"
                                data-quantity="<?= sanitize_text($order['quantity']) ?>"
                                data-payment="<?= sanitize_text($order['payment_method']) ?>"
                                data-shipping="<?= sanitize_text($order['shipping']) ?>"
                                data-recipient-name="<?= sanitize_text($order['recipient_name']) ?>"
                                data-recipient-phone="<?= sanitize_text($order['recipient_phone']) ?>"
                                data-recipient-address="<?= sanitize_text($order['recipient_address']) ?>"
                                data-total="<?= sanitize_text($order['total']) ?>"
                                data-date="<?= sanitize_text($order['date']) ?>"
                                data-time="<?= sanitize_text($order['time']) ?>"
                                data-status="<?= sanitize_text($order['status']) ?>"
                                data-payment-note="<?= sanitize_text($order['payment_note'] ?? '') ?>"
                            >Lihat Detail</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </main>
</div>

<div id="orderDetailModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2>Detail Pemesanan</h2>
        </div>
        <div class="modal-body">
            <div class="detail-row">
                <span class="detail-label">NOMOR PEMESANAN</span>
                <span class="detail-value" id="detailOrderId">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">NAMA LAYANAN / PRODUK</span>
                <span class="detail-value" id="detailServiceName">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">JUMLAH</span>
                <span class="detail-value" id="detailQuantity">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">TOTAL HARGA</span>
                <span class="detail-value" id="detailTotal">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">METODE PEMBAYARAN</span>
                <span class="detail-value" id="detailPaymentMethod">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">JENIS PENGIRIMAN</span>
                <span class="detail-value" id="detailShipping">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">NAMA PENERIMA</span>
                <span class="detail-value" id="detailRecipientName">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">NO. HP</span>
                <span class="detail-value" id="detailRecipientPhone">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">ALAMAT</span>
                <span class="detail-value" id="detailRecipientAddress">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">TANGGAL</span>
                <span class="detail-value" id="detailDate">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">WAKTU</span>
                <span class="detail-value" id="detailTime">-</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">STATUS</span>
                <span class="detail-value status-success" id="detailStatus">-</span>
            </div>
            <div class="detail-row" id="detailPaymentNoteRow" style="display:none;">
                <span class="detail-label">KETERANGAN</span>
                <span class="detail-value" id="detailPaymentNote" style="color:var(--lime); font-weight:600;">-</span>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('orderDetailModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('orderDetailModal').style.display = 'none';
    }

    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('orderDetailModal');
            const orderId = this.dataset.orderId || '-';
            const service = this.dataset.service || '-';
            const quantity = this.dataset.quantity || '-';
            const total = this.dataset.total ? 'Rp ' + parseInt(this.dataset.total, 10).toLocaleString('id-ID') : '-';
            const paymentMethod = this.dataset.payment || '-';
            const shipping = this.dataset.shipping || '-';
            const recipientName = this.dataset.recipientName || '-';
            const recipientPhone = this.dataset.recipientPhone || '-';
            const recipientAddress = this.dataset.recipientAddress || '-';
            const date = this.dataset.date || '-';
            const time = this.dataset.time || '-';
            const status = this.dataset.status || 'Selesai';
            const paymentNote = this.dataset.paymentNote || '';

            document.getElementById('detailOrderId').innerText = orderId;
            document.getElementById('detailServiceName').innerText = service;
            document.getElementById('detailQuantity').innerText = quantity;
            document.getElementById('detailTotal').innerText = total;
            document.getElementById('detailPaymentMethod').innerText = paymentMethod;
            document.getElementById('detailShipping').innerText = shipping;
            document.getElementById('detailRecipientName').innerText = recipientName;
            document.getElementById('detailRecipientPhone').innerText = recipientPhone;
            document.getElementById('detailRecipientAddress').innerText = recipientAddress;
            document.getElementById('detailDate').innerText = date;
            document.getElementById('detailTime').innerText = time;
            document.getElementById('detailStatus').innerText = status;
            const noteRow = document.getElementById('detailPaymentNoteRow');
            const noteEl = document.getElementById('detailPaymentNote');
            if (paymentNote && noteRow && noteEl) {
                noteEl.innerText = paymentNote;
                noteRow.style.display = '';
            } else if (noteRow) {
                noteRow.style.display = 'none';
            }

            openModal();
        });
    });

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('orderDetailModal');
        if (event.target === modal) {
            closeModal();
        }
    });
</script>

</body>
</html>