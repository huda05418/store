<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$produkRekomendasi = getProdukRekomendasi();
$produkDiskon = getProdukDiskon();
$produkRandom = getProdukRandom();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MurahAja - Toko Online Murah</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>MurahAja</h1>
        <form action="search.php" method="get" class="search-bar">
            <input type="text" name="q" placeholder="Cari produk...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </header>

    <div class="banner-slider">
        <!-- Banner 1 -->
        <img src="assets/banner/banner1.jpg" alt="Banner Promo">
        <!-- Tambahkan banner lainnya sesuai kebutuhan -->
    </div>

    <div class="section-title">
        <h2>Produk Diskon</h2>
        <a href="#">Lihat Semua</a>
    </div>

    <div class="product-horizontal-scroll">
        <?php foreach ($produkDiskon as $produk): ?>
        <a href="produk.php?id=<?= $produk['id'] ?>" class="product-card-horizontal">
            <img src="assets/images/<?= explode(',', $produk['gambar'])[0] ?>" alt="<?= $produk['nama_produk'] ?>">
            <div class="product-info">
                <div class="product-name"><?= $produk['nama_produk'] ?></div>
                <?php if ($produk['is_diskon'] && $produk['harga_diskon']): ?>
                <div class="product-price">
                    <span class="product-price-original">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                    Rp <?= number_format($produk['harga_diskon'], 0, ',', '.') ?>
                </div>
                <?php else: ?>
                <div class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
                <?php endif; ?>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="section-title">
        <h2>Produk Rekomendasi</h2>
        <a href="#">Lihat Semua</a>
    </div>

    <div class="product-horizontal-scroll">
        <?php foreach ($produkRekomendasi as $produk): ?>
        <a href="produk.php?id=<?= $produk['id'] ?>" class="product-card-horizontal">
            <img src="assets/images/<?= explode(',', $produk['gambar'])[0] ?>" alt="<?= $produk['nama_produk'] ?>">
            <div class="product-info">
                <div class="product-name"><?= $produk['nama_produk'] ?></div>
                <?php if ($produk['is_diskon'] && $produk['harga_diskon']): ?>
                <div class="product-price">
                    <span class="product-price-original">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                    Rp <?= number_format($produk['harga_diskon'], 0, ',', '.') ?>
                </div>
                <?php else: ?>
                <div class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
                <?php endif; ?>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="banner-slider">
        <!-- Banner 2 -->
        <img src="assets/banner/banner2.jpg" alt="Banner Promo">
        <!-- Tambahkan banner lainnya sesuai kebutuhan -->
    </div>

    <div class="section-title">
        <h2>Produk Lainnya</h2>
    </div>

    <div class="product-grid">
        <?php foreach ($produkRandom as $produk): ?>
        <a href="produk.php?id=<?= $produk['id'] ?>" class="product-card">
            <img src="assets/images/<?= explode(',', $produk['gambar'])[0] ?>" alt="<?= $produk['nama_produk'] ?>">
            <div class="product-info">
                <div class="product-name">
                    <?= $produk['nama_produk'] ?>
                    <?php if ($produk['is_rekomendasi']): ?>
                    <span class="rekomendasi-badge">🔥</span>
                    <?php endif; ?>
                </div>
                <?php if ($produk['is_diskon'] && $produk['harga_diskon']): ?>
                <div class="product-price">
                    <span class="product-price-original">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                    Rp <?= number_format($produk['harga_diskon'], 0, ',', '.') ?>
                </div>
                <?php else: ?>
                <div class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
                <?php endif; ?>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <footer class="footer">
        <div class="footer-section">
            <h3>Tentang Kami</h3>
            <p>MurahAja adalah toko online yang menyediakan berbagai produk dengan harga terjangkau.</p>
        </div>
        <div class="footer-section">
            <h3>Kontak</h3>
            <ul>
                <li><i class="fas fa-phone"></i> 08123456789</li>
                <li><i class="fas fa-envelope"></i> info@murahaja.com</li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Informasi</h3>
            <ul>
                <li><a href="#">Syarat & Ketentuan</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
            </ul>
        </div>
    </footer>

    <?php include 'includes/navbar.php'; ?>

    <script>
        // Simple banner slider
        let currentBanner = 0;
        const banners = document.querySelectorAll('.banner-slider img');
        
        function showBanner(index) {
            banners.forEach(banner => banner.style.display = 'none');
            banners[index].style.display = 'block';
        }
        
        function nextBanner() {
            currentBanner = (currentBanner + 1) % banners.length;
            showBanner(currentBanner);
        }
        
        // Show first banner initially
        showBanner(0);
        
        // Change banner every 5 seconds
        setInterval(nextBanner, 5000);
    </script>
</body>
</html>