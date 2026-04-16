<?php
$username = "@sphnx_piercing";
$full_name = "Aseng Dzaky";
$email = "AsengDzaky@gmail.com";
$phone = "08673526737";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_profile'])) {
	$full_name = trim($_POST['full_name'] ?? $full_name);
	$email = trim($_POST['email'] ?? $email);
	$phone = trim($_POST['phone'] ?? $phone);
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Pengaturan Akun - Sphinx Piercing</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

	<style>
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
		}
		*{margin:0;padding:0;box-sizing:border-box;}

		body{ font-family:"Poppins",sans-serif; background:#111; color:var(--text); }
		.app{ display:flex; min-height:100vh; background:var(--bg-main); }
		.sidebar{ width:210px; background:var(--bg-sidebar); padding:18px 16px; display:flex; flex-direction:column; align-items:center; border-right:1px solid rgba(0,0,0,.4); position:fixed; left:0; top:0; bottom:0; height:100vh; z-index:60; }
		.brand{ text-align:center; margin-bottom:32px; }
		.brand img{ width:90px;height:90px; border-radius:50%; border:3px solid var(--accent); object-fit:cover; }
		.brand span{ display:block; margin-top:8px; font-size:13px; }
		.menu{ width:100%; list-style:none; flex:1; }
		.menu li{ margin-bottom:14px; }
		.menu a{ display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:999px; font-size:13px; text-decoration:none; color:var(--text-soft); transition:.2s; }
		.menu a i{ width:20px; text-align:center; }
		.menu a:hover, .menu a.active{ background:var(--bg-main-dark); color:var(--lime); }
		.sidebar-footer{ width:100%; margin-top:auto; padding-top:12px; border-top:1px solid rgba(255,255,255,.08); }

		.main{ flex:1; padding:20px 28px; background:var(--bg-main); display:flex; flex-direction:column; margin-left:210px; }
		.topbar{ display:flex; align-items:center; gap:20px; margin-bottom:24px; }
		.search-box{ flex:1; background:var(--accent); padding:10px 16px; border-radius:999px; display:flex; align-items:center; gap:10px; }
		.search-box input{ flex:1; border:none; outline:none; background:transparent; color:var(--text); font-size:14px; }
		.top-links{ display:flex; align-items:center; gap:24px; font-size:14px; }
		.top-links a{ text-decoration:none; color:var(--text-soft); }
		.top-links a:hover{ color:var(--lime); }
		.top-icons{ display:flex; align-items:center; gap:16px; font-size:18px; }

		/* Profil card */
		.profile-section{ max-width:900px; }
		.section-title{ background:transparent; color:var(--lime); padding:10px 12px; border-radius:6px; margin-bottom:18px; font-size:18px; }
		.profile-card{ background:var(--bg-card); padding:24px; border-radius:10px; display:flex; align-items:flex-start; justify-content:space-between; gap:20px; }
		.profile-details{ color:var(--text); font-size:16px; line-height:1.8; }
		.profile-details b{ display:block; color:var(--lime); margin-bottom:6px; font-size:18px; }
		.edit-btn{ background:var(--accent); color:var(--text); border:none; padding:8px 14px; border-radius:8px; cursor:pointer; align-self:flex-start; }
		.edit-btn:hover{ background:var(--accent-soft); }

		/* Modal styles */
		.modal-overlay{ position:fixed; inset:0; background:rgba(0,0,0,0.6); display:flex; align-items:center; justify-content:center; z-index:120; }
		.modal{ background:var(--bg-main-dark); padding:22px; border-radius:12px; width:420px; box-shadow:0 8px 30px rgba(0,0,0,0.6); }
		.modal-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; }
		.modal-header h3{ color:var(--lime); font-weight:600; }
		.modal-close{ background:transparent; border:none; color:var(--text); font-size:22px; cursor:pointer; }
		.modal-form input{ width:100%; padding:14px; margin-bottom:14px; border-radius:12px; border:none; background:#e6e6e6; color:#111; }
		.save-btn{ background:#6f3b84; color:var(--lime); border:none; padding:12px 26px; border-radius:10px; cursor:pointer; font-size:18px; }
		.save-btn:hover{ opacity:.95; }
		.sr-only{ position:absolute; left:-9999px; }

		@media (max-width: 900px) {
			.app {
				flex-direction: column;
			}
			.sidebar {
				flex-direction: row;
				height: auto;
				width: 100%;
				overflow-x: auto;
				position: static;
			}
			.main {
				margin-left: 0;
			}
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
			<li><a href="dashboard.php" class="<?= ($current_page == 'Dashboard.php' || $current_page == 'dashboard.php') ? 'active' : '' ?>"><i class="fa-solid fa-house"></i>Dashboard</a></li>
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
				<input type="text" placeholder="Profil Pengguna">
			</div>
			<div class="top-links">
				<a href="#">Produk</a>
				<a href="#">Jasa</a>
				<a href="#">Maps</a>
			</div>
			<div class="top-icons">
				<i class="fa-regular fa-bell"></i>
				<i class="fa-regular fa-user"></i>
			</div>
		</div>

		<section class="profile-section">
			<div class="section-title">Profil Pengguna</div>

			<div class="profile-card">
				<div class="profile-details">
					<b id="display-name"><?= htmlspecialchars($full_name) ?></b>
					<div id="display-email"><?= htmlspecialchars($email) ?></div>
					<div id="display-phone"><?= htmlspecialchars($phone) ?></div>
				</div>

				<div>
					<button type="button" class="edit-btn" id="openEdit">Edit</button>
				</div>
			</div>

			<!-- Modal: Edit Profil -->
			<div id="modalOverlay" class="modal-overlay" style="display:none;">
				<div class="modal">
					<div class="modal-header">
						<h3>Edit Profil</h3>
						<button class="modal-close" id="closeEdit">×</button>
					</div>
					<form method="POST" class="modal-form">
						<label class="sr-only">Masukkan Username</label>
						<input name="full_name" type="text" placeholder="Masukkan Username" value="<?= htmlspecialchars($full_name) ?>" required>

						<label class="sr-only">Masukkan Email</label>
						<input name="email" type="email" placeholder="Masukkan Email" value="<?= htmlspecialchars($email) ?>" required>

						<label class="sr-only">Masukkan NoTelp</label>
						<input name="phone" type="tel" placeholder="Masukkan NoTelp" value="<?= htmlspecialchars($phone) ?>" required>

						<div style="display:flex;justify-content:flex-end;margin-top:18px;">
							<button type="submit" name="save_profile" class="save-btn">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</section>

	</main>
</div>

<script>
	// Modal open/close logic
	const openBtn = document.getElementById('openEdit');
	const closeBtn = document.getElementById('closeEdit');
	const overlay = document.getElementById('modalOverlay');

	if (openBtn) openBtn.addEventListener('click', () => {
		overlay.style.display = 'flex';
	});
	if (closeBtn) closeBtn.addEventListener('click', () => {
		overlay.style.display = 'none';
	});
	// Close when clicking outside modal
	if (overlay) overlay.addEventListener('click', (e) => {
		if (e.target === overlay) overlay.style.display = 'none';
	});
</script>

</body>
</html>
