# Sistem Pemesanan Sphinx Piercing - Dokumentasi

## 📋 Alur Pemesanan Lengkap

### 1. **Dashboard** → **Halaman Beli** (beli.php)
- User memilih produk/jasa dari Dashboard
- Sistem mengirim parameter: `product` (nama produk) dan `price` (harga satuan)
- Halaman beli menampilkan:
  - Nama dan harga produk
  - Input jumlah produk
  - Pilihan jenis pengiriman (GoSend, SPX, Ambil di Toko)
  - Data penerima (nama, no HP, alamat)
  - Ringkasan pembayaran

### 2. **Halaman Beli** → **Metode Pembayaran** (metode.php)
- User mengisi form dan klik "Bayar Sekarang"
- Form dikirim ke metode.php dengan parameter:
  - `product`: Nama produk
  - `total`: Total harga (hasil perhitungan)
  - `quantity`: Jumlah produk
  - `shipping`: Jenis pengiriman
  - `recipient_name`: Nama penerima
  - `recipient_phone`: Nomor HP
  - `recipient_address`: Alamat pengiriman

### 3. **Metode Pembayaran** (metode.php) - Proses Pembayaran
- Sistem menampilkan 3 pilihan metode pembayaran:
  - **Cash**: Bayar tunai di toko
  - **Transfer Bank**: Detail transfer ke rekening BCA
  - **QRIS**: QR Code untuk pembayaran digital

#### Fitur Metode Pembayaran:
- **Tampilan Real-Time**: Setelah memilih metode, detail langsung tampil di halaman (bukan modal)
- **Timer Pembayaran**:
  - Cash: 60 menit
  - Transfer & QRIS: 5 menit
- **Validasi**: User harus memilih metode sebelum klik "Bayar Sekarang"
- **Status Sukses**: Tampilkan animasi check mark dan pesan "Pembayaran Berhasil"

### 4. **Metode Pembayaran** → **Riwayat Pemesanan** (riwayat.php)
- Setelah pembayaran berhasil, otomatis redirect ke riwayat.php dengan:
  - `order_id`: ID unik order (format: order_TIMESTAMP)
  - `order_complete`: Flag pembayaran selesai (1)
  - `product`: Nama produk
  - `total`: Total harga
  - `payment_method`: Metode pembayaran (cash, transfer, qris)
  - `quantity`: Jumlah produk
  - `shipping`: Jenis pengiriman
  - `recipient_name`: Nama penerima
  - `recipient_phone`: Nomor HP
  - `recipient_address`: Alamat

### 5. **Riwayat Pemesanan** (riwayat.php) - Penyimpanan & Tampilan
- Sistem menerima data order dari URL
- Menyimpan order ke session `$_SESSION['order_history']`
- Menampilkan order dalam bentuk kartu dengan informasi:
  - Nomor order
  - Nama produk
  - Jumlah
  - Metode pembayaran
  - Jenis pengiriman
  - Total harga
  - Tanggal & waktu
  - Status (Selesai)

#### Modal Detail Order:
- User klik "Lihat Detail" untuk melihat info lengkap order
- Modal menampilkan semua data order (produk, penerima, alamat, dll)

---

## 🔄 Struktur Data Order

```php
[
    'order_id' => 'order_1713426000000',
    'service_name' => 'Pasang Anting Berlian',
    'quantity' => '2',
    'total' => '250000',
    'payment_method' => 'transfer',  // 'cash', 'transfer', 'qris'
    'shipping' => 'GoSend',           // 'GoSend', 'SPX', 'Ambil di Toko'
    'recipient_name' => 'Budi Santoso',
    'recipient_phone' => '08123456789',
    'recipient_address' => 'Jl. Malioboro No. 123',
    'status' => 'Selesai',
    'date' => '01 January 2024',
    'time' => '14:30'
]
```

---

## 💳 Detail Metode Pembayaran

### Cash (Tunai)
- Lokasi: Studio Piercing Sphinx
- Alamat: Jl. Malioboro No.10, Yogyakarta
- Jam Buka: 10.00 - 20.00 WIB
- **Timeout**: 60 menit

### Transfer Bank
- **Bank**: BCA
- **Rekening**: 1325 6784 321
- **Atas Nama**: SPHINX PIERCING
- **Timeout**: 5 menit

### QRIS
- QR Code dinamis (dihasilkan via API QRServer)
- Berlaku untuk semua aplikasi e-wallet
- **Timeout**: 5 menit

---

## 🎨 User Interface Improvements

### Metode Pembayaran Page:
1. **3 Kartu Pilihan**: Setiap metode ditampilkan dalam kartu interaktif
2. **Highlight Aktif**: Kartu yang dipilih berwarna hijau (`--lime`)
3. **Detail Dinamis**: Setelah pilih metode, detail muncul di panel kanan:
   - QR Code untuk QRIS
   - Detail bank untuk Transfer
   - Informasi toko untuk Cash
4. **Timer Visual**: Menampilkan waktu tersisa dalam format `MM:SS`
5. **Tombol Aksi**: "Bayar Sekarang" disabled sampai ada metode yang dipilih

### Riwayat Pemesanan Page:
1. **Kartu Order**: Setiap order ditampilkan dalam kartu dengan:
   - Info kiri: Nomor, nama produk, jumlah, metode, pengiriman, harga
   - Info kanan: Tanggal/waktu, status badge, tombol "Lihat Detail"
2. **Status Badge**: "✓ Selesai" berwarna hijau
3. **Modal Detail**: Popup menampilkan info lengkap order

---

## 🔐 Keamanan & Validasi

### Input Sanitization:
- Semua input dari URL di-sanitasi dengan `htmlspecialchars()`
- Validasi tipe data (product, price, quantity)

### Session Management:
- Order disimpan di session `$_SESSION['order_history']`
- Setiap order punya unique ID (timestamp + random)
- Session data persistent per user/browser

### Error Handling:
- Jika tidak ada transaksi aktif, tombol pembayaran disabled
- Jika waktu habis, tampilkan alert dan reset form
- Jika parameter hilang, gunakan default value

---

## 📱 Responsive Design

- **Desktop**: Sidebar tetap, main content flex
- **Tablet/Mobile**: Sidebar jadi horizontal, layout stacked
- **Grid Responsive**: Payment options 3 kolom → 1 kolom
- **Modal Full-width**: Max 90% width di mobile

---

## 🚀 Teknologi yang Digunakan

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Icons**: Font Awesome 6.6.0
- **Font**: Poppins (Google Fonts)
- **API**: QRServer (untuk generate QR Code)
- **Session**: PHP Native Session Storage

---

## 📝 Catatan Penting

1. **Order ID**: Dibuat otomatis saat redirect ke riwayat.php
2. **Payment Method Mapping**: 
   - JavaScript: 'cash', 'transfer', 'qris'
   - Display: 'Cash', 'Transfer Bank', 'QRIS'
3. **Shipping Labels**:
   - 'gosend' → 'GoSend'
   - 'spx' → 'SPX'
   - 'ambil' → 'Ambil di Toko'
4. **Default Values**: Jika data tidak ada, gunakan '-' atau sensible defaults
5. **Date Format**: Indonesian format (01 January 2024)

---

## ✅ Checklist Fungsionalitas

- [x] Product selection di Dashboard
- [x] Form isian lengkap di beli.php
- [x] Payment method selection di metode.php
- [x] Display detail metode pembayaran
- [x] Timer countdown untuk setiap metode
- [x] QR code generation untuk QRIS
- [x] Bank details display untuk Transfer
- [x] Store info display untuk Cash
- [x] Validation sebelum submit
- [x] Success animation & message
- [x] Redirect otomatis ke riwayat
- [x] Order storage di session
- [x] Order display di riwayat.php
- [x] Order detail modal
- [x] Responsive design
- [x] Input sanitization

---

**Last Updated**: 2024
**Version**: 1.0.1
**Status**: ✅ Production Ready
