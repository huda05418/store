<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($keyword)) {
    header('Location: index.php');
    exit;
}

$hasilPencarian = searchProduk($keyword);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian "<?= htmlspecialchars($keyword) ?>" - MurahAja</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Hasil Pencarian</h1>
        <form action="search.php" method="get" class="search-bar">
            <input type="text" name="q" placeholder="Cari produk..." value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </header>

    <div class="search-info">
        <p>Menampilkan hasil pencarian untuk: <strong>"<?= htmlspecialchars($keyword) ?>"</strong></p>
        <p><?= count($hasilPencarian) ?> produk ditemukan</p>
    </div>

    <?php if (!empty($hasilPencarian)): ?>
    <div class="product-grid">
        <?php foreach ($hasilPencarian as $produk): ?>
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
    <?php else: ?>
    <div class="no-results">
        <p>Tidak ada produk yang ditemukan untuk pencarian "<?= htmlspecialchars($keyword) ?>".</p>
        <p>Coba gunakan kata kunci lain atau lihat <a href="kategori.php">kategori produk kami</a>.</p>
    </div>
    <?php endif; ?>

    <?php include 'includes/navbar.php'; ?>
</body>
</html>