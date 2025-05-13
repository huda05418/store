<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$produk = getProdukById($_GET['id']);

if (!$produk) {
    header('Location: index.php');
    exit;
}

$gambarProduk = explode(',', $produk['gambar']);
$currentUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama_produk']) ?> - MurahAja</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Detail Produk</h1>
        <form action="search.php" method="get" class="search-bar">
            <input type="text" name="q" placeholder="Cari produk...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </header>

    <div class="product-detail">
        <div class="product-images">
            <img src="assets/images/<?= htmlspecialchars($gambarProduk[0]) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="product-main-image" id="mainImage">
            <div class="product-thumbnails">
                <?php foreach ($gambarProduk as $gambar): ?>
                <img src="assets/images/<?= htmlspecialchars(trim($gambar)) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="product-thumbnail" onclick="changeMainImage(this)">
                <?php endforeach; ?>
            </div>
        </div>

        <h1 class="product-title"><?= htmlspecialchars($produk['nama_produk']) ?></h1>
        
        <div class="product-price-container">
            <?php if ($produk['is_diskon'] && $produk['harga_diskon']): ?>
            <span class="product-price-original">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
            <span class="product-price">Rp <?= number_format($produk['harga_diskon'], 0, ',', '.') ?></span>
            <?php else: ?>
            <span class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
            <?php endif; ?>
        </div>

        <div class="product-description">
            <h3>Deskripsi Produk</h3>
            <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
        </div>

        <div class="product-tags">
            <?php $tags = explode(',', $produk['tag']); ?>
            <?php foreach ($tags as $tag): ?>
            <span class="product-tag"><?= htmlspecialchars(trim($tag)) ?></span>
            <?php endforeach; ?>
        </div>

        <div class="product-category">
            <strong>Kategori:</strong> <?= htmlspecialchars($produk['nama_kategori']) ?>
        </div>

        <a href="https://wa.me/628123456789?text=Halo%20saya%20mau%20beli%20produk%20ini:%20<?= urlencode($produk['nama_produk']) ?>%20-%20<?= urlencode($currentUrl) ?>" class="buy-button">
            Beli Sekarang via WhatsApp
        </a>
    </div>

    <?php include 'includes/navbar.php'; ?>

    <script>
        function changeMainImage(thumbnail) {
            document.getElementById('mainImage').src = thumbnail.src;
        }
    </script>
</body>
</html>