<?php
session_start();
require_once 'firebase.php';

$username = $_SESSION['user'] ?? "@sphnx_piercing";

// Mendeteksi nama file saat ini agar menu sidebar menyala otomatis
$current_page = basename($_SERVER['PHP_SELF']);

function sanitize_text($text) {
    return htmlspecialchars(trim($text), ENT_QUOTES, 'UTF-8');
}

if (isset($_GET['order_complete']) && $_GET['order_complete'] === '1' && !empty($_GET['order_id'])) {
    $orderId = sanitize_text($_GET['order_id']);

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

    $orderData = [
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
        'username' => $username
    ];

    // Simpan ke Firebase
    $firestore->saveDocument('orders', $orderId, $orderData);
}

// Ambil order history dari Firebase untuk user ini
$orderHistory = [];
$allOrders = $firestore->getCollection('orders');
foreach ($allOrders as $orderId => $order) {
    if ($order['username'] === $username) {
        $orderHistory[$orderId] = $order;
    }
}

$orderHistory = array_values($orderHistory);

include 'header.php';
?>
    <link rel="stylesheet" href="css/riwayat.css">

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
            <div class="empty-state">
                <i class="fa-regular fa-bag-shopping"></i>
                <p>Belum ada riwayat pemesanan.<br>Lakukan pembelian produk agar muncul di sini.</p>
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
                        <?php
                            $st = $order['status'];
                            if ($st === 'Selesai') { $stClass = 'status-done'; $stIcon = 'fa-circle-check'; }
                            elseif ($st === 'Dalam Pengiriman') { $stClass = 'status-ship'; $stIcon = 'fa-truck'; }
                            elseif ($st === 'Sedang Dikemas') { $stClass = 'status-pack'; $stIcon = 'fa-box'; }
                            else { $stClass = 'status-new'; $stIcon = 'fa-inbox'; }
                        ?>
                        <div class="status-badge <?= $stClass ?>">
                            <i class="fa-solid <?= $stIcon ?>"></i> <?= sanitize_text($st) ?>
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
            <!-- Status Stepper -->
            <div class="status-stepper" id="detailStepper">
                <div class="step" data-step="Pesanan Masuk">
                    <div class="step-dot"><i class="fa-solid fa-inbox"></i></div>
                    <div class="step-label">Pesanan Masuk</div>
                </div>
                <div class="step-line"></div>
                <div class="step" data-step="Sedang Dikemas">
                    <div class="step-dot"><i class="fa-solid fa-box"></i></div>
                    <div class="step-label">Sedang Dikemas</div>
                </div>
                <div class="step-line"></div>
                <div class="step" data-step="Dalam Pengiriman">
                    <div class="step-dot"><i class="fa-solid fa-truck"></i></div>
                    <div class="step-label">Dalam Pengiriman</div>
                </div>
                <div class="step-line"></div>
                <div class="step" data-step="Selesai">
                    <div class="step-dot"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="step-label">Selesai</div>
                </div>
            </div>
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

            // Update stepper
            const statusOrder = ['Pesanan Masuk', 'Sedang Dikemas', 'Dalam Pengiriman', 'Selesai'];
            const currentIdx = statusOrder.indexOf(status);
            document.querySelectorAll('#detailStepper .step').forEach((step, i) => {
                step.classList.remove('step-done', 'step-active');
                if (i < currentIdx) step.classList.add('step-done');
                else if (i === currentIdx) step.classList.add('step-active');
            });
            document.querySelectorAll('#detailStepper .step-line').forEach((line, i) => {
                line.classList.toggle('line-done', i < currentIdx);
            });

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