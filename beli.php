<?php include 'header.php';

// Support checkout via cart (cart param) or single product via product/price
$cartData = isset($_GET['cart']) ? json_decode(urldecode($_GET['cart']), true) : null;
$items = is_array($cartData) ? $cartData : [];
$total = 0;
$fromCart = !empty($items);
$initialQty = 1;
if ($fromCart) {
    foreach ($items as $item) {
        $priceNum = preg_replace('/[^0-9]/', '', $item['price'] ?? '0');
        $qty = intval($item['qty'] ?? $item['quantity'] ?? 1);
        $total += intval($priceNum) * $qty;
    }
    $priceFormatted = $total > 0 ? 'Rp ' . number_format($total, 0, ',', '.') : 'Rp 0';
    // Derive a product name for the checkout page when coming from cart
    if (!empty($items)) {
        $firstName = trim((string)($items[0]['name'] ?? 'Produk'));
        if (count($items) === 1) {
            $productName = $firstName;
        } else {
            $productName = $firstName . ' (+'.(count($items)-1).' lainnya)';
        }
    } else {
        $productName = 'Produk';
    }
} else {
    // Ambil data dari URL (single product)
    $productName = isset($_GET['product']) ? $_GET['product'] : '';
    $priceValue = isset($_GET['price']) ? preg_replace('/[^0-9]/', '', $_GET['price']) : 0;
    $priceFormatted = $priceValue > 0 ? 'Rp ' . number_format($priceValue, 0, ',', '.') : 'Rp 0';
    $total = intval($priceValue);
    $initialQty = isset($_GET['qty']) ? max(1, intval($_GET['qty'])) : 1;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beli Produk - <?= sanitize_text($productName ?: 'Produk') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/beli.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Checkout Produk</h1>
            <p>Lengkapi data pembelian dan pilih metode pembayaran di halaman berikutnya.</p>

            <form id="purchaseForm" action="#" method="GET">
                <input type="hidden" name="product" value="<?= sanitize_text($productName) ?>">
                <input type="hidden" name="price" id="productPrice" value="<?= sanitize_text($priceValue) ?>">
                <input type="hidden" name="total" id="totalPriceInput" value="<?= sanitize_text($priceValue) ?>">
                <input type="hidden" name="payment_method" id="paymentMethodInput" value="">

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control readonly-input" value="<?= sanitize_text($productName ?: 'Tidak ada produk') ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input type="text" class="form-control readonly-input" value="<?= sanitize_text($priceFormatted) ?>" readonly>
                </div>

                <?php if (!$fromCart): ?>
                <div class="form-group" id="quantityGroup">
                    <label>Jumlah Produk</label>
                    <div class="qty-wrapper">
                        <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="<?= $initialQty ?>">
                        <div class="qty-spinners">
                            <button type="button" class="qty-spin-btn" id="qtyPlus"><i class="fa-solid fa-chevron-up"></i></button>
                            <button type="button" class="qty-spin-btn" id="qtyMinus"><i class="fa-solid fa-chevron-down"></i></button>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <!-- When checking out from cart, quantity editing is handled in cart. -->
                <?php endif; ?>

                <div class="form-group">
                    <label>Jenis Pengiriman</label>
                    <div class="radio-group">
                        <label class="radio-item"><input type="radio" name="shipping" value="gosend" checked> Dikirim menggunakan GoSend</label>
                        <label class="radio-item"><input type="radio" name="shipping" value="spx"> Dikirim menggunakan SPX</label>
                        <label class="radio-item"><input type="radio" name="shipping" value="ambil"> Ambil di Toko</label>
                    </div>
                </div>

                <div class="contact-fields" id="contactFields">
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input type="text" id="recipientName" name="recipient_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" id="recipientPhone" name="recipient_phone" class="form-control">
                    </div>
                    <div class="form-group" id="recipientAddressGroup">
                        <label>Alamat Pengiriman</label>
                        <textarea id="recipientAddress" name="recipient_address" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="store-address hidden" id="storeAddress">
                    <strong>Ambil di Toko</strong>
                    <p>Silakan ambil pesanan Anda di:</p>
                    <p>Jl. Malioboro No.10, Yogyakarta<br>Kode Pos 55281<br>Jam buka: 10.00 - 20.00 WIB</p>
                </div>

                <div class="summary">
                    <h2>Ringkasan Pembayaran</h2>
                        <?php if ($fromCart): ?>
                            <div id="cartSummaryItems">
                                <?php foreach ($items as $it): ?>
                                    <p><?= htmlspecialchars($it['name'] ?? 'Produk') ?> × <?= intval($it['qty'] ?? $it['quantity'] ?? 1) ?> — <?= htmlspecialchars($it['price'] ?? '-') ?></p>
                                <?php endforeach; ?>
                            </div>
                            <p>Jenis Pengiriman: <span id="summaryShipping">GoSend</span></p>
                            <p id="summaryOngkir">Ongkir: <span id="summaryOngkirVal">Rp 15.000</span></p>
                            <p id="summaryAddress"></p>
                            <strong>Total Harga: <span id="summaryTotal"><?= sanitize_text($priceFormatted) ?></span></strong>
                        <?php else: ?>
                            <p>Jumlah Produk: <span id="summaryQuantity">1</span></p>
                            <p>Harga Satuan: <span id="summaryPrice"><?= sanitize_text($priceFormatted) ?></span></p>
                            <p>Jenis Pengiriman: <span id="summaryShipping">GoSend</span></p>
                            <p id="summaryOngkir">Ongkir: <span id="summaryOngkirVal">Rp 15.000</span></p>
                            <strong>Total Harga: <span id="summaryTotal"><?= sanitize_text($priceFormatted) ?></span></strong>
                        <?php endif; ?>
                </div>

                <div class="actions">
                    <button type="button" id="openPaymentButton" class="btn-submit">Pilih Metode Pembayaran</button>
                    <a href="Dashboard.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>

                    <div class="payment-summary" id="paymentSummary">
                    <h3>Metode Pembayaran Dipilih</h3>
                    <p>Metode: <strong id="summaryPaymentMethod">Belum memilih</strong></p>
                    <p>Total yang harus dibayar: <strong id="summaryTotalMethod"><?= sanitize_text($priceFormatted) ?></strong></p>
                    <button type="button" id="payNowButton" class="pay-now">Bayar Sekarang</button>
                </div>
            </form>
            <p class="hint">Pilih metode pembayaran dari popup. Setelah memilih, klik Bayar Sekarang untuk menuju `metode.php` dengan total harga yang sudah dihitung.</p>
        </div>
        <div class="payment-modal" id="paymentModal">
            <div class="payment-modal-card">
                <h2>Pilih Metode Pembayaran</h2>
                <div class="payment-method-list">
                    <div class="payment-method-card" data-method="Cash">
                        <div>
                            <span>Cash</span>
                            <small>Bayar langsung di kasir</small>
                        </div>
                        <span>?</span>
                    </div>
                    <div class="payment-method-card" data-method="QRIS">
                        <div>
                            <span>QRIS</span>
                            <small>Scan dan bayar melalui QR</small>
                        </div>
                        <span>?</span>
                    </div>
                    <div class="payment-method-card" data-method="Transfer Bank">
                        <div>
                            <span>Transfer Bank</span>
                            <small>Transfer melalui ATM/mobile banking</small>
                        </div>
                        <span>?</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const purchaseForm = document.getElementById('purchaseForm');
        const quantityInput = document.getElementById('quantity');
        const qtyMinus = document.getElementById('qtyMinus');
        const qtyPlus = document.getElementById('qtyPlus');
        if (qtyMinus) {
            qtyMinus.addEventListener('click', function() {
                let v = Math.max(1, parseInt(quantityInput.value || '1', 10) - 1);
                quantityInput.value = v;
                updateSummary();
            });
        }
        if (qtyPlus) {
            qtyPlus.addEventListener('click', function() {
                let v = parseInt(quantityInput.value || '1', 10) + 1;
                quantityInput.value = v;
                updateSummary();
            });
        }
        const summaryQuantity = document.getElementById('summaryQuantity');
        const summaryShipping = document.getElementById('summaryShipping');
        const summaryOngkirVal = document.getElementById('summaryOngkirVal');
        const summaryOngkirRow = document.getElementById('summaryOngkir');
        const summaryAddress = document.getElementById('summaryAddress');
        const summaryTotal = document.getElementById('summaryTotal');
        const totalPriceInput = document.getElementById('totalPriceInput');
        const productPriceValue = parseInt(document.getElementById('productPrice').value || '0', 10);
        const openPaymentButton = document.getElementById('openPaymentButton');
        const paymentModal = document.getElementById('paymentModal');
        const paymentSummary = document.getElementById('paymentSummary');
        const summaryPaymentMethod = document.getElementById('summaryPaymentMethod');
        const summaryTotalMethod = document.getElementById('summaryTotalMethod');
        const paymentMethodInput = document.getElementById('paymentMethodInput');
        const payNowButton = document.getElementById('payNowButton');
        const contactFields = document.getElementById('contactFields');
        const storeAddress = document.getElementById('storeAddress');
        const recipientName = document.getElementById('recipientName');
        const recipientPhone = document.getElementById('recipientPhone');
        const recipientAddress = document.getElementById('recipientAddress');
        const recipientAddressGroup = document.getElementById('recipientAddressGroup');
        const fromCart = <?= $fromCart ? 'true' : 'false' ?>;

        const ONGKIR = { gosend: 15000, spx: 10000, ambil: 0 };

        function getOngkir() {
            const sel = document.querySelector('input[name="shipping"]:checked')?.value || 'gosend';
            return ONGKIR[sel] ?? 0;
        }

        function formatRupiah(value) {
            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function updateSummary() {
            const ongkir = getOngkir();
            const ongkirLabel = ongkir > 0 ? formatRupiah(ongkir) : 'Gratis';
            if (summaryOngkirVal) summaryOngkirVal.textContent = ongkirLabel;
            if (summaryOngkirRow) summaryOngkirRow.style.display = (getOngkir() || true) ? '' : 'none';
            if (fromCart) {
                // total already calculated server-side, add ongkir
                const base = <?= intval($total) ?>;
                const grand = base + ongkir;
                totalPriceInput.value = grand;
                summaryTotal.textContent = formatRupiah(grand);
                summaryTotalMethod.textContent = formatRupiah(grand);
                // summary address depends on shipping selection
                const shippingSel = document.querySelector('input[name="shipping"]:checked')?.value || 'gosend';
                if (shippingSel === 'ambil') {
                    summaryAddress.textContent = 'Ambil di Toko: Jl. Malioboro No.10, Yogyakarta — Jam buka: 10.00 - 20.00 WIB';
                } else {
                    summaryAddress.textContent = '';
                }
            } else {
                const quantity = Math.max(1, parseInt(quantityInput.value || '1', 10));
                const subtotal = productPriceValue * quantity;
                const grand = subtotal + ongkir;
                if (summaryQuantity) summaryQuantity.textContent = quantity;
                if (summaryTotal) summaryTotal.textContent = formatRupiah(grand);
                if (summaryTotalMethod) summaryTotalMethod.textContent = formatRupiah(grand);
                totalPriceInput.value = grand;
                // when single-product checkout, update summary address when pickup
                const shippingSel = document.querySelector('input[name="shipping"]:checked')?.value || 'gosend';
                if (summaryAddress) {
                    if (shippingSel === 'ambil') {
                        summaryAddress.textContent = 'Ambil di Toko: Jl. Malioboro No.10, Yogyakarta — Jam buka: 10.00 - 20.00 WIB';
                    } else {
                        summaryAddress.textContent = '';
                    }
                }
            }
        }

        // Select a payment method (mark selected and disable others). Actual submit happens on Pay Now.
        function selectPaymentMethod(method, cardEl) {
            // mark selected card
            document.querySelectorAll('.payment-method-card').forEach(c => {
                c.classList.remove('selected');
                c.classList.remove('disabled');
            });
            if (cardEl) cardEl.classList.add('selected');
            // disable other cards
            document.querySelectorAll('.payment-method-card').forEach(c => {
                if (c !== cardEl) c.classList.add('disabled');
            });
            paymentMethodInput.value = method;
            summaryPaymentMethod.textContent = method;
            paymentSummary.classList.add('active');
            paymentModal.classList.remove('active');
            // enable pay button (it will perform final validation and submit)
            // do not clear cart here; only clear after successful submit to avoid data loss
        }

        if (quantityInput) quantityInput.addEventListener('input', updateSummary);

        function toggleShippingFields(method) {
            if (method === 'ambil') {
                recipientAddressGroup.classList.add('hidden');
                recipientAddress.disabled = true;
                recipientAddress.required = false;
                recipientAddress.removeAttribute('name');
                storeAddress.classList.remove('hidden');
                recipientName.disabled = false;
                recipientName.required = true;
                recipientPhone.disabled = false;
                recipientPhone.required = true;
                let pickupInput = document.getElementById('pickupStoreInput');
                if (!pickupInput) {
                    pickupInput = document.createElement('input');
                    pickupInput.type = 'hidden';
                    pickupInput.id = 'pickupStoreInput';
                    pickupInput.name = 'pickup_store';
                    purchaseForm.appendChild(pickupInput);
                }
                pickupInput.value = 'Jl. Malioboro No.10, Yogyakarta - Jam buka: 10.00 - 20.00 WIB';
                if (summaryShipping) summaryShipping.textContent = 'Ambil di Toko';
                if (summaryAddress) summaryAddress.textContent = 'Ambil di Toko: Jl. Malioboro No.10, Yogyakarta — Jam buka: 10.00 - 20.00 WIB';
            } else {
                recipientAddressGroup.classList.remove('hidden');
                recipientAddress.disabled = false;
                recipientAddress.required = true;
                recipientAddress.setAttribute('name', 'recipient_address');
                storeAddress.classList.add('hidden');
                recipientName.disabled = false;
                recipientName.required = true;
                recipientPhone.disabled = false;
                recipientPhone.required = true;
                const pickupInput = document.getElementById('pickupStoreInput');
                if (pickupInput) pickupInput.remove();
                if (summaryShipping) summaryShipping.textContent = (method === 'spx' ? 'SPX' : 'GoSend');
                if (summaryAddress) summaryAddress.textContent = '';
            }
        }

        function resetPaymentSelection() {
            paymentMethodInput.value = '';
            paymentSummary.classList.remove('active');
            document.querySelectorAll('.payment-method-card').forEach(c => {
                c.classList.remove('selected');
                c.classList.remove('disabled');
            });
        }

        document.querySelectorAll('input[name="shipping"]').forEach(input => {
            input.addEventListener('change', function () {
                toggleShippingFields(this.value);
                updateSummary();
                resetPaymentSelection();
            });
        });

        const initialShipping = document.querySelector('input[name="shipping"]:checked')?.value || 'gosend';
        toggleShippingFields(initialShipping);
        updateSummary();

        openPaymentButton.addEventListener('click', () => {
            updateSummary();
            const product = document.querySelector('input[name="product"]').value;
            const total = totalPriceInput.value;
            const quantity = fromCart ? '' : (quantityInput ? quantityInput.value : '1');
            const shipping = document.querySelector('input[name="shipping"]:checked')?.value || 'gosend';
            const rName  = recipientName  ? recipientName.value.trim()  : '';
            const rPhone = recipientPhone ? recipientPhone.value.trim() : '';
            const rAddr  = recipientAddress ? recipientAddress.value.trim() : '';

            // Validate before leaving
            if (!validateForm()) return;

            const params = new URLSearchParams();
            params.set('product', product);
            params.set('total', total);
            if (quantity) params.set('quantity', quantity);
            params.set('shipping', shipping);
            params.set('shipping_cost', getOngkir());
            if (rName)  params.set('recipient_name',    rName);
            if (rPhone) params.set('recipient_phone',   rPhone);
            if (rAddr)  params.set('recipient_address', rAddr);
            window.location.href = 'metode.php?' + params.toString();
        });

        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.addEventListener('click', function () {
                // prevent selecting disabled cards
                if (this.classList.contains('disabled')) return;
                const method = this.dataset.method || 'Tidak Diketahui';
                selectPaymentMethod(method, this);
            });
        });

        payNowButton.addEventListener('click', () => {
            if (!paymentMethodInput.value) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                return;
            }
            if (!validateForm()) return;
            // final submit: if checking out from cart, include cart JSON as hidden input
            if (fromCart) {
                try {
                    const cartJson = encodeURIComponent(JSON.stringify(<?= json_encode($items) ?>));
                    // create hidden input with cart data
                    let cartInput = document.getElementById('cartJsonInput');
                    if (!cartInput) {
                        cartInput = document.createElement('input');
                        cartInput.type = 'hidden';
                        cartInput.name = 'cart_json';
                        cartInput.id = 'cartJsonInput';
                        purchaseForm.appendChild(cartInput);
                    }
                    cartInput.value = cartJson;
                } catch (e) {
                    // ignore
                }
            }
            // clear cart after preparing submission (optional)
            if (fromCart && window.sphinxCart) window.sphinxCart.clear();
            purchaseForm.action = 'metode.php';
            purchaseForm.submit();
        });

        function validateForm(){
            // ensure required contact fields are filled based on shipping selection
            const shipping = document.querySelector('input[name="shipping"]:checked')?.value || 'gosend';
            if (shipping === 'ambil'){
                if (!recipientName.value.trim() || !recipientPhone.value.trim()){
                    alert('Lengkapi nama dan nomor HP untuk pengambilan di toko.'); return false;
                }
            } else {
                if (!recipientName.value.trim() || !recipientPhone.value.trim() || !recipientAddress.value.trim()){
                    alert('Lengkapi nama, nomor HP, dan alamat pengiriman terlebih dahulu.'); return false;
                }
            }
            return true;
        }

        paymentModal.addEventListener('click', event => {
            if (event.target === paymentModal) {
                paymentModal.classList.remove('active');
            }
        });

        updateSummary();
    </script>
</body>
</html>
